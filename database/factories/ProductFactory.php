<?php

namespace Database\Factories;


use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'product_name' => $this->faker->word,
            'product_price' => $this->faker->randomFloat(2, 1, 100),
            'expired_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
