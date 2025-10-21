<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;
use Faker\Factory as Faker;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categoryIds = Category::pluck('id')->toArray();
        $manufacturerIds = Manufacturer::pluck('id')->toArray();
        for ($i = 0; $i < 20; $i++) {
            Product::create([
                'name' => $faker->word,
                'category_id' => $faker->randomElement($categoryIds),
                'manufacturer_id' => $faker->randomElement($manufacturerIds),
                'quantity' => $faker->numberBetween(1, 100),
                'unit' => $faker->randomElement(['piece', 'kg', 'litre']),
                'cost_price' => $faker->randomFloat(2, 10, 100),
                'sale_price' => $faker->randomFloat(2, 20, 150),
                'description' => $faker->sentence,
                'image' => null
            ]);
        }
    }
}
