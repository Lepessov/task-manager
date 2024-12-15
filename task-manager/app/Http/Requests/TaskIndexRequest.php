<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskIndexRequest extends FormRequest
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
            'status' => 'nullable|in:TODO,IN_PROGRESS,COMPLETED',
        ];
    }

    public function messages(): array
    {
        return [
            'status.in' => 'The selected status is invalid. Please choose from TODO, IN_PROGRESS, or COMPLETED.',
        ];
    }
}
