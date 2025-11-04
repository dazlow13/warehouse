<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
   public function definition()
    {
        $costPrice = $this->faker->randomFloat(2, 10, 100);
        $profit = $this->faker->randomFloat(2, 1.2, 2.5);
        $salePrice = $costPrice * $profit;

        return [
            'name' => $this->faker->words(3, true),
            'category_id' => Category::inRandomOrder()->first()?->id,
            'manufacturer_id' => Manufacturer::inRandomOrder()->first()?->id,
            'quantity' => $this->faker->numberBetween(0, 200),
            'unit' => $this->faker->randomElement(['chiếc', 'kg', 'lít', 'hộp', 'cái', 'bộ']),
            'cost_price' => $costPrice,
            'sale_price' => $salePrice,
            'description' => $this->faker->optional(0.7)->paragraph,
            'image' => null,
        ];
    }
}
