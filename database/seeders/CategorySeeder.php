<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();
        
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => $faker->word,
                'image' => null,
            ]);
        }
    }
}
