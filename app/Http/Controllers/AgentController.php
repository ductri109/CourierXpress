<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
use App\Models\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    // --- DASHBOARD / DANH SÁCH ĐƠN ---

    public function index()
    {
        $agentId = Auth::guard('agent')->id();

        $orders = Courier::where('agent_id', $agentId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('agent.orders.index', compact('orders'));
    }

    // --- XEM CHI TIẾT ĐƠN ---

    public function show($id)
    {
        $agentId = Auth::guard('agent')->id();

        $order = Courier::where('id', $id)
            ->where('agent_id', $agentId)
            ->firstOrFail();

        return view('agent.orders.show', compact('order'));
    }

    // --- NHẬN ĐƠN (ACCEPT) ---

    public function accept($id)
    {
        $agentId = Auth::guard('agent')->id();

        $order = Courier::where('id', $id)
            ->where('agent_id', $agentId)
            ->firstOrFail();

        // chỉ nhận nếu đang assigned
        if ($order->status !== 'assigned') {
            return back()->with('error', 'Đơn không hợp lệ để nhận.');
        }

        $order->update([
            'status' => 'in_transit'
        ]);

        return back()->with('success', 'Đã nhận đơn, đang giao hàng.');
    }

    // --- HOÀN THÀNH ĐƠN ---

    public function complete($id)
    {
        $agentId = Auth::guard('agent')->id();

        $order = Courier::where('id', $id)
            ->where('agent_id', $agentId)
            ->firstOrFail();

        // chỉ hoàn thành nếu đang giao
        if ($order->status !== 'in_transit') {
            return back()->with('error', 'Đơn chưa ở trạng thái giao.');
        }

        DB::transaction(function () use ($order) {

            $agent = Agent::find($order->agent_id);

            // cập nhật đơn
            $order->update([
                'status' => 'delivered'
            ]);

            // trả agent về rảnh
            if ($agent) {
                $agent->update([
                    'Status' => 'active'
                ]);
            }
        });

        return back()->with('success', 'Đã giao hàng thành công.');
    }
}