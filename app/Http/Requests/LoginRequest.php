<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Auth;

class LoginRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập tên tài khoản hoặc địa chỉ email',
            'password.required' => 'Vui lòng nhập mật khẩu'
        ];
    }

    protected function failedValidation(Validator $validator) { 
        //write your bussiness logic here otherwise it will give same old JSON response
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

                $login_type = filter_var($this->email, FILTER_VALIDATE_EMAIL ) 
                ? 'email' 
                : 'user_name';
            if($login_type == 'email'){
                $credentials = array('email' => $this->email, 'password' => $this->password);
            }else{
                $credentials = array('user_name' => $this->email, 'password' => $this->password);
            }
                
            if(Auth::guard('customer')->attempt($credentials)){
                if(Auth::guard('customer')->user()->confirmed != 1){

                    $validator->errors()->add('login_error', 'Tài khoản chưa được xác nhận,vui lòng kiểm tra email để xác nhận tài khoản.');
    
                }
                
                return true;
            }

            $validator->errors()->add('login_error', 'Thông tin đăng nhập không chính xác');
                
            });
        }
    }
}
