<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => ['required','string','min:2','max:255'],
            'author' => ['required','string','min:2','max:255'],
            'genre' => ['required','exists:genres,id'],
            'description' => ['nullable', 'string'],
            'image_main' => ['nullable','image','dimensions:min_width=300,min_height=300'],
            'country_id' => ['required','exists:countries,id'],
            'city' => ['required','min:2','max:50'],
            'conditions' => ['nullable','string'],
            'is_published' => ['nullable','boolean'],
            'mailed' => ['nullable','boolean'],
            'send_border' => ['nullable','boolean'],
        ];
    }


    public function messages(): array
    {
        return [
            'title.required' => "Поле НАЗВАНИЕ КНИГИ обязательное для заполнения",
            'title.min' => "Поле НАЗВАНИЕ КНИГИ не может быть меньше :min символов",
            'title.max' => "Поле НАЗВАНИЕ КНИГИ не может быть больше :max символов",

            'author.required' => "Поле Автор обязательное для заполнения",
            'author.min' => "Поле Автор не может быть меньше :min символов",
            'author.max' => "Поле Автор не может быть больше :max символов",
            'author.unique' => "Такой Автор уже существует. Выберите другой",

            'genre.required' => "Вы должны выбрать хотя бы 1 жанр обязательное для заполнения",
            'genre.exists' => "Какая-то проблема с жанром, который Вы выбрали",

            'image_main.image' => "Обложка должен быть в формате картинки",
            'image_main.dimensions' => "Минимальные размеры обложки: :min_width x :min_height",

            'country_id.required' => 'Вы должны выбрать страну, в которой Вы проживаете',
            'country_id.exists' => 'Такой страны в нашей базе нет.',

            'city.required' => "Поле Город обязательное для заполнения",
            'city.min' => "Поле Город не может быть меньше :min символов",
            'city.max' => "Поле Город не может быть больше :max символов",
        ];
    }
}
