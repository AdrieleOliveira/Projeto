<?php

namespace Database\Seeders;

use Faker\Provider\DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $token = Str::random(60);

        DB::table('users')->insert([
            'name' => 'Hipe',
            'email' => 'teste@gmail.com',
            'password' => 'hipe@2020',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'remember_token' => $token,
        ]);
    }
}
