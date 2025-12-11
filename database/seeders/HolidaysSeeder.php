<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $holidays = [
            [
                'holiday_date' => '2025-01-01',
                'name' => [
                    'ar' => 'رأس السنة الميلادية',
                    'en' => 'New Year\'s Day'
                ],
                'description' => [
                    'ar' => 'بداية السنة الجديدة',
                    'en' => 'Beginning of the new year'
                ],
                'recurring' => true,
            ],
            [
                'holiday_date' => '2025-04-25',
                'name' => [
                    'ar' => 'عيد تحرير سيناء',
                    'en' => 'Sinai Liberation Day'
                ],
                'description' => [
                    'ar' => '',
                    'en' => ''
                ],
                'recurring' => true,
            ],
            [
                'holiday_date' => '2025-05-01',
                'name' => [
                    'ar' => 'عيد العمال',
                    'en' => 'Labour Day'
                ],
                'description' => [
                    'ar' => '',
                    'en' => ''
                ],
                'recurring' => true,
            ],
        ];

        foreach($holidays as $holiday){
            Holiday::create($holiday);
        }
    
    }
}
