<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $price = number_format(rand(100, 10000), 2,'.','');
        $qty = rand(1, 1000);
        return [
            'product_name' => $this->faker->name(),
            'price' =>$price,
            'quantity' => $qty,
            'description' => $this->faker->text(),
            'profileimage' => $this->faker->imageUrl(100, 100),
            'status'=>'active',
        ];
    }
}
