<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        $this->createRole();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return true;
    }

    public function createRole(){
        $dataPermission = [
            'group', 
            'customer',
            'admin',
            'app', 
            'pages', 
            'settings'
        ];

        $dataRole = [
            'Quản trị viên',
            'Quản trị nội dung',
        ];

        try {
            foreach ($dataRole as $dataImport) {
                $role = Role::create(['name' => $dataImport]);
                if($dataImport == 'Quản trị viên'){
                    foreach ($dataPermission as $permission) {
                        $permission = Permission::create(['name' => $permission]);
                        $role->givePermissionTo($permission);
                    }
                    $user = \App\Models\User::find(1);
                    $user->assignRole('Quản trị viên');
                }
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
}
