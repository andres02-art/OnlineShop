<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promotions')->insert([
            'name'=>'Primavera',
        ]);
        DB::table('promotions')->insert([
            'name'=>'Verano'
        ]);
        DB::table('promotions')->insert([
            'name'=>'Otoño'
        ]);
        DB::table('promotions')->insert([
            'name'=>'Invierno'
        ]);
        DB::table('promotions')->insert([
            'name'=>'Black friday'
        ]);
    }
}
