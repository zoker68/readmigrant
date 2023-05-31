<?php

namespace App\Http\Requests\Profile;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileAvatarUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => ['required','image','dimensions:min_width=100,min_height=100']
        ];
    }

    public function messages(): array
    {
        return [
            'avatar.required' => "Вы не выбрали аватар",
            'avatar.image' => "Аватар должен быть в формате картинки",
            'avatar.dimensions' => "Минимальные размеры аватара: :min_width x :min_height",
        ];
    }
}
