<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            TypeSeeder::class,
            CarSeeder::class,
            PromotionSeeder::class,
        ]);

        Product::factory(100)->foreignID(Category::find(1))->create();
    }
}
