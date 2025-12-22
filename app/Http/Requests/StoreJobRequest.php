<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // change if needed
    }

    public function rules(): array
    {
        // $jobId = $this->route('job')?->id ?? $this->route('id');
        $jobId = $this->route('job');

        return [
            'title'         => 'required|string|max:255',
            'salary'        => 'nullable|string|max:255',
            'vacancy'       => 'nullable|string|max:255',
            'company'       => 'nullable|string|max:255',
            'educational'   => 'nullable|string|max:255',
            'experience'    => 'nullable|string|max:255',
            'additional'    => 'nullable|string|max:255',
            'thumb'         => 'nullable|string|max:50',
            'attachment'    => 'nullable|string|max:50',
            'type'          => 'required|in:full-time,part-time,contract',
            'gender'        => 'required|in:male,female,both,other',
            'apply'         => 'required|in:url,email,in-person,address',
            'apply_value'   => 'required|string|max:255',
            'category_id'   => 'nullable|exists:categories,id',
            'division_id'   => 'nullable|exists:divisions,id',
            'district_id'   => 'nullable|exists:districts,id',
            'thana_id'      => 'nullable|exists:thanas,id',
            'user_id'       => 'nullable|exists:users,id',
            'location'      => 'nullable|string|max:255',
            'source_link'   => 'nullable|url|max:255',
            // 'slug'          => ['nullable', 'string', 'max:255', 'unique:jobs,slug,' . $jobId],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('jobs', 'slug')->ignore($jobId),
            ],
            'status'        => 'nullable|boolean',
            'description'   => 'nullable|string',
            'views'         => 'nullable|integer|min:0',
            'meta_title'   => 'nullable|string',
            'meta_keyword'   => 'nullable|string',
            'meta_description'   => 'nullable|string',
        ];
    }
}
