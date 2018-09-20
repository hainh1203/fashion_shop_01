<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'file' => 'nullable|image',
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
                    'not_published',
                ]),
            ],
            'brand_id' => 'nullable|exists:brands,id',
        ];
    }
}
