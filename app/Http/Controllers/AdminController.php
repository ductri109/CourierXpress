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
}