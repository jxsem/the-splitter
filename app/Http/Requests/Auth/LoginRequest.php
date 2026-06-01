<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * @class LoginRequest
 * @package App\Http\Requests\Auth
 * @description Form Request para validar y procesar solicitudes de login.
 * Valida credenciales, gestiona rate limiting y autentica al usuario.
 */
class LoginRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer esta solicitud.
     * Siempre devuelve true ya que el login es accesible públicamente.
     *
     * @return bool Verdadero si está autorizado
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas de validación para el login.
     * Requiere email válido y contraseña.
     *
     * @return array<string, ValidationRule|array<mixed>|string> Reglas de validación
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Intenta autenticar las credenciales de la solicitud.
     * Comprueba rate limiting, valida credenciales y dispara evento de lockout si falla.
     *
     * @return void
     * @throws \Illuminate\Validation\ValidationException Si la autenticación falla o está rate limitada
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Asegura que la solicitud de login no esté rate limitada.
     * Limita a 5 intentos fallidos por email/IP.
     *
     * @return void
     * @throws \Illuminate\Validation\ValidationException Si se ha excedido el límite de intentos
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Obtiene la clave de throttle para rate limiting.
     * Combina el email transliterado y la dirección IP del cliente.
     *
     * @return string Clave única para rate limiting (email|ip)
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
