<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   protected $model = Transaction::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement(['import', 'export']);
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'type' => $type,
            'note' => $this->faker->optional(0.7)->sentence,
            'quantity' => 0,
            'total_amount' => 0,
        ];
    }

    // Tạo kèm chi tiết
    public function withDetails($count = 3)
    {
        return $this->has(
            TransactionDetail::factory($count),
            'details'
        );
    }
}
