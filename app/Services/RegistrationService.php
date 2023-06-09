<?php

namespace App\Services;

use App\Models\AccountReceivable;
use App\Models\Classes;
use App\Models\Registration;
use Carbon\Carbon;

class RegistrationService extends Service
{

    public function __construct(Registration $registration)
    {
        parent::__construct($registration);
    }

    public function findRegistration($id) {
        return Registration::with(['classes.instructor.user', 'installments'])->find($id);
    }

    public function listCalendarClass($currentRegistration) {

        $registrations = Registration::with(['weekClass', 'student.user'])->get();

        $data = [];

        foreach($registrations as $registration) {

            foreach($registration->weekClass as $week) {
                $data[$week->time][$week->weekday][] = [
                    'name' => $registration->student->user->firstAndLast,
                    'me'   => $registration->id == $currentRegistration->id
                ];
            }            
        }

        return $data;
    }

    public function makeRegistration($data)
    {
        $data = $this->prepareData($data);

        Registration::where('student_id', $data['student_id'])->where('modality_id', $data['modality_id'])->update(['status' => 2]);

        if ($registration = Registration::create($data)) {

            $this->generateInstallments($registration, $data);

            if(isset($data['class'])) {
                $this->generateClasses($registration, $data['class']);
            }
            
            return $registration;
        }
    }

    public function updateRegistration(Registration $registration, $data)
    {

        $data = array_filter($data);

        $registration->fill($data);
        $registration->save();

        $this->generateClasses($registration, $data['class']);

        return true;
    }

    public function cancelRegistration(Registration $registration, $removeClass=0,  $comments=null) {

        $registration->cancel_comments = $comments;
        $registration->cancel_date     = date('Y-m-d');
        $registration->status          = 0;

        $registration->save();

        if($removeClass) {
            $registration->classes()->where('finished', 0)->delete();
        }

    }

    public function finalizeRegistration(Registration $registration) {
        $registration->status          = 2;
        $registration->save();
    }

    public function delete($registration) {
        $registration->weekclass()->delete();
        $registration->classes()->where('finished', 0)->delete();
        $registration->installments()->where('status', 0)->delete();

        if($registration->installments()->where('status', 1)->count() > 0) {
            return $registration->delete();
        }

        return $registration->forceDelete();
    }

    public function listRegistrations() {
        return Registration::with(['student.user', 'modality', 'classes'])->latest();
    }

    public function listToDataTable($justActive=false) {

        $response      = [];
        $duration      = classMonths();
        $registrations = $this->listRegistrations();

        if($justActive) {
            $registrations->where('status', 1);
        }

        $data = $registrations->get();

        foreach($data as $item) {
            $response[] = [
                'name'       => image(asset($item->student->user->image)) . anchor(route('registration.show',  $item), '<b>'.$item->student->user->name.'</b>', 'ml-2'),
                'start'      => $item->start,
                'end'        => $item->end->format('d/m/Y'),
                'status'     => $item->statusName,
                'value'      => currency($item->value),
                'modality'   => $item->modality->name,
                'duration'   => $duration[$item->duration],
                'classes'    => ($item->countClasses('presences')+$item->countClasses('absenses')) . ' de ' . $item->countClasses() ,
                'created_at' => $item->created_at->format('d/m/Y')
            ];
        }

        return json_encode(['data' => $response]);
    }

    private function prepareData($data) {

        $data['end'] = date('Y-m-d', strtotime('+' . $data['duration'] . 'months', strtotime($data['start'])));

        if(!isset($data['class'])) {
            return $data;
        }

        foreach ($data['class'] as $k => $item) {
            if (empty($item['time']) || empty($item['instructor_id'])) {
                unset($data['class'][$k]);
            }
        }

        return $data;
    }

    public function generateClasses(Registration $registration, $data)
    {

        $registration->classes()->where('finished', 0)->delete();
        $registration->weekClass()->delete();

        $classes = $registration->classes()->where('finished', 1)->get();

        $exists  = [];

        foreach($classes as $cl) {
            $exists[$cl->date][$cl->weekday] = true;
        }

        $start = $registration->start;

        foreach($data as $item) {

            $registration->weekClass()->create($item);

            $startDate = (date('w', strtotime($start)) == $item['weekday']) ? Carbon::parse($start) :  Carbon::parse($start)->next((int) $item['weekday']); // Get the first friday.
            $endDate   = Carbon::parse($registration->end);

            $numClasses = 0;
            for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {

                if(isset($exists[$date->format('Y-m-d')])) {
                    continue;
                }

                Classes::create([
                    'registration_id'         => $registration->id,
                    'student_id'              => $registration->student_id,
                    'modality_id'             => $registration->modality_id,
                    'instructor_id'           => $item['instructor_id'],
                    'scheduled_instructor_id' => $item['instructor_id'],
                    'type'                    => 'AN',
                    'date'                    => $date->format('Y-m-d'),
                    'time'                    => $item['time'],
                    'weekday'                 => $item['weekday'],
                ]);

                $numClasses++;
            }


            $nClasses = $registration->classes()->where('type', 'AN')->count();

            if($nClasses > 0) {
                $registration->update(['class_value' => $registration->value / $nClasses]);
            }
        }

    }

    public function generateInstallments(Registration $registration, $data) {

        
        $registration->installments()->whereNull('pay_date')->delete();

        $dueDate =  Carbon::parse(date('Y-m-', strtotime($data['start'])) . $data['due_day']) ;

        for($i=1; $i<= $data['duration']; $i++) {

            $paymentMethod = ($i==1) ? $data['first_payment_method_id'] : $data['other_payment_method_id'];

            $installment = [

                'registration_id'   => $registration->id,
                'student_id'        => $registration->student->id,
                'payment_method_id' => $paymentMethod,
                'category_id'       => 1,
                'date'              => $dueDate,
                'value'             => $data['value'],
                'amount'             => $data['value'],
                'description'       => $registration->student->user->firstName .  ' - Mensalidade ('.$i.'/'.$data['duration'].') de '. $registration->modality->name,
            ];

            

            if($data['is_paid'] == 1 && $i == 1) {
                $installment = array_merge($installment, [
                    'pay_date' => $dueDate,
                    'status' => 1,
                    'user_id' => auth()->user()->id
                ]);
            }

            AccountReceivable::create($installment);

            $dueDate = date('Y-m-d', strtotime($dueDate . ' +1 months'));
            $dueDate =  Carbon::parse(date('Y-m-', strtotime($dueDate)) . $data['due_day']) ;
        }

        

        return true;

    }


}
