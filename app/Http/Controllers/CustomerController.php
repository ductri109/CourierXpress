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

    public function storeBooking(Request $request) {
        $request->validate([
            'sender_name' => 'required|string',
            'sender_address' => 'required|string',
            'receiver_name' => 'required|string',
            'receiver_address' => 'required|string',
            'total_weight' => 'required|numeric|min:0.1',
        ]);
    
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
    
        return redirect()->route('landing')->with('success', 'Đặt đơn thành công! Mã vận đơn của bạn là: ' . $tracking_id);
    }

    public function showAbout() {
        return view('customer.about');
    }

    public function showContact() {
        return view('customer.contact');
    }

    public function showTerms() {
        return view('customer.terms');
    }

    public function showPolicy() {
        return view('customer.policy');
    }
}