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
            'season'=>1,
            'active'=>true,
            'date_begin'=>date('2023-03-14 00:00'),
            'date_end'=>date('2023-04-14 00:00'),
        ]);
        DB::table('promotions')->insert([
            'name'=>'Verano',
            'season'=>1,
            'active'=>false,
            'date_begin'=>date('2023-06-14 00:00'),
            'date_end'=>date('2023-07-14 00:00'),
        ]);
        DB::table('promotions')->insert([
            'name'=>'Otoño',
            'season'=>1,
            'active'=>false,
            'date_begin'=>date('2023-09-14 00:00'),
            'date_end'=>date('2023-10-14 00:00'),
        ]);
        DB::table('promotions')->insert([
            'name'=>'Invierno',
            'season'=>1,
            'active'=>false,
            'date_begin'=>date('2023-12-14 00:00'),
            'date_end'=>date('2024-01-14 00:00'),
        ]);
        DB::table('promotions')->insert([
            'name'=>'Black friday',
            'season'=>1,
            'active'=>false,
            'date_begin'=>date('2023-10-14 00:00'),
            'date_end'=>date('2023-11-14 00:00'),
        ]);
    }
}
