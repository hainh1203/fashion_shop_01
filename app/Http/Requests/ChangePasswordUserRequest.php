<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordUserRequest extends FormRequest
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
            'current_password' => [
                'required',
                'string',
                'min:6',
                function ($attribute, $value, $fail) {
                    if (!(Hash::check($value, Auth::user()->password))) {
                        return $fail(__($attribute . '_is_incorrect'));
                    }
                },
            ],
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
