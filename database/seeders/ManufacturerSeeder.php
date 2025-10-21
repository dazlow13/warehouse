<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Manufacturer;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ nếu muốn dữ liệu sạch
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Manufacturer::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Faker
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Manufacturer::create([
                'name'        => $faker->company,
                'email'       => $faker->unique()->companyEmail,
                'phone'       => $faker->phoneNumber,
                'address'     => $faker->address,
                'description' => $faker->catchPhrase,
            ]);
        }
    }    
}
