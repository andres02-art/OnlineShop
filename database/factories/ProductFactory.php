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
            'img'=>fake()->text(),
            'name'=>fake()->name(),
            'prom'=>fake()->boolean(),
            'mark'=>fake()->name(),
            'promotion_id' => fake()->randomElement([1, 2, 3, 4, 5])
        ];
    }
}
