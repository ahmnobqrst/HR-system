<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => ['ar' => 'قسم البرمجة', 'en' => 'Programming'],
                'description' => ['ar' => 'قسم متخصص في تطوير البرمجيات، وتصميم الأنظمة، ودعم التحول الرقمي داخل المؤسسة',
                 'en' => 'A specialized department in software development, system design, and digital transformation support within the organization.'],
                'user_id' => null,
            ],
            [
                'name' => ['ar' => 'قسم إنتاج حيواني', 'en' => 'Animal Production'],
                'description' => ['ar' => 'قسم يهتم بإدارة وتنمية الإنتاج الحيواني وتحسين الجودة والإنتاجية باستخدام الأساليب العلمية الحديثة', 
                'en' => 'A department responsible for managing and developing animal production and improving quality and productivity using modern scientific methods.'],
                'user_id' => null,
            ],
            [
                'name' => ['ar' => 'قسم محاسبة', 'en' => 'Accounting'],
                'description' => ['ar' => 'قسم مسؤول عن إدارة العمليات المالية، وإعداد التقارير المحاسبية، ومتابعة الميزانيات داخل المؤسسة', 
                'en' => 'A department responsible for managing financial operations, preparing accounting reports, and monitoring budgets within the organization.'],
                'user_id' => 2,
            ]
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
