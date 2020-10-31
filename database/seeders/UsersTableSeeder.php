<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'hipe',
            'email' => 'teste@gmail.com',
            'password' => 'hipe@2020'
        ]);
    }
}
