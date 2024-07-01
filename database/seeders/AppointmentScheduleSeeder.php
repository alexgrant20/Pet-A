<?php

namespace Database\Seeders;

use App\Models\AppointmentSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppointmentSchedule::insert([
            [
                'veterinarian_id' => 1,
                'start_time' => '09:00',
                'day' => '2',
            ],
            [
                'veterinarian_id' => 1,
                'start_time' => '15:00',
                'day' => '2',
            ],
            [
                'veterinarian_id' => 1,
                'start_time' => '13:00',
                'day' => '3',
            ],
            [
                'veterinarian_id' => 1,
                'start_time' => '14:00',
                'day' => '5',
            ]
        ]);
    }
}
