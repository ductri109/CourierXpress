<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'FullName' => 'required|string|max:255',
            'Username' => 'required|string|max:100|unique:agents,Username',
            'Email'    => 'required|email|unique:agents,Email',
            'Phone'    => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'FullName.required' => 'Vui lòng nhập họ và tên người đại diện bưu cục.',
            'Username.required' => 'Vui lòng nhập tên đăng nhập hệ thống.',
            'Username.unique'   => 'Tên đăng nhập đại lý này đã tồn tại trên hệ thống.',
            'Email.required'    => 'Vui lòng điền địa chỉ email liên hệ.',
            'Email.email'       => 'Địa chỉ email không đúng định dạng.',
            'Email.unique'      => 'Email đại lý này đã được sử dụng.',
            'Phone.required'    => 'Vui lòng nhập số điện thoại đại lý.',
            'password.required' => 'Vui lòng thiết lập mật khẩu bảo mật.',
            'password.min'      => 'Mật khẩu đại lý bắt buộc từ 6 ký tự trở lên.',
            'password.confirmed'=> 'Mật khẩu xác nhận lại không trùng khớp.',
        ];
    }
}
