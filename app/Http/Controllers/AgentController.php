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

class AgentController extends Controller
{
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

        // Đăng nhập và ÉP TẠO SESSION MỚI (Lệnh bắt buộc để không bị văng)
        Auth::guard('agent')->login($agent);
        $request->session()->regenerate();

        return redirect()->route('agent.orders.index');
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

    public function index()
    {
        $agentId = Auth::guard('agent')->id();
        $orders = Courier::where('agent_id', $agentId)->with('customer')->orderBy('created_at', 'desc')->get();
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
        $order = Courier::where('id', $id)->where('agent_id', $agentId)->firstOrFail();

        if ($order->status !== 'in_transit') {
            return back()->with('error', 'Đơn chưa ở trạng thái giao.');
        }

        DB::transaction(function () use ($order) {
            $agent = Agent::find($order->agent_id);
            $order->update(['status' => 'delivered']);
            if ($agent) {
                $agent->update(['Status' => 'active']);
            }
        });

        return back()->with('success', 'Đã giao hàng thành công!');
    }

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

    public function customersIndex(Request $request)
    {
        $agentId = Auth::guard('agent')->id();
        $customerIds = Courier::where('agent_id', $agentId)->whereNotNull('customer_id')->pluck('customer_id')->unique();

        $customers = Customer::whereIn('id', $customerIds)
            ->withCount(['couriers as orders_count' => function($q) use ($agentId) {
                $q->where('agent_id', $agentId);
            }])->get();

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
