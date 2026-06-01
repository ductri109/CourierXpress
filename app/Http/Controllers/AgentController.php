<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AgentRegisterRequest;
use App\Models\Courier;
use App\Models\Agent;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// ✅ THÊM MỚI: Import Job gửi email giao hàng thành công
use App\Jobs\SendOrderDeliveredEmailJob;

class AgentController extends Controller
{
    // --- AUTH ---

    public function showLogin()
    {
        return view('agent.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $agent = Agent::where('Username', $request->username)->first();

        if (!$agent || !Hash::check($request->password, $agent->PasswordHash)) {
            return back()->withErrors(['username' => 'Tên đăng nhập hoặc mật khẩu không đúng.'])->withInput();
        }

        Auth::guard('agent')->login($agent);
        $request->session()->regenerate();

        return redirect()->route('agent.dashboard');
    }

    public function showRegister()
    {
        return view('agent.auth.register');
    }

    public function register(AgentRegisterRequest $request)
    {
        Agent::create([
            'FullName'     => $request->FullName,
            'Username'     => $request->Username,
            'Email'        => $request->Email,
            'Phone'        => $request->Phone,
            'PasswordHash' => Hash::make($request->password),
            'Status'       => 'active',
        ]);

        return redirect()->route('agent.login')
            ->with('success', 'Đăng ký tài khoản đại lý thành công! Vui lòng đăng nhập.');
    }

    public function logout(Request $request)
    {
        Auth::guard('agent')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('agent.login');
    }

    // --- DASHBOARD ---

    public function dashboard()
    {
        $agentId = Auth::guard('agent')->id();

        // ── Tổng quan đơn hàng ──────────────────────────────────────────
        $totalOrders     = Courier::where('agent_id', $agentId)->count();
        $assignedOrders  = Courier::where('agent_id', $agentId)->where('status', 'assigned')->count();
        $inTransitOrders = Courier::where('agent_id', $agentId)->where('status', 'in_transit')->count();
        $deliveredOrders = Courier::where('agent_id', $agentId)->where('status', 'delivered')->count();

        // ── Đơn cần xử lý & gần đây ─────────────────────────────────────
        $urgentOrders = Courier::where('agent_id', $agentId)
            ->where('status', 'assigned')
            ->with('customer')
            ->orderBy('created_at', 'asc')
            ->get();

        $recentOrders = Courier::where('agent_id', $agentId)
            ->with('customer')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // ── Thống kê 7 ngày gần nhất ────────────────────────────────────
        $dailyStats = Courier::where('agent_id', $agentId)
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total'),
                DB::raw("SUM(CASE WHEN status = 'delivered' THEN 1 ELSE 0 END) as delivered")
            )
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // ── Thống kê theo tháng (12 tháng) ──────────────────────────────
        $monthlyStats = Courier::where('agent_id', $agentId)
            ->select(
                DB::raw('EXTRACT(YEAR FROM created_at) as year'),
                DB::raw('EXTRACT(MONTH FROM created_at) as month'),
                DB::raw('COUNT(*) as total'),
                DB::raw("SUM(CASE WHEN status = 'delivered' THEN 1 ELSE 0 END) as delivered"),
                DB::raw("SUM(CASE WHEN status = 'canceled' OR status = 'cancelled' THEN 1 ELSE 0 END) as cancelled")
            )
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // ── Doanh thu theo tháng ─────────────────────────────────────────
        $revenueByMonth = Courier::where('agent_id', $agentId)
            ->select(
                DB::raw('EXTRACT(YEAR FROM created_at) as year'),
                DB::raw('EXTRACT(MONTH FROM created_at) as month'),
                DB::raw("SUM(CASE WHEN status = 'delivered' THEN GREATEST(COALESCE(shipping_fee, 0), 35000) ELSE 0 END) as revenue"),
                DB::raw("SUM(CASE WHEN status = 'delivered' THEN 1 ELSE 0 END) as delivered_count")
            )
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // ── Tổng doanh thu của agent ─────────────────────────────────────
        $totalRevenue = Courier::where('agent_id', $agentId)
            ->where('status', 'delivered')
            ->selectRaw("SUM(GREATEST(COALESCE(shipping_fee, 0), 35000)) as total")
            ->value('total') ?? 0;

        // ── Doanh thu tháng này ──────────────────────────────────────────
        $revenueThisMonth = Courier::where('agent_id', $agentId)
            ->where('status', 'delivered')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->selectRaw("SUM(GREATEST(COALESCE(shipping_fee, 0), 35000)) as total")
            ->value('total') ?? 0;

        // ── Bảng doanh thu chi tiết ──────────────────────────────────────
        $revenueTable = Courier::where('agent_id', $agentId)
            ->select(
                DB::raw('EXTRACT(YEAR FROM created_at) as year'),
                DB::raw('EXTRACT(MONTH FROM created_at) as month'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw("SUM(CASE WHEN status = 'delivered' THEN 1 ELSE 0 END) as delivered_count"),
                DB::raw("SUM(CASE WHEN status = 'canceled' OR status = 'cancelled' THEN 1 ELSE 0 END) as cancelled_count"),
                DB::raw("SUM(CASE WHEN status = 'delivered' THEN GREATEST(COALESCE(shipping_fee, 0), 35000) ELSE 0 END) as revenue")
            )
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get();

        return view('agent.dashboard.index', compact(
            'totalOrders', 'assignedOrders', 'inTransitOrders', 'deliveredOrders',
            'urgentOrders', 'recentOrders', 'dailyStats', 'monthlyStats',
            'revenueByMonth', 'totalRevenue', 'revenueThisMonth', 'revenueTable'
        ));
    }

    // --- ORDERS ---

    public function index(Request $request)
    {
        $agentId = Auth::guard('agent')->id();
        $query = Courier::where('agent_id', $agentId)->with('customer');

        if ($request->filled('search')) {
            $query->where('tracking_id', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('agent.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $agentId = Auth::guard('agent')->id();
        $order = Courier::where('id', $id)->where('agent_id', $agentId)->with('customer')->firstOrFail();
        return view('agent.orders.show', compact('order'));
    }

    public function accept($id)
    {
        $agentId = Auth::guard('agent')->id();
        $order = Courier::where('id', $id)->where('agent_id', $agentId)->firstOrFail();

        if ($order->status !== 'assigned') {
            return back()->with('error', 'Đơn không hợp lệ để nhận.');
        }

        $order->update(['status' => 'in_transit']);
        return back()->with('success', 'Đã nhận đơn, đang giao hàng.');
    }

    public function complete($id)
    {
        $agentId = Auth::guard('agent')->id();

        // ✅ Load kèm customer để Job có thể dùng ngay (tránh lazy load trong queue)
        $order = Courier::where('id', $id)
            ->where('agent_id', $agentId)
            ->with('customer')
            ->firstOrFail();

        if ($order->status !== 'in_transit') {
            return back()->with('error', 'Đơn chưa ở trạng thái giao.');
        }

        DB::transaction(function () use ($order) {
            $agent = Agent::find($order->agent_id);

            // Cập nhật trạng thái thành delivered
            $order->update(['status' => 'delivered']);

            // Trả agent về trạng thái rảnh sau khi hoàn thành
            if ($agent) {
                $agent->update(['Status' => 'active']);
            }
        });

        // ✅ TÍCH HỢP QUEUE: Dispatch Job gửi email thông báo giao hàng thành công
        // Fresh lại order để có updated_at chính xác sau transaction
        $order->refresh();
        SendOrderDeliveredEmailJob::dispatch($order);

        return back()->with('success', 'Đã giao hàng thành công! Email thông báo đã được gửi cho khách hàng.');
    }

    // --- COURIERS ---

    public function couriersIndex(Request $request)
    {
        $agentId = Auth::guard('agent')->id();
        $query = Courier::where('agent_id', $agentId)->with('customer');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();
        $courier = null;
        if ($request->filled('search')) {
            $search = $request->search;
            $courier = Courier::with('customer')
                ->where('tracking_id', $search)
                ->orWhere('id', is_numeric($search) ? $search : 0)
                ->first();
        }

        return view('agent.couriers.index', compact('orders', 'courier'));
    }

    // --- CUSTOMERS ---

    public function customersIndex(Request $request)
    {
        $agentId = Auth::guard('agent')->id();
        $customerIds = Courier::where('agent_id', $agentId)->whereNotNull('customer_id')->pluck('customer_id')->unique();

        $customers = Customer::whereIn('id', $customerIds)
            ->withCount(['couriers as orders_count' => function($q) use ($agentId) {
                $q->where('agent_id', $agentId);
            }])
            ->with(['couriers' => function($q) use ($agentId) {
                $q->where('agent_id', $agentId)
                    ->orderBy('created_at', 'desc')
                    ->select('customer_id', 'sender_address');
            }])
            ->get();

        $customer = null;
        $customerOrders = collect();
        if ($request->filled('search')) {
            $search = $request->search;
            $customer = Customer::where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('id', is_numeric($search) ? $search : 0);
            })->first();

            if ($customer) {
                $customerOrders = Courier::where('customer_id', $customer->id)->orderBy('created_at', 'desc')->get();
            }
        }

        return view('agent.customers.index', compact('customers', 'customer', 'customerOrders'));
    }

    public function customersShow($id)
    {
        $customer = Customer::findOrFail($id);
        $orders   = Courier::where('customer_id', $id)->orderBy('created_at', 'desc')->get();
        return view('agent.customers.show', compact('customer', 'orders'));
    }
}