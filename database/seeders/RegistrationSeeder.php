<?php

namespace Database\Seeders;

use App\Models\AccountReceivable;
use App\Models\Classes;
use App\Models\Instructor;
use App\Models\Modality;
use App\Models\Registration;
use App\Models\Student;
use App\Models\Transaction;
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
        $classStatus = [0,1,2,3];

        for ($x = 1; $x <= 20; $x++) {

            $student = Student::all()->random(1)->first();
            $modality = Modality::all()->random(1)->first();

            $classPerWeek = rand(1, 3);
            $duration = rand(1, 3);
            $start = date('Y-m-d', strtotime(date('Y-m-d') . ' -30 days'));

            $paymentMethod1 = 2;
            $paymentMethod2 = ($duration > 1) ? 1 : null;

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
                'first_payment_method_id' => $paymentMethod1,
                'other_payment_method_id' => $paymentMethod2,
            ];

            $registration = Registration::create($item);


            for ($i = 1; $i <= $classPerWeek; $i++) {

                $instructor = Instructor::all()->random(1)->first();

                $class = ['weekday' => rand(1, 6), 'time' => rand(7, 20) . ':00:00', 'instructor_id' => $instructor->id];


                $registration->weekClass()->create($class);

                $startDate = (date('w', strtotime($registration->start)) == $class['weekday']) ? Carbon::parse($registration->start) :  Carbon::parse($registration->start)->next((int) $class['weekday']); // Get the first friday.
                $endDate   = Carbon::parse($registration->end);


                $numClasses = 0;

                for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {


                    $create = [
                        'registration_id' => $registration->id,
                        'student_id' => $registration->student_id,
                        'modality_id' => $registration->modality_id,
                        'instructor_id' => $class['instructor_id'],
                        'scheduled_instructor_id' => $class['instructor_id'],
                        'type' => 'AN',
                        'date' => $date->format('Y-m-d'),
                        'time' => $class['time'],
                        'weekday' => $class['weekday'],
                        'status' => ($date < date('Y-m-d')) ?  rand(1,3) : 0
                    ];

                    if($create['status'] > 0) {
                        $create['finished'] = 1;
                    }

                    Classes::create($create);

                    $numClasses++;
                }

                $registration->update(['class_value' => $registration->value / $numClasses]);
            }

            $dueDate =  Carbon::parse(date('Y-m-', strtotime($item['start'])) . $item['due_day']) ;

            for($i=1; $i<= $item['duration']; $i++) {

                $paymentMethod = ($i==1) ? $paymentMethod1 : $paymentMethod2;

                $installment = [
                    'registration_id'   => $registration->id,
                    'student_id'        => $registration->student->id,
                    'payment_method_id' => $paymentMethod,
                    'category_id'       => 1,
                    'date'              => $dueDate,
                    'value'             => $item['value'],
                    'amount'             => $item['value'],
                    'description'       => $registration->student->user->firstName .  ' - Mensalidade ('.$i.'/'.$item['duration'].') de '. $registration->modality->name,
                ];
    
                if($i == 1) {
                    $installment = array_merge($installment, [
                        'pay_date' => $dueDate,
                        'status' => 1,
                        'user_id' => 1
                    ]);
                }

                AccountReceivable::create($installment);

                $dueDate = date('Y-m-d', strtotime($dueDate . ' +1 months'));
                $dueDate =  Carbon::parse(date('Y-m-', strtotime($dueDate)) . $item['due_day']) ;
            }
        }
    }
}
