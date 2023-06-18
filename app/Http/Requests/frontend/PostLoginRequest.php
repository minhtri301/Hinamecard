<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'login_code' => 'required|max:6|min:6',
        ];
    }

    protected function failedValidation(Validator $validator) { 
        
        throw new HttpResponseException(response()->json(
                [
                    'success' => false,
                    'errorMessage'=>$validator->messages()
                ]
            )
        ); 
    }
}
