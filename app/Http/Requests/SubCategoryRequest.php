<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Adjust as per your authorization needs
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:250',
            'slug' => 'required|string|max:255|unique:sub_categories,slug,' . $this->route('sub_category'),
            'image_url' => 'nullable|string',
            'is_menu' => 'nullable|boolean',
            'status' => 'required|boolean',
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
            'category_id.required' => 'The category field is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'title.required' => 'The title field is required.',
            'title.max' => 'The title cannot be longer than 250 characters.',
            'slug.required' => 'The slug field is required.',
            'slug.max' => 'The slug cannot be longer than 255 characters.',
            'slug.unique' => 'This slug has already been taken.',
            'status.required' => 'The status field is required.',
            'status.boolean' => 'The status must be either true or false.',
            'is_menu.boolean' => 'The menu status must be true or false.',
            'meta_title.max' => 'The meta title cannot be longer than 250 characters.',
            'meta_tag.max' => 'The meta tag cannot be longer than 250 characters.',
            'meta_description.max' => 'The meta description cannot be longer than 500 characters.',
        ];
    }
}
