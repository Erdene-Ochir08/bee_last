<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'category_id' => [
                'required',
                'integer'
            ],
            'gender_id' => [
                'required',
                'integer'
            ],
            'name' => [
                'required',
                'string'
            ],
            'slug' => [
                'required',
                'string',
                'max:255'
            ],
            'brand' => [
                'required',
                'string'
            ],
            'small_description' => [
                'required',
                'string'
            ],
            'description' => [
                'required',
                'string'
            ],
            'trending' => [
                'nullable'
            ],
            'status' => [
                'nullable'
            ],
            'sale_percent' => [
                'integer',
                'nullable',
                'min:0',
                'max:100',
            ],
            'price' => [
                'required',
                'integer'
            ],
            'quantity' => [
                'required',
                'min:1',
                'integer'
            ],
            'image' => [
                'required'
            ]
        ];
    }
}
