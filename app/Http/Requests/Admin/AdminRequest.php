<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_name' => 'required|min:8|unique:users,user_name,'.($this->id ? "$this->id" : ''),
            'password'      => 'required|min:8',
            'repassword'    => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'Vui lòng điền tên đăng nhập.',
            'user_name.min' => 'Tên đăng nhập ít hơn 8 ký tự',
            'user_name.unique' => 'Tên đăng nhập đã tồn tại',
            'password.required' => 'Vui lòng điền mật khẩu.',
            'password.min' => 'Mật khẩu ít hơn 8 ký tự.',
            'repassword.required' => 'Vui lòng điền lại mật khẩu.', 
            'repassword.same' => 'Mật khẩu không khớp',
        ];
    }
}
