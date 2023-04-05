<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\User;
use Spatie\Permission\Models\Role;
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
        Role::findOrCreate('admin', 'web');
        Role::findOrCreate('user', 'web');

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            TypeSeeder::class,
            CarSeeder::class,
            PromotionSeeder::class,
        ]);

        User::find(1)->assignRole('admin');
        Product::factory(100)->foreignID(Category::find(1))->create();

    }
}
