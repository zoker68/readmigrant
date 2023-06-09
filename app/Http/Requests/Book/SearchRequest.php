<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'search' => ['nullable','string'],
            'searchCity' => ['nullable','string'],
            'genre' => ['nullable','array'],
            'genre.*' => ['int','exists:genres,id'],


            'page' => 'nullable|integer', //pagination
        ];
    }
}
