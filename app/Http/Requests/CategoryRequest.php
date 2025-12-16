<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title' => 'required|string|max:250',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $this->route('category'),
            'image_url' => 'nullable|string',
            'status' => 'required|boolean',
            'in_order' => 'required|integer',
            'meta_title' => 'nullable|string|max:250',
            'meta_tag' => 'nullable|string|max:250',
            'meta_description' => 'nullable|string|max:500',
        ];
    }

    /**
     * Customize the error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'This field get only 255 Charecter.',
            'in_order.required' => 'The Order field is required.',
            'in_order.integer' => 'The Order must be an integer.',
            'slug.required' => 'The Slug field is required.',
            'slug.max' => 'This field get only 255 Charecter.',
            'slug.unique' => 'The Slug has already been taken.',
            'status.required' => 'The Status field is required.',
            'status.boolean' => 'The Status must be true or false.',
            'meta_title.max' => 'This field get only 255 Charecter.',
            'meta_tag.max' => 'This field get only 255 Charecter.',
            'meta_description.max' => 'This field get only 500 Charecter.',
        ];
    }
}
