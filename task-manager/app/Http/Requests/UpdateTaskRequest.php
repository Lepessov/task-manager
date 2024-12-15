<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Change to false if you need authorization checks
    }

    public function rules()
    {
        return [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:TODO,IN_PROGRESS,COMPLETED',
            'importance' => 'nullable|integer|min:1|max:5',
            'deadline' => 'nullable|date',
        ];
    }
}

