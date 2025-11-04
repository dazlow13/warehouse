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
       Category::factory(10)->create();
    }
}
