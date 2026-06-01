<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @class UserFactory
 * @package Database\Factories
 * @description Factory para crear instancias de modelo User con datos generados.
 * Proporciona valores por defecto y estados para facilitar testing.
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define el estado por defecto del modelo.
     * Genera valores realistas para todos los atributos del usuario.
     *
     * @return array<string, mixed> Array de atributos del modelo con valores generados
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indica que la dirección de email del usuario no está verificada.
     * Anula el estado de verificación por defecto.
     *
     * @return static Instancia de la factory para encadenamiento
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
