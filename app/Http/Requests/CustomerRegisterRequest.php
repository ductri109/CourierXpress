<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRegisterRequest extends FormRequest
{
    /**
     * Cho phép tất cả người dùng thực hiện request này.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Định nghĩa quy tắc kiểm tra dữ liệu chính xác theo form Customer.
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:customers,email',
            'phone'     => 'required|string|max:20|unique:customers,phone',
            'password'  => 'required|string|min:6|confirmed',
            'address'   => 'nullable|string|max:255',
        ];
    }

    /**
     * Các câu thông báo lỗi Tiếng Việt hiển thị riêng cho Customer.
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'Vui lòng nhập họ và tên.',
            'email.required'     => 'Vui lòng nhập địa chỉ email.',
            'email.email'        => 'Địa chỉ email không đúng định dạng.',
            'email.unique'       => 'Địa chỉ email này đã được đăng ký trước đó.',
            'phone.required'     => 'Vui lòng cung cấp số điện thoại.',
            'phone.unique'       => 'Số điện thoại này đã được sử dụng trên hệ thống.',
            'password.required'  => 'Vui lòng điền mật khẩu đăng nhập.',
            'password.min'       => 'Mật khẩu tài khoản phải tối thiểu từ 6 ký tự.',
            'password.confirmed' => 'Xác nhận lại mật khẩu chưa chính xác.',
            'address.max'        => 'Địa chỉ không được vượt quá 255 ký tự.',
        ];
    }
}
