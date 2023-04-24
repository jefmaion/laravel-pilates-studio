<?php

namespace App\Services;

use App\Models\Classes;
use App\Models\Registration;
use App\Models\Transaction;
use Carbon\Carbon;

class RegistrationService
{



    public function makeRegistration($data)
    {

        $data = $this->prepareData($data);


        if ($registration = Registration::create($data)) {
            $this->generateClasses($registration, $data['class']);
            $this->generateInstallments($registration, $data);
            return $registration;
        }
    }

    public function updateRegistration(Registration $registration, $data)
    {

        $data = $this->prepareData($data);

        $registration->fill($data);
        $registration->save();

        $this->generateClasses($registration, $data['class']);
        $this->generateInstallments($registration, $data);

        return true;
    }

    public function cancelRegistration(Registration $registration, $comments=null) {

        $registration->cancel_comments = $comments;
        $registration->cancel_date = date('Y-m-d');
        $registration->status = 0;
        $registration->save();


        $registration->classes()->where('finished', 0)->delete();

    }

    private function prepareData($data) {

        if(!isset($data['class'])) {
            return $data;
        }

        foreach ($data['class'] as $k => $item) {
            if (empty($item['time']) || empty($item['instructor_id'])) {
                unset($data['class'][$k]);
            }
        }

        $data['end'] = date('Y-m-d', strtotime('+' . $data['duration'] . 'months', strtotime($data['start'])));

        return $data;
    }

    private function generateClasses(Registration $registration, $data)
    {

        $registration->classes()->where('finished', 0)->delete();
        $registration->weekClass()->delete();


        $classes = $registration->classes;

        $exists = [];
        foreach($classes as $cl) {
            $exists[$cl->date][$cl->time] = $cl;
        }

        $start = $registration->start;

        foreach($data as $item) {

            $registration->weekClass()->create($item);

            $startDate = (date('w', strtotime($start)) == $item['weekday']) ? Carbon::parse($start) :  Carbon::parse($start)->next((int) $item['weekday']); // Get the first friday.
            $endDate   = Carbon::parse($registration->end);

            $numClasses = 0;
            for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {

                if(isset($exists[$date->format('Y-m-d')][$item['time']])) {
                    continue;
                }

                Classes::create([
                    'registration_id'         => $registration->id,
                    'student_id'              => $registration->student_id,
                    'instructor_id'           => $item['instructor_id'],
                    'scheduled_instructor_id' => $item['instructor_id'],
                    'type'                    => 'AN',
                    'date'                    => $date->format('Y-m-d'),
                    'time'                    => $item['time'],
                    'weekday'                 => $item['weekday'],
                ]);

                $numClasses++;
            }

            $registration->update(['class_value' => $registration->value / $numClasses]);

        }

        

    }

    public function generateInstallments(Registration $registration, $data) {


        $registration->installments()->whereNull('pay_date')->delete();

        $dueDate =  Carbon::parse(date('Y-m-', strtotime($data['start'])) . $data['due_day']) ;

        for($i=1; $i<= $data['duration']; $i++) {

            $paymentMethod = ($i==1) ? $data['first_payment_method_id'] : $data['other_payment_method_id'];

            Transaction::create([
                'registration_id'   => $registration->id,
                'student_id'        => $registration->student->id,
                'payment_method_id' => $paymentMethod,
                'category_id'       => 1,
                'type'              => 'R',
                'date'              => $dueDate,
                'value'             => $data['value'],
                'description'       => 'Mensalidade '.$i.'/'.$data['duration'] . ' de '.$registration->student->name,
            ]);

            $dueDate = date('Y-m-d', strtotime($dueDate . ' +1 months'));
            $dueDate =  Carbon::parse(date('Y-m-', strtotime($dueDate)) . $data['due_day']) ;
        }

        

        return true;

    }


}
