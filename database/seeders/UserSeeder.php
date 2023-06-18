<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'user_name' => 'adminjks',
            'name' => 'Administrators',
            'avatar' => '/backend/img/personal-security.png',
            'email' => 'quanghoang321@gmail.com',
            'password' => Hash::make('JKSadmin123@'),
            'active' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
