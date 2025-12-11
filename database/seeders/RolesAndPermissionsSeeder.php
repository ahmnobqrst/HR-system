<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Traits\Permissions;

class RolesAndPermissionsSeeder extends Seeder
{
    use Permissions;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $roles = [
            'SuperAdmin',
            'Admin',
            'Employee',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role,'guard_name' => 'web']);
        }

        

        foreach ($this->allowedPermissionsList() as $permission) {
            Permission::firstOrCreate(['name' => $permission,'guard_name' => 'web']);
        }
    }
}
