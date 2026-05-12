<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    public function index()
    {
        // Lấy thông tin customer hiện tại
        $customer = Auth::guard('customer')->user();
        return view('customer.profile.index', compact('customer'));
    }

    public function editProfile()
    {
        $customer = Auth::guard('customer')->user();
        // Hãy đảm bảo đường dẫn view này đúng với thư mục của bạn
        return view('customer.profile.update', compact('customer'));
    }
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
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
        ]);

        return redirect()->route('customer.profile.index')->with('success', 'Cập nhật thông tin thành công!');
    }
}
