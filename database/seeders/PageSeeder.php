<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('pages')->truncate();
        $this->createPage();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return true;
    }
    public function createPage()
    {
        DB::table('pages')->insert([
            [
                'type' => 'home', 'content' => '', 'route' => 'home.index', 'name_page' => 'Trang chủ',
                'created_at' => now(), 'updated_at' => now(), 
            ],
            [
                'type' => 'about', 'content' => '', 'route' => 'home.about', 'name_page' => 'Giới thiệu',
                'created_at' => now(),'updated_at' => now() 
            ],
            [
                'type' => 'brands', 'content' => '', 'route' => 'home.brands', 'name_page' => 'Thương hiệu',
                'created_at' => now(),'updated_at' => now() 
            ],
            [
                'type' => 'login', 'content' => '', 'route' => 'home.login', 'name_page' => 'Đăng nhập',
                'created_at' => now(),'updated_at' => now() 
            ],
            [
                'type' => 'register', 'content' => '', 'route' => 'home.register', 'name_page' => 'Đăng ký',
                'created_at' => now(),'updated_at' => now() 
            ],
        ]);
    }
}
