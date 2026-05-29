<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Nạp file Request validate riêng biệt của Customer vào đây
use App\Http\Requests\CustomerRegisterRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Models\Faq;
use App\Models\Courier;
use App\Jobs\SendOrderCreatedEmailJob;
use App\Jobs\SendOrderDeliveredEmailJob;

class CustomerController extends Controller
{
    public function showRegister() { return view('customer.auth.register'); }
    public function showLogin() { return view('customer.auth.login'); }

    /**
     * Thay đổi tham số truyền vào thành CustomerRegisterRequest để tự động chạy bộ kiểm lỗi riêng.
     */
    public function register(CustomerRegisterRequest $request) {

        Customer::create([
            'full_name'     => $request->full_name,
            'email'         => $request->email,
            'password_hash' => Hash::make($request->password),
            'phone'         => $request->phone,
            'address'       => $request->address,
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công!');
    }

    /**
     * 🔥 ĐÃ CẬP NHẬT: Đăng nhập bằng SỐ ĐIỆN THOẠI và MẬT KHẨU
     */
    /**
     * Xử lý đăng nhập bằng SỐ ĐIỆN THOẠI và MẬT KHẨU
     * Tự động khóa tài khoản ngay lập tức khi gõ sai quá 5 lần
     */
    public function login(Request $request)
    {
        // 1. Validate dữ liệu đầu vào và captcha trước
        $request->validate([
            'phone'    => 'required|regex:/^[0-9]{10}$/',
            'password' => 'required',
            'captcha'  => 'required|string',
        ], [
            'phone.required' => 'Vui lòng không để trống số điện thoại.',
            'phone.regex'    => 'Số điện thoại phải bao gồm đúng 10 chữ số.',
            'password.required' => 'Vui lòng không để trống mật khẩu.',
        ]);

        // Kiểm tra Captcha
        if (strtolower($request->captcha) !== strtolower(session('custom_captcha'))) {
            return back()
                ->withErrors([
                    'captcha' => 'Mã captcha không đúng.'
                ])
                ->withInput($request->only('phone'));
        }

        $phone = trim($request->phone);

        // Key giới hạn đăng nhập theo số điện thoại để phòng thủ Brute Force
        $key = 'login-lock:' . $phone;

        // 🔥 KHỐI LỆNH KIỂM TRA: Nếu đã nhập sai quá 5 lần, chặn đứng và báo Khóa luôn
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);

            return back()
                ->withErrors([
                    'phone' => 'Tài khoản của bạn đã bị tạm khóa do nhập sai thông tin quá 5 lần. Vui lòng thử lại sau ' . $minutes . ' phút.'
                ])
                ->withInput($request->only('phone'));
        }

        // 2. Tìm customer theo SỐ ĐIỆN THOẠI trong DB
        $customer = Customer::where('phone', $phone)->first();

        // 3. Kiểm tra nếu customer tồn tại và khớp trường password_hash custom
        if ($customer && Hash::check($request->password, $customer->password_hash)) {

            // Xóa bộ đếm sai mật khẩu của số điện thoại này khi đăng nhập thành công
            RateLimiter::clear($key);

            // Đăng nhập customer vào hệ thống qua custom guard
            Auth::guard('customer')->login($customer, $request->has('remember'));

            $request->session()->regenerate();

            // Chuyển hướng sang trang quản lý/trang chủ
            return redirect()->intended('/');
        }

        // 🔥 HÀNH ĐỘNG KHI SAI THÔNG TIN (Sai mật khẩu hoặc số điện thoại không tồn tại)
        // Tăng số lần thử lên 1 (Lưu giữ trong 5 phút = 300 giây)
        RateLimiter::hit($key, 300);

        // Kiểm tra xem sau lần bấm sai này hệ thống đã chính thức đạt ngưỡng khóa chưa
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);


            return back()
                ->withErrors([
                    'phone' => 'Tài khoản của bạn đã bị tạm khóa do nhập sai thông tin quá 5 lần. Vui lòng thử lại sau ' . $minutes . ' phút.'
                ])
                ->withInput($request->only('phone'));
        }

        // Tính số lần còn lại để cảnh báo khách hàng
        $remaining = 5 - RateLimiter::attempts($key);

        return back()
            ->withErrors([
                'password' => 'Số điện thoại hoặc mật khẩu không đúng. Bạn còn ' . max($remaining, 0) . ' lần thử.'
            ])
            ->withInput($request->only('phone'));
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
            'sender_name'           => 'required|string',
            'sender_province'       => 'required|string',
            'sender_ward'           => 'required|string',
            'sender_address_detail' => 'required|string',

            'receiver_name'           => 'required|string',
            'receiver_province'       => 'required|string',
            'receiver_ward'           => 'required|string',
            'receiver_address_detail' => 'required|string',

            'weight_range' => 'required|string',
        ]);

        $tracking_id = 'CX-' . strtoupper(bin2hex(random_bytes(3)));

        $sender_address = $request->sender_address_detail . ', ' . $request->sender_ward . ', ' . $request->sender_province;
        $receiver_address = $request->receiver_address_detail . ', ' . $request->receiver_ward . ', ' . $request->receiver_province;
        $weight = $request->total_weight;

        $baseFee = 30000; // phí cơ bản
        $feePerKg = 10000; // mỗi kg thêm 10.000đ

        $shippingFee = $baseFee + ($weight * $feePerKg);
        $codAmount = $shippingFee;

        // LOGIC FIX: TỰ ĐỘNG CẬP NHẬT ĐỊA CHỈ MẶC ĐỊNH CHO KHÁCH HÀNG MỚI ĐĂNG KÝ
        if (auth('customer')->check()) {
            $customer = auth('customer')->user();
            if (is_null($customer->address) || trim($customer->address) === '') {
                $customer->update([
                    'address' => $sender_address
                ]);
            }
        }

        $weight_map = [
            'under_0.5' => 0.5,
            '0.5-1'     => 1.0,
            '1-2'       => 2.0,
            '2-5'       => 5.0,
            'above_5'   => 10.0,
        ];
        $total_weight = $weight_map[$request->weight_range] ?? 1.0;

        $weight = (float) $total_weight;

        $baseFee = 30000;
        $feePerKg = 10000;

        $shippingFee = $baseFee + ($weight * $feePerKg);
        $codAmount = $shippingFee;

        // Lưu dữ liệu vào Database
        \DB::table('couriers')->insert([
            'tracking_id'      => $tracking_id,
            'sender_name'      => $request->sender_name,
            'sender_address'   => $sender_address,
            'sender_phone'     => $request->sender_phone,

            'receiver_name'    => $request->receiver_name,
            'receiver_address' => $receiver_address,
            'receiver_phone'    => $request->receiver_phone,

            'total_weight'     => $total_weight,
            'status'           => 'pending',
            'customer_id'      => auth('customer')->check() ? auth('customer')->id() : null,

            'shipping_fee'     => $shippingFee,
            'cod_amount'       => $codAmount,
            'payment_method'   => 'cod',
            'payment_status'   => 'unpaid',

            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
    //Email
        if (auth('customer')->check()) {
            $newOrder         = Courier::where('tracking_id', $tracking_id)->first();
            $loggedInCustomer = auth('customer')->user();
            SendOrderCreatedEmailJob::dispatch($newOrder, $loggedInCustomer);
        }

        if (auth('customer')->check()) {
            return redirect()->route('customer.orders.index')
                ->with('success', 'Đặt đơn thành công! Mã vận đơn của bạn là: ' . $tracking_id);
        }

        return redirect()->route('booking')
            ->with('success', 'Đặt đơn thành công! Mã vận đơn của bạn là: ' . $tracking_id . '. Vui lòng lưu lại mã này để tra cứu.');
    }
    public function showTracking(Request $request)
    {
        $order = null;
        $tracking_id = $request->input('tracking_id');

        if ($tracking_id) {
            $tracking_id = trim($tracking_id);
            $order = \App\Models\Courier::where('tracking_id', $tracking_id)->first();

            if (!$order) {
                return back()->with('error', 'Không tìm thấy vận đơn: ' . $tracking_id . '. Vui lòng kiểm tra lại mã.');
            }
        }

        return view('customer.tracking', compact('order', 'tracking_id'));
    }

    public function showAbout() { return view('customer.about'); }
    public function showServices() { return view('customer.services'); }
    public function showContact() { return view('customer.contact'); }
    public function showServiceTerms() { return view('customer.terms'); }
    public function showServicePolicy() { return view('customer.policy'); }

    public function showFaq()
    {
        $faqs = \App\Models\Faq::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->groupBy('category');

        return view('customer.faq', compact('faqs'));
    }

    public function updateFcmToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        if (auth('customer')->check()) {
            auth('customer')->user()->update([
                'fcm_token' => $request->token
            ]);
            return response()->json(['success' => true, 'message' => 'Đã đồng bộ token thiết bị thành công.']);
        }

        return response()->json(['success' => false, 'message' => 'Chưa đăng nhập.'], 401);
    }

    public function payment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:couriers,id',
            'payment_method' => 'required|in:cod',
        ], [
            'order_id.required' => 'Không tìm thấy đơn hàng.',
            'order_id.exists' => 'Đơn hàng không tồn tại.',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
            'payment_method.in' => 'Phương thức thanh toán không hợp lệ.',
        ]);

        $order = Courier::where('id', $request->order_id)
            ->where('customer_id', auth('customer')->id())
            ->firstOrFail();

        if ($request->payment_method === 'cod') {
            $order->payment_method = 'cod';
            $order->payment_status = 'unpaid';
            $order->save();

            return redirect()
                ->route('customer.orders.index')
                ->with('success', 'Bạn đã chọn thanh toán khi nhận hàng COD.');
        }

        return back()->with('error', 'Phương thức thanh toán không hợp lệ.');
    }

    public function bookingBill(Courier $courier)
    {
        return view('customer.booking-bill', compact('courier'));
    }
}
