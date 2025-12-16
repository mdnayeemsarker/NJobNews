<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Get the ad ID when updating
        $adId = $this->route('ad') ?? null;

        return [
            'location' => ['required', 'string', 'max:255', Rule::unique('ads', 'location')->ignore($adId)],
            'thumb' => ['required', 'string', 'max:255'],
            'link' => ['nullable', 'url', 'max:255'],
            'height' => ['nullable', 'string', 'max:50'],
            'width' => ['nullable', 'string', 'max:50'],
        ];
    }
}
