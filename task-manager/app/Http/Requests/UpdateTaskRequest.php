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

    public function messages()
    {
        return [
            'title.nullable' => 'Заголовок задачи может быть пустым.',
            'title.string' => 'Заголовок задачи должен быть строкой.',
            'title.max' => 'Заголовок задачи не может превышать 255 символов.',

            'description.nullable' => 'Описание задачи может быть пустым.',
            'description.string' => 'Описание задачи должно быть строкой.',

            'status.nullable' => 'Статус задачи может быть пустым.',
            'status.string' => 'Статус задачи должен быть строкой.',
            'status.in' => 'Статус задачи должен быть одним из: TODO, IN_PROGRESS, COMPLETED.',

            'importance.nullable' => 'Важность задачи может быть пустой.',
            'importance.integer' => 'Важность задачи должна быть числом.',
            'importance.min' => 'Важность задачи не может быть меньше 1.',
            'importance.max' => 'Важность задачи не может быть больше 5.',

            'deadline.nullable' => 'Дата дедлайна может быть пустой.',
            'deadline.date' => 'Дата дедлайна должна быть корректной датой.',
        ];
    }

}

