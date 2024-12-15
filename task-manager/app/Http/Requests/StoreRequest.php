<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:TODO,IN_PROGRESS,COMPLETED',
            'importance' => 'required|integer|between:1,5',
            'deadline' => 'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            // 'title' validation messages
            'title.required' => 'Заголовок задачи обязателен.',
            'title.string' => 'Заголовок задачи должен быть строкой.',
            'title.max' => 'Заголовок задачи не должен превышать 255 символов.',

            // 'description' validation messages
            'description.required' => 'Описание задачи обязательно.',
            'description.string' => 'Описание задачи должно быть строкой.',

            // 'status' validation messages
            'status.required' => 'Статус задачи обязателен.',
            'status.in' => 'Статус задачи должен быть одним из следующих: TODO, IN_PROGRESS, COMPLETED.',

            // 'importance' validation messages
            'importance.required' => 'Укажите важность задачи.',
            'importance.integer' => 'Важность задачи должна быть целым числом.',
            'importance.between' => 'Важность задачи должна быть в пределах от 1 до 5.',

            // 'deadline' validation messages
            'deadline.date' => 'Дата дедлайна должна быть корректной датой.',
        ];
    }
}
