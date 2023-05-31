<?php

namespace App\Http\Requests\Admin\Country;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|string|size:2|unique:countries,id',
            'title' => 'required|string',
            'order' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'id.unique' => 'ISO Код должен быть уникальным. Такой уже есть.',
            'id.required' => 'ISO Код обязателен для заполнения',
            'id.size' => 'Длина ISO Кода должна быть 2 символа',
            'title.required' => 'Поле название обязательно для заполнения',
            'order.required' => 'Поле порядок для заполнения',
        ];
    }
}
