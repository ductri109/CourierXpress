<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;

class CustomerReportController extends Controller
{
    public function index(Request $request)
    {
        $customer = auth()->guard('customer')->user();

        $query = Courier::where('customer_id', $customer->id);

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $couriers = $query->latest()->paginate(10)->withQueryString();

        $summaryQuery = Courier::where('customer_id', $customer->id);

        $totalCouriers = $summaryQuery->count();

        $totalShippingFee = Courier::where('customer_id', $customer->id)
            ->sum('shipping_fee');

        $totalPaid = Courier::where('customer_id', $customer->id)
            ->where('payment_status', 'paid')
            ->sum('shipping_fee');

        $totalUnpaid = Courier::where('customer_id', $customer->id)
            ->where('payment_status', 'unpaid')
            ->sum('shipping_fee');

        $pendingCouriers = Courier::where('customer_id', $customer->id)
            ->where('status', 'pending')
            ->count();

        $deliveredCouriers = Courier::where('customer_id', $customer->id)
            ->where('status', 'delivered')
            ->count();

        $failedCouriers = Courier::where('customer_id', $customer->id)
            ->where('status', 'failed')
            ->count();

        return view('customer.reports.index', compact(
            'couriers',
            'totalCouriers',
            'totalShippingFee',
            'totalPaid',
            'totalUnpaid',
            'pendingCouriers',
            'deliveredCouriers',
            'failedCouriers'
        ));
    }
}
