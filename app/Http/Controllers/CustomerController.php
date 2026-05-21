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

    public function login(Request $request)
    {
        // 1. Validate dữ liệu đầu vào và captcha trước
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|string',
        ]);

        if (strtolower($request->captcha) !== strtolower(session('custom_captcha'))) {
            return back()
                ->withErrors([
                    'captcha' => 'Mã captcha không đúng.'
                ])
                ->withInput($request->only('email'));
        }

        $email = Str::lower($request->email);

        // Key giới hạn đăng nhập theo email
        $key = 'login-lock:' . $email;

        // Nếu đang bị khóa (quá 5 lần)
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);

            return back()
                ->withErrors([
                    'email' => 'Tài khoản đã bị khóa tạm thời do nhập sai mật khẩu quá 5 lần. Vui lòng thử lại sau ' . $minutes . ' phút.'
                ])
                ->withInput($request->only('email'));
        }

        // 2. Tìm customer theo email trong DB
        $customer = Customer::where('email', $email)->first();

        // 3. Kiểm tra nếu customer tồn tại và khớp trường password_hash custom
        if ($customer && Hash::check($request->password, $customer->password_hash)) {

            // Xóa bộ đếm sai mật khẩu của email này khi đăng nhập thành công
            RateLimiter::clear($key);

            // Đăng nhập customer vào hệ thống qua custom guard
            Auth::guard('customer')->login($customer, $request->has('remember'));

            $request->session()->regenerate();

            // Chuyển hướng sang trang quản lý/trang chủ
            return redirect()->intended('/');
        }

        // 4. Sai mật khẩu hoặc tài khoản không tồn tại -> tăng số lần thử lên 1
        RateLimiter::hit($key, 300); // Khóa 5 phút (300 giây) nếu đạt tối đa

        $remaining = 5 - RateLimiter::attempts($key);

        return back()
            ->withErrors([
                'password' => 'Mật khẩu không đúng. Bạn còn ' . max($remaining, 0) . ' lần thử.'
            ])
            ->withInput($request->only('email'));
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

        $weight_map = [
            'under_0.5' => 0.5,
            '0.5-1'     => 1.0,
            '1-2'       => 2.0,
            '2-5'       => 5.0,
            'above_5'   => 10.0,
        ];
        $total_weight = $weight_map[$request->weight_range] ?? 1.0;

        // Lưu dữ liệu vào Database
        \App\Models\Courier::create([
            'tracking_id'      => $tracking_id,
            'sender_name'      => $request->sender_name,
            'sender_address'   => $sender_address,
            'receiver_name'    => $request->receiver_name,
            'receiver_address' => $receiver_address,
            'total_weight'     => $total_weight,
            'status'           => 'pending',
            'customer_id'      => auth('customer')->check() ? auth('customer')->id() : null,
        ]);

        // Đã dọn dẹp các khối lệnh trùng lặp và đoạn code chết (dead code) ở phía cuối hàm cũ
        if (auth('customer')->check()) {
            return redirect()->route('customer.orders.index')
                ->with('success', 'Đặt đơn thành công! Mã vận đơn của bạn là: ' . $tracking_id);
        }

        // NẾU KHÁCH CHƯA ĐĂNG NHẬP -> Chuyển về trang đặt đơn (hoặc trang chủ)
        return redirect()->route('booking')
            ->with('success', 'Đặt đơn thành công! Mã vận đơn của bạn là: ' . $tracking_id . '. Vui lòng lưu lại mã này để tra cứu.');
    }

    public function showOrders(Request $request)
    {
        $customer = auth('customer')->user();

        $query = \App\Models\Courier::where('customer_id', $customer->id)->latest();

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Tìm kiếm theo tracking_id, tên người nhận hoặc người gửi
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('tracking_id', 'like', "%{$search}%")
                    ->orWhere('receiver_name', 'like', "%{$search}%")
                    ->orWhere('sender_name', 'like', "%{$search}%");
            });
        }

        // Sắp xếp
        if ($request->sort === 'oldest') {
            $query->oldest();
        }

        $orders = $query->paginate(8)->withQueryString();

        // Đếm số lượng theo từng trạng thái đơn hàng của khách hàng này
        $statusCounts = \App\Models\Courier::where('customer_id', $customer->id)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return view('customer.orders.index', compact('orders', 'statusCounts'));
    }

    public function showTracking(Request $request)
    {
        $order = null;
        $tracking_id = $request->input('tracking_id');

        if ($tracking_id) {
            // Xóa khoảng trắng 2 đầu nếu khách vô tình copy thừa
            $tracking_id = trim($tracking_id);

            // Truy vấn đơn hàng trong DB
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
        // Lấy tất cả câu hỏi đang hoạt động, sắp xếp theo thứ tự ưu tiên
        $faqs = \App\Models\Faq::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->groupBy('category'); // Gom nhóm theo danh mục cho dễ nhìn

        return view('customer.faq', compact('faqs'));
    }
    public function updateFcmToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        // Lưu hoặc cập nhật token của trình duyệt vào tài khoản khách hàng đang đăng nhập
        if (auth('customer')->check()) {
            auth('customer')->user()->update([
                'fcm_token' => $request->token
            ]);
            return response()->json(['success' => true, 'message' => 'Đã đồng bộ token thiết bị thành công.']);
        }

        return response()->json(['success' => false, 'message' => 'Chưa đăng nhập.'], 401);
    }
}
