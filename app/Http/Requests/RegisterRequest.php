<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Auth;


class RegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:customer,email',
            'user_name' => 'required|unique:customer,user_name',
            'phone' => 'required',
            'password' => [
                'required',
                'string',
                'min:6', 
                'confirmed',
            ],
            'password_confirmation' => 'required',
            'CaptchaCode' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'Tên đăng nhập không được để trống',
            'user_name.unique' => 'Tên đăng nhập này đã có người sử dụng',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email này đã có người sử dụng',
            'phone.required' => 'Số điện thoại không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.string' => 'Mật khẩu phải là chuỗi kí tự',
            'password.min' => 'Mật khẩu ít nhất phải 6 kí tự',
            'password.confirmed' => 'Nhập lại mật khẩu không khớp',
            'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu',
            'CaptchaCode.required' => 'Vui lòng nhập đúng mã captcha',
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

    public function withValidator($validator)
    {
        if (!$validator->fails()) {

            

            $validator->after(function ($validator) {

                $code = $this->CaptchaCode;
            
                $isHuman = captcha_validate($code);

                if ($isHuman) {
                    return true;
                } else {
                    $validator->errors()->add('CaptchaCode', 'Mã không chính xác');
                }
            });
        }
    }
}
