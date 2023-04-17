<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Promotion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function foreignID(Category $Category)
    {
        return $this->state([
            'category_id' => $Category->id,
        ]);
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'precio'=>fake()->randomFloat(),
            'catalogo'=>fake()->text(),
            'description'=>fake()->text(),
            'img'=>fake()->randomElement([
                'lWO4k7DTNC5oJ7prMmTvLqoNRUK4Dj.jpg',
                'n8HrBWSyuI8VivLRgA5ObEc10HMWJD.jpg',
                null
            ]),
            'name'=>fake()->name(),
            'stock'=>fake()->randomNumber(),
            'prom'=>fake()->boolean(),
            'mark'=>fake()->name(),
            'promotion_id' => fake()->randomElement([1, 2, 3, 4, 5])
        ];
    }
}
