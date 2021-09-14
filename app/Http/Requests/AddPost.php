<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Auth;

class AddPost extends FormRequest
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
            'city_id'     => 'required',
            'district_id' => 'required',
            'address' => 'required',
            'type_housing' => 'required',
            'land_area' => 'required',
            'price' => 'required',
            'price2' => 'required',
            'title' => 'required|min:20|max:100',
            'content'   => 'required|min:30|max:3000',
        ];
    }

    public function messages()
    {
        return [
            'city_id.required' => 'Cần nhập thông tin này.',
            'district_id.required' => 'Cần nhập thông tin này.',
            'address.required' => 'Cần nhập thông tin này.',
            'type_housing.required' => 'Cần nhập thông tin này.',
            'land_area.required' => 'Cần nhập thông tin này.',
            'price.required' => 'Cần nhập thông tin này.',
            'price2.required' => 'Cần nhập thông tin này.',
            'title.required' => 'Cần nhập thông tin này.',
            'title.min' => 'Tiêu đề ít nhất 20 ký tự.',
            'title.max' => 'Tiêu đề ít nhất 100 ký tự.',
            'content.required' => 'Cần nhập thông tin này.',
            'content.min' => 'Mô tả ít nhất 30 ký tự.',
            'content.max' => 'Mô tả ít nhất 3000 ký tự.',
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
