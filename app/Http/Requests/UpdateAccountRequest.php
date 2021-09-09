<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Auth;

class UpdateAccountRequest extends FormRequest
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
            //'email' => 'required|email|unique:customer,email',
            'address' => 'required',
            'ward_id' => 'required',
            'district_id' => 'required',
            'city_id' => 'required',
            'object' => 'required',
            'birthday' => 'required',
            'name' => 'required|min:3',
            'sex' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ tên không được để trống',
            'sex.required' => 'Vui lòng chọn giới tính',
            'object.required' => 'Vui lòng chọn đối tượng',
            'name.min' => 'Họ tên quá ngắn',
            'birthday.required' => 'Ngày sinh không được để trống',
            'city_id.required' => 'Bạn chưa chọn tỉnh thành phố',
            'district_id.required' => 'Bạn chưa chọn quận huyện',
            'ward_id.required' => 'Bạn chưa chọn phường xã',
            'address.required' => 'Địa chỉ cụ thể không được để trống',
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
