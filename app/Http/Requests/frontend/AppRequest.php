<?php

namespace App\Http\Requests\frontend;

use App\Models\Information_icon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use function Aws\filter;

class AppRequest extends FormRequest
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
            'id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Vui lòng chọn ứng dụng.',
        ];
    }
    
    protected function failedValidation(Validator $validator) { 
        
        throw new HttpResponseException(response()->json([
                'success' => false,
                'errorMessage'=>$validator->messages()
            ])
        ); 
    }

    // public function withValidator(Validator $validator){
    //     if($validator->failed()){
    //         $validator->after(function ($validator) {
    //             $input = $this->addInput; 
    //             if(!empty($input)){
    //                 $app = Information_icon::find($this->id); 
    //                 if($app->icon_type=='link'){
    //                     $check = filter_var($input, FILTER_VALIDATE_URL);
    //                     if(!empty($check)){
    //                         $validator->errors()->add('addInput','Đường dẫn không chính xác.');
    //                     }
    //                 }
    //             }
    //         });
    //     }
    // }
}
