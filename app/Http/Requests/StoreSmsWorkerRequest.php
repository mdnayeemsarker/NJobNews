<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSmsWorkerRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'receiver'   => ['required', 'string', 'max:20'],
            'body'       => ['required', 'string', 'max:255'],
            'body_second' => ['nullable', 'string', 'max:255'],
            'sender'     => ['nullable', 'string', 'max:20'],
            'first_sms'  => ['nullable', 'string', 'max:255'],
            'second_sms' => ['nullable', 'string', 'max:255'],
            'third_sms' => ['nullable', 'string', 'max:255'],
            'status'     => ['nullable', 'in:create,sent,paid,complete'],
        ];
    }
    public function messages(): array
    {
        return [
            'receiver.required' => 'Receiver number is required.',
            'body.required'     => 'SMS body is required.',
            'status.in'         => 'Invalid status value.',
        ];
    }
}
