<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Instructor;
use App\Models\Modality;
use App\Models\Registration;
use App\Models\Student;
use App\Services\RegistrationService;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($x = 1; $x <= 20; $x++) {

            $student = Student::all()->random(1)->first();
            $modality = Modality::all()->random(1)->first();

            $classPerWeek = rand(1, 3);
            $duration = rand(1, 3);
            $start = date('Y-m-d', strtotime(date('Y-m-d') . ' -10 days'));

            $item = [
                'student_id' => $student->id,
                'start' => $start,
                'modality_id' => $modality->id,
                'class_per_week' => $classPerWeek,
                'duration' => $duration,
                'end' => date('Y-m-d', strtotime($start . ' +' . $duration . ' month')),
                'due_day' => rand(1, 28),
                'value' => rand(150, 342),
                'comments' => null,
            ];

            $registration = Registration::create($item);


            for ($i = 1; $i <= $classPerWeek; $i++) {

                $instructor = Instructor::all()->random(1)->first();

                $class = ['weekday' => rand(1, 6), 'time' => rand(7, 20) . ':00:00', 'instructor_id' => $instructor->id];


                $registration->weekClass()->create($class);

                $startDate = (date('w', strtotime($registration->start)) == $class['weekday']) ? Carbon::parse($registration->start) :  Carbon::parse($registration->start)->next((int) $class['weekday']); // Get the first friday.
                $endDate   = Carbon::parse($registration->end);

                for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {

                    Classes::create([
                        'registration_id' => $registration->id,
                        'student_id' => $registration->student_id,
                        'instructor_id' => $class['instructor_id'],
                        'scheduled_instructor_id' => $class['instructor_id'],
                        'type' => 'AN',
                        'date' => $date->format('Y-m-d'),
                        'time' => $class['time'],
                        'weekday' => $class['weekday'],
                    ]);
                }
            }
        }
    }
}
