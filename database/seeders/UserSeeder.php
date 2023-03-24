<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'andres',
            'email'=>'a.arregoces35@gmail.com',
            'password'=>bcrypt('Andres.02'),
            'second_name'=>'david',
            'last_name'=>'Arregoces Cuero',
            'credentials'=>'1000851592',
            'born_date'=>date('2003-09-03 23:30'),
            'death_date'=>null,
            'catalogo'=>null,
            'description'=>null,
            'users_vip'=>false
        ]);
    }
}
