<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionDetail>
 */
class TransactionDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */protected $model = TransactionDetail::class;

    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $qty = $this->faker->numberBetween(1, 50);

        return [
            'product_id' => $product?->id ?? Product::factory(),
            'manufacturer_id' => $product?->manufacturer_id,
            'quantity' => $qty,
            'unit_price' => $product?->sale_price ?? $this->faker->randomFloat(2, 10000, 100000),
        ];
    }
}
