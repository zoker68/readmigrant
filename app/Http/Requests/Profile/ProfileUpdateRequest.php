<?php

namespace App\Http\Requests\Profile;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string', 'min:2', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => ['required','email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'firstname' => ['required','string', 'min:2', 'max:20'],
            'lastname' => ['required','string', 'min:2', 'max:25'],
            'country_id' => ['required','exists:countries,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => "Поле Логин обязательное для заполнения",
            'name.min' => "Поле Логин не может быть меньше :min символов",
            'name.max' => "Поле Логин не может быть больше :max символов",
            'name.unique' => "Такой Логин уже существует. Выберите другой",

            'email.required' => "Поле Email обязательное для заполнения",
            'email.max' => "Поле Email не может быть больше :max символов",
            'email.unique' => "Такой Email уже существует. Восстановите пароль.",

            'password.required' => "Поле Пароль обязательное для заполнения",
            'password.confirmed' => "Пароли не совпадают",
            'password.min' => "Пароль должен быть длинее :min символов",

            'firstname.max' => 'Поле "Ваше имя" не может быть больше :max символов',
            'firstname.min' => 'Поле "Ваше имя" не может быть меньше :min символов',

            'lastname.max' => 'Поле "Ваша фамилия" не может быть больше :max символов',
            'lastname.min' => 'Поле "Ваша фамилия" не может быть меньше :min символов',

            'country_id.required' => 'Вы должны выбрать страну, в которой Вы проживаете',
            'country_id.exists' => 'Такой страны в нашей базе нет.',
        ];
    }
}
