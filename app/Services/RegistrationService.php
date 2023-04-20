<?php

namespace App\Services;

use App\Models\Classes;
use App\Models\Registration;
use Carbon\Carbon;

class RegistrationService
{



    public function makeRegistration($data)
    {

        $data = $this->prepareData($data);

        

        if ($registration = Registration::create($data)) {
            $this->generateClasses($registration, $data['class']);
            return $registration;
        }
    }

    public function updateRegistration(Registration $registration, $data)
    {

        $data = $this->prepareData($data);

        $registration->fill($data);
        $registration->save();

        $this->generateClasses($registration, $data['class']);

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

        $registration->classes()->where('finished', 0)->whereNotNull('classes_id')->update(['classes_id' =>null]);
        $registration->classes()->where('finished', 0)->delete();
        $registration->weekClass()->delete();

        foreach($data as $item) {

            $registration->weekClass()->create($item);

            $startDate = (date('w', strtotime($registration->start)) == $item['weekday']) ? Carbon::parse($registration->start) :  Carbon::parse($registration->start)->next((int) $item['weekday']); // Get the first friday.
            $endDate   = Carbon::parse($registration->end);

            for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {

                Classes::create([
                    'registration_id' => $registration->id,
                    'student_id' => $registration->student_id,
                    'instructor_id' => $item['instructor_id'],
                    'scheduled_instructor_id' => $item['instructor_id'],
                    'type' => 'AN',
                    'date' => $date->format('Y-m-d'),
                    'time' => $item['time'],
                    'weekday' => $item['weekday'],
                ]);
            }

        }

        

    }


}
