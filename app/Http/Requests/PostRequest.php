<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // You can add any additional authorization logic here
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'          => 'required|string|max:255',
            'sub_title_1'    => 'nullable|string|max:255',
            'sub_title_2'    => 'nullable|string|max:255',
            'thumb'          => 'nullable|string',
            'thumb_caption'  => 'nullable|string',
            'category_id'    => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'division_id'    => 'nullable|exists:divisions,id',
            'district_id'    => 'nullable|exists:districts,id',
            'thana_id'       => 'nullable|exists:thanas,id',
            'is_slider'      => 'nullable|boolean',
            'is_breaking'    => 'nullable|boolean',
            'is_featured'    => 'nullable|boolean',
            'is_recommended' => 'nullable|boolean',
            'status'         => 'nullable|boolean',
            'short_content'  => 'nullable|string',
            'content'        => 'nullable|string',
            'slug'           => 'required|string|unique:posts,slug|max:255',
            'read_more_link' => 'nullable|url|max:255',
            'tags'           => 'nullable|string|max:255',
            'view'           => 'nullable|integer',
            'meta_title'     => 'nullable|string|max:255',
            'meta_keywords'  => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ];
    }

    /**
     * Get the custom error messages for the validator.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required'          => 'The post title is required.',
            'title.string'            => 'The post title must be a string.',
            'title.max'               => 'The post title cannot exceed 255 characters.',            
            'sub_title_1.string'      => 'The first subtitle must be a string.',
            'sub_title_1.max'         => 'The first subtitle cannot exceed 255 characters.',            
            'sub_title_2.string'      => 'The second subtitle must be a string.',
            'sub_title_2.max'         => 'The second subtitle cannot exceed 255 characters.',            
            'thumb.string'            => 'The thumbnail must be a valid string.',
            'thumb_caption.string'    => 'The thumbnail caption must be a valid string.',
            'category_id.exists'      => 'The selected category does not exist.',
            'subcategory_id.exists'   => 'The selected subcategory does not exist.',
            'division_id.exists'      => 'The selected division does not exist.',
            'district_id.exists'      => 'The selected district does not exist.',
            'thana_id.exists'         => 'The selected thana does not exist.',            
            'is_slider.boolean'       => 'The slider field must be true or false.',
            'is_breaking.boolean'     => 'The breaking news field must be true or false.',
            'is_featured.boolean'     => 'The featured field must be true or false.',
            'is_recommended.boolean'  => 'The recommended field must be true or false.',            
            'status.boolean'          => 'The status must be true or false.',            
            'short_content.string'    => 'The short content must be a string.',
            'content.string'          => 'The content must be a string.',            
            'slug.required'           => 'The slug is required.',
            'slug.string'             => 'The slug must be a valid string.',
            'slug.unique'             => 'The slug has already been taken.',
            'slug.max'                => 'The slug cannot exceed 255 characters.',            
            'read_more_link.url'      => 'The read more link must be a valid URL.',
            'read_more_link.max'      => 'The read more link cannot exceed 255 characters.',            
            'tags.string'             => 'The tags must be a valid string.',
            'tags.max'                => 'The tags cannot exceed 255 characters.',            
            'meta_title.string'       => 'The meta title must be a string.',
            'meta_title.max'          => 'The meta title cannot exceed 255 characters.',            
            'meta_keywords.string'    => 'The meta keywords must be a string.',
            'meta_keywords.max'       => 'The meta keywords cannot exceed 255 characters.',            
            'meta_description.string' => 'The meta description must be a string.',
        ];
    }    
}
