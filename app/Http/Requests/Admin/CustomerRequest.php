<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerRequest extends FormRequest
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
            'user_name' => 'required|min:8|unique:customer,user_name,'.($this->id ? "$this->id" : ''),
            'login_code' => 'unique:customer,login_code,'.($this->id ? "$this->id" : ''),
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'Vui lòng điền tên đăng nhập.',
            'user_name.min' => 'Tên đăng nhập ít hơn 8 ký tự',
            'user_name.unique' => 'Tên đăng nhập đã tồn tại',
            'login_code.unique' => 'Mã đã tồn tại. Vui lòng đổi mã mới',
        ];
    }
}
