<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use Illuminate\Support\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $today = Carbon::today();
        $times = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];
        $names = ['Alice', 'Bob', 'Charlie', 'Diana', 'Vova', 'Denis','Artem'];

        for ($d = 0; $d < 100; $d++) {
            $date = $today->copy()->addDays($d)->toDateString();
            $usedSlots = collect($times)->random(rand(0, 5));

            foreach ($usedSlots as $time) {
                Appointment::create([
                    'date' => $date,
                    'time' => $time,
                    'name' => $names[array_rand($names)],
                    'email' => null,
                    'phone' => null,
                ]);
            }
        }
    }
}
