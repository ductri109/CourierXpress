<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function showRegister() { return view('customer.auth.register'); }
    public function showLogin() { return view('customer.auth.login'); }

    public function register(Request $request) {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:20|unique:customers,phone',
            'password' => 'required|min:6|confirmed',
            'address' => 'nullable|string|max:255',
        ]);

        Customer::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password_hash' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if ($customer && Hash::check($request->password, $customer->password_hash)) {
            Auth::guard('customer')->login($customer);
            $request->session()->regenerate();
            return redirect()->intended(route('landing'));
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.'])->withInput();
    }

    public function logout(Request $request) {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function showBooking()
    {
        return view('customer.booking');
    }

//    public function storeBooking(Request $request) {
//        $request->validate([
//            'sender_name' => 'required|string',
//            'sender_address' => 'required|string',
//            'receiver_name' => 'required|string',
//            'receiver_address' => 'required|string',
//            'total_weight' => 'required|numeric|min:0.1',
//        ]);
    public function storeBooking(Request $request) {

        $request->validate([
            'sender_name' => 'required|string',
            'sender_province' => 'required|string',
            'sender_ward' => 'required|string',
            'sender_address_detail' => 'required|string',

            'receiver_name' => 'required|string',
            'receiver_province' => 'required|string',
            'receiver_ward' => 'required|string',
            'receiver_address_detail' => 'required|string',

            'weight_range' => 'required|string',
        ]);

        $tracking_id = 'CX-' . strtoupper(bin2hex(random_bytes(3)));

        $sender_address = $request->sender_address_detail . ', ' . $request->sender_ward . ', ' . $request->sender_province;
        $receiver_address = $request->receiver_address_detail . ', ' . $request->receiver_ward . ', ' . $request->receiver_province;

        $weight_map = [
            'under_0.5' => 0.5,
            '0.5-1' => 1.0,
            '1-2' => 2.0,
            '2-5' => 5.0,
            'above_5' => 10.0,
        ];
        $total_weight = $weight_map[$request->weight_range] ?? 1.0;

        // 4. Lưu vào Database
        \App\Models\Courier::create([
            'tracking_id' => $tracking_id,
            'sender_name' => $request->sender_name,
            'sender_address' => $sender_address,
            'receiver_name' => $request->receiver_name,
            'receiver_address' => $receiver_address,
            'total_weight' => $total_weight,
            'status' => 'pending',
            'customer_id' => auth('customer')->id(),

        ]);

        return redirect()->route('customer.orders.index')
            ->with('success', 'Đặt đơn thành công! Mã vận đơn của bạn là: ' . $tracking_id);


        $tracking_id = 'CX-' . strtoupper(bin2hex(random_bytes(3)));

        \App\Models\Courier::create([
            'tracking_id' => $tracking_id,
            'sender_name' => $request->sender_name,
            'sender_address' => $request->sender_address,
            'receiver_name' => $request->receiver_name,
            'receiver_address' => $request->receiver_address,
            'total_weight' => $request->total_weight,
            'status' => 'pending',
            'customer_id' => auth('customer')->id(),
        ]);

        return redirect()->route('customer.orders.index')->with('success', 'Đặt đơn thành công! Mã vận đơn của bạn là: ' . $tracking_id);
    }

    public function showOrders(Request $request)
    {
        $customer = auth('customer')->user();

        $query = \App\Models\Courier::where('customer_id', $customer->id)
            ->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by tracking_id or receiver_name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('tracking_id', 'like', "%{$search}%")
                    ->orWhere('receiver_name', 'like', "%{$search}%")
                    ->orWhere('sender_name', 'like', "%{$search}%");
            });
        }

        // Sort
        if ($request->sort === 'oldest') {
            $query->oldest();
        }

        $orders = $query->paginate(8)->withQueryString();

        // Status counts for this customer
        $statusCounts = \App\Models\Courier::where('customer_id', $customer->id)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return view('customer.orders.index', compact('orders', 'statusCounts'));
    }

    public function showAbout() {
        return view('customer.about');
    }

    public function showServices() {
        return view('customer.services');
    }

    public function showContact() {
        return view('customer.contact');
    }

    public function showServiceTerms() {
        return view('customer.terms');
    }

    public function showServicePolicy() {
        return view('customer.policy');
    }
}
