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
     */public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ];
    }
    //admin
    public function admin(): self
    {
        return $this->state([
            'name' => 'Admin',
            'email' => 'admin@warehouse.com',
            'password' => bcrypt('123456'),
        ]);
    }

    //  Thủ kho
    public function warehouseman(): self
    {
        return $this->state([
            'name' => 'Thủ kho A',
            'email' => 'thukho@warehouse.com',
            'password' => bcrypt('kho123'),
        ]);
    }
}
