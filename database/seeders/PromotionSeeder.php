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
            'season'=>0,
            'active'=>false,
            'date_begin'=>date('2023-02-14 00:00'),
            'date_end'=>date('2023-04-14 00:00'),
        ]);
        DB::table('promotions')->insert([
            'name'=>'Verano',
            'season'=>0,
            'active'=>false,
            'date_begin'=>date('2023-02-14 00:00'),
            'date_end'=>date('2023-04-14 00:00'),
        ]);
        DB::table('promotions')->insert([
            'name'=>'Otoño',
            'season'=>0,
            'active'=>false,
            'date_begin'=>date('2023-02-14 00:00'),
            'date_end'=>date('2023-04-14 00:00'),
        ]);
        DB::table('promotions')->insert([
            'name'=>'Invierno',
            'season'=>0,
            'active'=>false,
            'date_begin'=>date('2023-02-14 00:00'),
            'date_end'=>date('2023-04-14 00:00'),
        ]);
        DB::table('promotions')->insert([
            'name'=>'Black friday',
            'season'=>0,
            'active'=>false,
            'date_begin'=>date('2023-02-14 00:00'),
            'date_end'=>date('2023-04-14 00:00'),
        ]);
    }
}
