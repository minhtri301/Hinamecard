<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('settings')->truncate();
        $this->createOption();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return true;
    }

    public function createOption(){
        DB::table('settings')->insert([
            [
                'type' => 'general', 'content' => '',
                'created_at' => now(), 'updated_at' => now()],
            [
                'type' => 'css-js-config','content' => '',
                'created_at' => now(),'updated_at' => now() ],
            [
                'type' => 'smtp-config','content' => '',
                'created_at' => now(),'updated_at' => now() ],
        ]);
    }
}
