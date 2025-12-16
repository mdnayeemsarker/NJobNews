<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // You can customize this based on roles or permissions
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'thumb' => 'nullable|string',
            'video_link' => 'nullable|url|max:255',
            'status' => 'nullable|boolean',
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'A gallery title is required.',
            'thumb.string' => 'The thumbnail must be a valid URL.',
            'video_link.url' => 'The video link must be a valid URL.',
        ];
    }
}
