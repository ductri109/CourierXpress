<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
use App\Models\Agent;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // --- AUTH ---

    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.orders.index');
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

    // --- ORDER LIST ---

    public function index(Request $request)
    {
        $query = Courier::with('customer');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tracking_id')) {
            $query->where('tracking_id', 'LIKE', '%' . $request->tracking_id . '%');
        }

        if ($request->filled('receiver_name')) {
            $query->where('receiver_name', 'LIKE', '%' . $request->receiver_name . '%');
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        return view('admin.orders.index', compact('orders'));
    }

    // --- ORDER DETAIL ---

    public function show($id)
    {
        $order = Courier::findOrFail($id);

        // 🔥 chỉ lấy agent đang rảnh
        $freeAgents = Agent::where('Status', 'active')->get();

        return view('admin.orders.show', compact('order', 'freeAgents'));
    }

    // --- ASSIGN AGENT ---

    public function assignAgent(Request $request, $id)
    {
        $request->validate([
            'agent_id' => 'required|exists:agents,ID'
        ]);

        $order = Courier::findOrFail($id);
        $agent = Agent::find($request->agent_id);

        // ❗ tránh assign 2 lần
        if ($order->agent_id) {
            return back()->with('error', 'Đơn này đã được gán agent rồi.');
        }

        // ❗ agent phải đang rảnh
        if (!$agent || $agent->Status !== 'active') {
            return back()->with('error', 'Agent này không khả dụng.');
        }

        // 🔥 transaction chống lỗi
        DB::transaction(function () use ($order, $agent) {
            $order->update([
                'agent_id' => $agent->ID,
                'status' => 'assigned'
            ]);

            // đổi trạng thái agent → bận
            $agent->update([
                'Status' => 'busy'
            ]);
        });

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Đã gán Agent thành công cho đơn ' . $order->tracking_id);
    }

    public function dashboard()
    {
        return view('admin.dashboard.index');
    }

    public function customerOverview($id)
    {
        $customerId = $id;
        return view('admin.customers.overview', compact('customerId'));
    }

    public function customerSecurity($id)
    {
        $customerId = $id;
        return view('admin.customers.security', compact('customerId'));
    }

    public function customerBilling($id)
    {
        $customerId = $id;
        return view('admin.customers.billing', compact('customerId'));
    }

    public function customerNotifications($id)
    {
        $customerId = $id;
        return view('admin.customers.notifications', compact('customerId'));
    }

    public function fleet()
    {
        return view('admin.fleet.index');
    }

    public function userAccount($id = 1)
    {
        $userId = $id;
        return view('admin.users.account', compact('userId'));
    }


    private function demoEmployees()
    {
        return collect([
            [
                'id' => 1,
                'name' => 'Nguyễn Văn An',
                'email' => 'an.nguyen@courierxpress.vn',
                'phone' => '0981 234 567',
                'role' => 'Quản trị viên',
                'department' => 'Vận hành',
                'status' => 'active',
                'avatar' => '1.png',
                'joined_at' => '12/03/2025',
            ],
            [
                'id' => 2,
                'name' => 'Trần Minh Đức',
                'email' => 'duc.tran@courierxpress.vn',
                'phone' => '0972 111 222',
                'role' => 'Nhân viên giao hàng',
                'department' => 'Last Mile',
                'status' => 'active',
                'avatar' => '2.png',
                'joined_at' => '22/04/2025',
            ],
            [
                'id' => 3,
                'name' => 'Lê Thị Mai',
                'email' => 'mai.le@courierxpress.vn',
                'phone' => '0963 555 888',
                'role' => 'Nhân viên kho',
                'department' => 'Warehouse',
                'status' => 'pending',
                'avatar' => '3.png',
                'joined_at' => '01/05/2025',
            ],
            [
                'id' => 4,
                'name' => 'Phạm Quốc Huy',
                'email' => 'huy.pham@courierxpress.vn',
                'phone' => '0912 789 456',
                'role' => 'Điều phối viên',
                'department' => 'Dispatching',
                'status' => 'inactive',
                'avatar' => '4.png',
                'joined_at' => '18/01/2025',
            ],
        ]);
    }

    public function employeesIndex()
    {
        $employees = $this->demoEmployees();

        if (request('keyword')) {
            $keyword = mb_strtolower(request('keyword'));
            $employees = $employees->filter(function ($employee) use ($keyword) {
                return str_contains(mb_strtolower($employee['name']), $keyword)
                    || str_contains(mb_strtolower($employee['email']), $keyword)
                    || str_contains(mb_strtolower($employee['role']), $keyword)
                    || str_contains(mb_strtolower($employee['department']), $keyword);
            });
        }

        return view('admin.employees.index', compact('employees'));
    }

    public function employeeShow($id)
    {
        $employee = $this->demoEmployees()->firstWhere('id', (int) $id);

        if (!$employee) {
            abort(404);
        }

        return view('admin.employees.show', compact('employee'));
    }

    public function employeeStore(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'department' => 'required|string|max:100',
            'role' => 'required|string|max:100',
        ]);

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Đã nhận thông tin thêm nhân viên. Hiện tại đây là bản demo giao diện, chưa lưu xuống database.');
    }

    public function employeeUpdate(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:30',
            'role' => 'nullable|string|max:100',
        ]);

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Đã nhận thông tin cập nhật nhân viên #' . $id . '. Hiện tại đây là bản demo giao diện, chưa lưu xuống database.');
    }

    public function employeeDestroy($id)
    {
        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Đã nhận yêu cầu xoá nhân viên #' . $id . '. Hiện tại đây là bản demo giao diện, chưa xoá trong database.');
    }

}
