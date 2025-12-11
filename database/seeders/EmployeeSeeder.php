<?php

namespace Database\Seeders;

use App\Enum\GenderEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Trait\Permissions;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $admin = User::Create(
            [
                "name"       => ['ar'=>"احمد عزوز",'en'=>"Ahmed Azoz"],
                "email" => "ahmedadmin@gmail.com",
                "password"   => bcrypt("12345678"),
                "age"   => 29,
                "gender"     => GenderEnum::Male->value,
                "address"      => ['ar'=>'بني سويف','en'=>'beni suef'],
                "birthdate" => "1997-09-20",
                "employee_number" => "181123",
                "phone" => "0152326232",
                "job_title" => ['ar'=>'مسوؤل قسم الموارد البشرية','en'=>'Senior Accountable'],
                'department_id'=> 3,
                'salary'=>35000,
                'work_schedule_id'=> 1,
            ]);

            $admin->assignRole('Admin');
           

        $employee = User::Create(
            [
                "name"       => ['ar'=>"محمود جابر",'en'=>"Mahmoud Gaber"],
                "email" => "ahmed123@gmail.com",
                "password"   => bcrypt("12345678"),
                "age"   => 32,
                "gender"     => GenderEnum::Male->value,
                "address"      => ['ar'=>'القاهرة','en'=>'Cairo'],
                "birthdate" => "1994-09-20",
                "employee_number" => "191123",
                "phone" => "01065543072",
                "job_title" => ['ar'=>'محاسب','en'=>'Accountable'],
                'department_id'=> 3,
                'salary'=>25000,
                'work_schedule_id'=> 1,
            ]);

            $employee->assignRole('Employee');
            

    }
}
