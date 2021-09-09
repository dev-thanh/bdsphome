<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!\Hash::check($value, auth('customer')->user()->password)) {
                    return $fail(__('Mật khẩu hiện tại không chính xác'));
                }
            }],
            'new_password' => 'required|min:4',
            'confirm' => 'required|same:new_password'
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới',
            'new_password.min' => 'Mật khẩu mới ít nhất 4 kí tự',
            'confirm.required' => 'Vui lòng nhập lại mật khẩu mới',
            'confirm.same' => 'Nhập lại mật khẩu không khớp',
        ];
    }
}
