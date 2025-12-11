<?php

namespace Database\Seeders;

use App\Models\WorkSchedules;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkSchedules::create([
            'name' => ['ar' => 'عدد ايام الشغل الرسمية', 'en' => 'Default Work Schedule'],
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
            'working_hours_per_day' => 8,
            'weekly_working_days' => json_encode([
                'sunday',
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
            ])
        ]);
    }
}
