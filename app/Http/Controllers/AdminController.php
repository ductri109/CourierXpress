<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
use App\Models\Agent;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class AdminController extends Controller
{
    // ================================================================
    // AUTH
    // ================================================================

    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        $admin = Admin::where('user_name', $request->username)->first();

        if (!$admin) {
            return back()->withErrors(['username' => 'Tài khoản không tồn tại']);
        }

        if (!Hash::check($request->password, $admin->password_hash)) {
            return back()->withErrors(['password' => 'Sai mật khẩu']);
        }

        Auth::guard('admin')->login($admin);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    // ================================================================
    // DASHBOARD
    // ================================================================

    public function dashboard()
    {
        $totalOrders     = Courier::count();
        $pendingOrders   = Courier::where('status', 'pending')->count();
        $assignedOrders  = Courier::where('status', 'assigned')->count();
        $inTransitOrders = Courier::where('status', 'in_transit')->count();
        $deliveredOrders = Courier::where('status', 'delivered')->count();

        $totalAgents  = Agent::count();
        $activeAgents = Agent::where('Status', 'active')->count();
        $busyAgents   = Agent::where('Status', 'busy')->count();

        $totalCustomers = Customer::count();

        $recentOrders = Courier::with(['customer', 'agent'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $pendingList = Courier::with('customer')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->limit(5)
            ->get();

        $availableAgents = Agent::where('Status', 'active')
            ->withCount(['couriers as total_orders'])
            ->get();

        $dailyStats = Courier::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total'),
            DB::raw("SUM(CASE WHEN status = 'delivered' THEN 1 ELSE 0 END) as delivered")
        )
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard.index', compact(
            'totalOrders', 'pendingOrders', 'assignedOrders', 'inTransitOrders', 'deliveredOrders',
            'totalAgents', 'activeAgents', 'busyAgents', 'totalCustomers',
            'recentOrders', 'pendingList', 'availableAgents', 'dailyStats'
        ));
    }

    // ================================================================
    // ORDERS
    // ================================================================

    public function index(Request $request)
    {
        $query = Courier::with(['customer', 'agent']);

        if ($request->filled('status'))        $query->where('status', $request->status);
        if ($request->filled('tracking_id'))   $query->where('tracking_id', 'LIKE', '%' . $request->tracking_id . '%');
        if ($request->filled('receiver_name')) $query->where('receiver_name', 'LIKE', '%' . $request->receiver_name . '%');
        if ($request->filled('date_from'))     $query->whereDate('created_at', '>=', $request->date_from);
        if ($request->filled('date_to'))       $query->whereDate('created_at', '<=', $request->date_to);

        $orders = $query->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Courier::with(['customer', 'agent'])->findOrFail($id);
        $freeAgents = Agent::where('Status', 'active')->get();
        return view('admin.orders.show', compact('order', 'freeAgents'));
    }

    public function assignAgent(Request $request, $id)
    {
        $request->validate(['agent_id' => 'required|exists:agents,ID']);

        $order = Courier::findOrFail($id);
        $agent = Agent::find($request->agent_id);

        if ($order->agent_id) {
            return back()->with('error', 'Đơn này đã được gán agent rồi.');
        }

        if (!$agent || $agent->Status !== 'active') {
            return back()->with('error', 'Agent này không khả dụng.');
        }

        DB::transaction(function () use ($order, $agent) {
            $order->update(['agent_id' => $agent->ID, 'status' => 'assigned']);
            $agent->update(['Status' => 'busy']);
        });

        // 🔔 --- ĐOẠN CODE TÍCH HỢP FCM GỬI THÔNG BÁO CHO KHÁCH HÀNG ---
        try {
            // Tìm khách hàng sở hữu đơn hàng này thông qua mối quan hệ lưu ở bảng Courier
            $customer = Customer::find($order->customer_id);

            // Kiểm tra nếu khách hàng tồn tại và đã cấp quyền nhận thông báo (có fcm_token)
            if ($customer && $customer->fcm_token) {
                $messaging = app('firebase.messaging');

                // Thiết lập nội dung thông báo kèm mã vận đơn của chính đơn hàng đó
                $notification = Notification::create(
                    'Đơn hàng của bạn đã được gán tài xế! 📦',
                    'Vận đơn ' . $order->tracking_id . ' đang được chuẩn bị bởi shipper ' . $agent->FullName . '.'
                );

                $message = CloudMessage::withTarget('token', $customer->fcm_token)
                    ->withNotification($notification);

                // Thực hiện lệnh gửi qua Firebase API v1
                $messaging->send($message);
            }
        } catch (\Exception $e) {
            // Ghi log lại nếu lỗi hệ thống mạng/Firebase xảy ra để không làm gián đoạn tiến trình gán của Admin
            \Log::error('Lỗi gửi thông báo FCM CourierXpress: ' . $e->getMessage());
        }
        // --- KẾT THÚC ĐOẠN CODE FCM ---

        return redirect()->route('admin.orders.index')
            ->with('success', 'Đã gán Agent thành công cho đơn ' . $order->tracking_id);
    }

    // ================================================================
    // USER ACCOUNT (Admin profile)
    // ================================================================

    public function account()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.account.index', compact('admin'));
    }

    public function updateUsername(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'user_name'        => 'required|string|min:3|max:50|unique:admins,user_name,' . $admin->id,
            'current_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, $admin->password_hash)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.'])->withInput();
        }

        $admin->update(['user_name' => $request->user_name]);

        return back()->with('success', 'Đã cập nhật tên đăng nhập thành công!');
    }

    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $admin->password_hash)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        if (Hash::check($request->new_password, $admin->password_hash)) {
            return back()->withErrors(['new_password' => 'Mật khẩu mới không được trùng mật khẩu cũ.']);
        }

        $admin->update(['password_hash' => Hash::make($request->new_password)]);

        return back()->with('success', 'Đã cập nhật mật khẩu thành công!');
    }

    // ================================================================
    // AGENTS MANAGEMENT (CRUD thật từ DB)
    // ================================================================

    public function agentsIndex(Request $request)
    {
        $query = Agent::withCount([
            'couriers as total_orders',
            'couriers as delivered_orders' => fn($q) => $q->where('status', 'delivered'),
            'couriers as active_orders'    => fn($q) => $q->whereIn('status', ['assigned', 'in_transit']),
        ]);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('FullName', 'like', "%{$s}%")
                    ->orWhere('Email',    'like', "%{$s}%")
                    ->orWhere('Phone',    'like', "%{$s}%")
                    ->orWhere('Username', 'like', "%{$s}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('Status', $request->status);
        }

        $agents = $query->orderBy('created_at', 'desc')->get();

        $totalAgents    = Agent::count();
        $activeAgents   = Agent::where('Status', 'active')->count();
        $busyAgents     = Agent::where('Status', 'busy')->count();
        $totalDelivered = Courier::where('status', 'delivered')->count();

        return view('admin.agents.index', compact(
            'agents', 'totalAgents', 'activeAgents', 'busyAgents', 'totalDelivered'
        ));
    }

    public function agentsStore(Request $request)
    {
        $request->validate([
            'FullName'  => 'required|string|max:255',
            'Email'     => 'required|email|unique:agents,Email',
            'Phone'     => 'required|string|max:20',
            'Username'  => 'required|string|min:3|max:50|unique:agents,Username',
            'password'  => 'required|string|min:6|confirmed',
        ]);

        Agent::create([
            'FullName'     => $request->FullName,
            'Email'        => $request->Email,
            'Phone'        => $request->Phone,
            'Username'     => $request->Username,
            'PasswordHash' => Hash::make($request->password),
            'Status'       => 'active',
        ]);

        return redirect()->route('admin.agents.index')
            ->with('success', 'Đã thêm agent ' . $request->FullName . ' thành công!')
            ->with('new_agent', [
                'username' => $request->Username,
                'password' => $request->password,
            ]);
    }

    public function agentsShow($id)
    {
        $agent = Agent::findOrFail($id);

        $orders = Courier::where('agent_id', $id)
            ->with('customer')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalOrders     = $orders->count();
        $assignedOrders  = $orders->where('status', 'assigned')->count();
        $inTransitOrders = $orders->where('status', 'in_transit')->count();
        $deliveredOrders = $orders->where('status', 'delivered')->count();

        return view('admin.agents.show', compact(
            'agent', 'orders',
            'totalOrders', 'assignedOrders', 'inTransitOrders', 'deliveredOrders'
        ));
    }

    public function agentsUpdate(Request $request, $id)
    {
        $agent = Agent::findOrFail($id);

        $request->validate([
            'FullName' => 'required|string|max:255',
            'Email'    => 'required|email|unique:agents,Email,' . $id . ',ID',
            'Phone'    => 'required|string|max:20',
            'Status'   => 'required|in:active,busy',
        ]);

        $data = [
            'FullName' => $request->FullName,
            'Email'    => $request->Email,
            'Phone'    => $request->Phone,
            'Status'   => $request->Status,
        ];

        if ($request->filled('new_password')) {
            $data['PasswordHash'] = Hash::make($request->new_password);
        }

        $agent->update($data);

        return redirect()->route('admin.agents.index')
            ->with('success', 'Đã cập nhật thông tin agent ' . $agent->FullName);
    }

    public function agentsUpdateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:active,busy']);
        $agent = Agent::findOrFail($id);
        $agent->update(['Status' => $request->status]);

        $label = $request->status === 'active' ? 'Đang rảnh' : 'Đang bận';
        return back()->with('success', "Đã chuyển trạng thái agent {$agent->FullName} → {$label}");
    }

    public function agentsDestroy($id)
    {
        $agent = Agent::findOrFail($id);
        $name  = $agent->FullName;

        // Bỏ gán đơn hàng của agent này (về null)
        Courier::where('agent_id', $id)->update(['agent_id' => null, 'status' => 'pending']);

        $agent->delete();

        return redirect()->route('admin.agents.index')
            ->with('success', "Đã xoá agent {$name}. Các đơn hàng của agent đã được chuyển về trạng thái chờ gán.");
    }

    // ================================================================
    // CUSTOMERS
    // ================================================================

    public function customerOverview($id)   { return view('admin.customers.overview',      ['customerId' => $id]); }
    public function customerSecurity($id)   { return view('admin.customers.security',      ['customerId' => $id]); }
    public function customerBilling($id)    { return view('admin.customers.billing',       ['customerId' => $id]); }
    public function customerNotifications($id) { return view('admin.customers.notifications', ['customerId' => $id]); }

    // ================================================================
    // EMPLOYEES (demo data)
    // ================================================================

    private function demoEmployees()
    {
        return collect([
            ['id' => 1, 'name' => 'Nguyễn Văn An',   'email' => 'an.nguyen@courierxpress.vn',  'phone' => '0981 234 567', 'role' => 'Quản trị viên',       'department' => 'Vận hành',    'status' => 'active',   'avatar' => '1.png', 'joined_at' => '12/03/2025'],
            ['id' => 2, 'name' => 'Trần Minh Đức',   'email' => 'duc.tran@courierxpress.vn',   'phone' => '0972 111 222', 'role' => 'Nhân viên giao hàng', 'department' => 'Last Mile',   'status' => 'active',   'avatar' => '2.png', 'joined_at' => '22/04/2025'],
            ['id' => 3, 'name' => 'Lê Thị Mai',       'email' => 'mai.le@courierxpress.vn',     'phone' => '0963 555 888', 'role' => 'Nhân viên kho',       'department' => 'Warehouse',   'status' => 'pending',  'avatar' => '3.png', 'joined_at' => '01/05/2025'],
            ['id' => 4, 'name' => 'Phạm Quốc Huy',   'email' => 'huy.pham@courierxpress.vn',   'phone' => '0912 789 456', 'role' => 'Điều phối viên',      'department' => 'Dispatching', 'status' => 'inactive', 'avatar' => '4.png', 'joined_at' => '18/01/2025'],
        ]);
    }

    public function employeesIndex()
    {
        $employees = $this->demoEmployees();
        if (request('keyword')) {
            $keyword = mb_strtolower(request('keyword'));
            $employees = $employees->filter(fn($e) =>
                str_contains(mb_strtolower($e['name']), $keyword) ||
                str_contains(mb_strtolower($e['email']), $keyword) ||
                str_contains(mb_strtolower($e['role']), $keyword) ||
                str_contains(mb_strtolower($e['department']), $keyword)
            );
        }
        return view('admin.employees.index', compact('employees'));
    }

    public function employeeShow($id)
    {
        $employee = $this->demoEmployees()->firstWhere('id', (int) $id);
        if (!$employee) abort(404);
        return view('admin.employees.show', compact('employee'));
    }

    public function employeeStore(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255', 'email' => 'required|email', 'phone' => 'required', 'department' => 'required', 'role' => 'required']);
        return redirect()->route('admin.employees.index')->with('success', 'Đã nhận thông tin nhân viên. Hiện tại là bản demo giao diện.');
    }

    public function employeeUpdate(Request $request, $id)
    {
        return redirect()->route('admin.employees.index')->with('success', 'Đã cập nhật nhân viên #' . $id . ' (demo).');
    }

    public function employeeDestroy($id)
    {
        return redirect()->route('admin.employees.index')->with('success', 'Đã xoá nhân viên #' . $id . ' (demo).');
    }
}
