<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|max:150',
            'price' => 'nullable|integer',
            'sale' => 'nullable|integer|digits_between:1,100',
            'file' => 'required|image',
            'excerpt' => 'nullable',
            'description' => 'nullable',
            'feature' => [
                'nullable',
                Rule::in([0, 1]),
            ],
            'status' => [
                'required',
                Rule::in([
                    'published',
                    'not-published',
                ]),
            ],
            'brand_id' => 'nullable|exists:brands,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @ return  array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
