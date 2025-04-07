<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
            'email.exists' => 'El email no está registrado.',
            'password.required' => 'El password es obligatorio.',
        ];
    }
    public function attributes()
    {
        return [
            'email' => 'correo electrónico',
            'password' => 'contraseña',
        ];
    }
}
