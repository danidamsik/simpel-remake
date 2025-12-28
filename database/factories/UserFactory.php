<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'profile_path' => 'profile-user/profile.jpg',
            'role' => 'Bendahara',
        ];
    }

    /**
     * Role admin
     */
    public function admin(): static
    {
        return $this->state(fn() => [
            'role' => 'admin',
        ]);
    }

    /**
     * Role Bendahara
     */
    public function bendahara(): static
    {
        return $this->state(fn() => [
            'role' => 'Bendahara',
        ]);
    }
}
