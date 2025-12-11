<?php

namespace Database\Seeders;

use App\Enum\GenderEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Trait\Permissions;

class AddSuperAdminRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $role = Role::firstOrCreate(
            ['name' => 'SuperAdmin']
        );
       $superAdmin = User::Create(
            [
                "name"       => ['ar'=>"احمد جابر",'en'=>"Ahmed Gaber"],
                "email" => "superadmin@gmail.com",
                "password"   => bcrypt("12345678"),
                "age"   => 27,
                "gender"     => GenderEnum::Male->value,
                "address"      => ['ar'=>'بني سويف','en'=>'beni suef'],
                "birthdate" => "1998-09-20",
                "employee_number" => "171123",
                "phone" => "01255512151",
                "job_title" => ['ar'=>'مهندس كمبيوتر','en'=>'Software Engineering'],
            ]
        );

        $superAdmin->assignRole(['SuperAdmin']);
    }
}
