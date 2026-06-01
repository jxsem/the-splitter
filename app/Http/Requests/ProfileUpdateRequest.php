<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @class ProfileUpdateRequest
 * @package App\Http\Requests
 * @description Form Request para validar los datos de actualización del perfil de usuario.
 * Valida que el nombre y email sean válidos, y que el email sea único en la base de datos.
 */
class ProfileUpdateRequest extends FormRequest
{
    /**
     * Define las reglas de validación para la actualización del perfil.
     * Valida nombre y email, asegurando que el email sea único excepto para el usuario actual.
     *
     * @return array<string, ValidationRule|array<mixed>|string> Reglas de validación
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }
}
