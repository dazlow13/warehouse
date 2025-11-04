<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Văn phòng phẩm',
                'Đồ gia dụng',
                'Thực phẩm',
                'Điện tử',
                'Thời trang',
                'Sách vở',
                'Đồ chơi',
                'Thể thao',
                'Mỹ phẩm'
            ]),
            'image' => null,
        ];
    }
}
