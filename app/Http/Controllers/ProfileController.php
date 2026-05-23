<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ProfileController extends Controller
{
    /**
     * TÍCH HỢP ROUTE VÀO CONTROLLER
     * Bạn chỉ cần gọi ProfileController::routes(); ở trong file routes/web.php
     */
    public static function routes()
    {
        Route::middleware(['auth:customer'])->prefix('customer')->name('customer.')->group(function () {

            // Route hiển thị trang thông tin (Trang Index)
            Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

            // Route hiển thị form chỉnh sửa (Trang Update)
            Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');

            // Route xử lý cập nhật dữ liệu (Đặt tên là profile.update để khớp với file Blade)
            Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');

            // 🔥 Route xử lý đặt vận đơn mới (Khớp với form và action của blade)
            Route::post('/booking', [ProfileController::class, 'postBooking'])->name('booking.post');

        });
    }

    /**
     * Hiển thị trang thông tin cá nhân
     */
    public function index()
    {
        // Lấy thông tin customer hiện tại
        $customer = Auth::guard('customer')->user();
        return view('customer.profile.index', compact('customer'));
    }

    /**
     * Hiển thị giao diện Form chỉnh sửa thông tin (update.blade.php)
     */
    public function editProfile()
    {
        $customer = Auth::guard('customer')->user();
        // Hãy đảm bảo đường dẫn view này đúng với thư mục của bạn
        return view('customer.profile.update', compact('customer'));
    }

    /**
     * Xử lý cập nhật dữ liệu từ form gửi lên
     */
    public function updateProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            // Validate email: định dạng email chuẩn và không trùng với người khác
            'email' => 'required|email:rfc,dns|unique:customers,email,' . $customer->id,
            // Validate SĐT: phải là số và đúng 10 ký tự (regex)
            'phone' => [
                'required',
                'regex:/^[0-9]{10}$/',
            ],
            'address' => 'nullable|string|max:500',
        ], [
            // Custom thông báo lỗi tiếng Việt
            'name.required' => 'Vui lòng không để trống họ tên.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Địa chỉ email không hợp lệ (thiếu @ hoặc sai định dạng).',
            'email.unique' => 'Email này đã được sử dụng bởi tài khoản khác.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.regex' => 'Số điện thoại phải bao gồm đúng 10 chữ số.',
        ]);

        $customer->update([
            'full_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('customer.profile.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function showOrders(Request $request)
    {
        $customer = auth('customer')->user();

        $query = \App\Models\Courier::where('customer_id', $customer->id)->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('tracking_id', 'like', "%{$search}%")
                    ->orWhere('receiver_name', 'like', "%{$search}%")
                    ->orWhere('sender_name', 'like', "%{$search}%");
            });
        }

        if ($request->sort === 'oldest') {
            $query->oldest();
        }

        $orders = $query->paginate(8)->withQueryString();

        $statusCounts = \App\Models\Courier::where('customer_id', $customer->id)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return view('customer.orders.index', compact('orders', 'statusCounts'));
    }

}
