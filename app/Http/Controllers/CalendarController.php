<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Exercice;
use App\Models\Instructor;
use Illuminate\Http\Request;

class CalendarController extends Controller
{


    public function __construct(Request $request)
    {
        parent::__construct($request);
    }


    public function index()
    {

        $data = Classes::all();

        if($this->request->ajax()) {
            return $this->listToCalendar($data);
        }

        return view('calendar.index');
    }

    public function show($id) {

        $class = Classes::find($id);

        return view('calendar.show', compact('class'));
    }

    public function absense($id) {
        $class = Classes::find($id);
        $data = Instructor::all();
        
        $instructors = [];
        foreach($data as $inst) {
            $instructors[] = [$inst->id, $inst->user->name];
        }
        return view('calendar.absense', compact('class', 'instructors'));
    }

    public function presence($id) {
        $class = Classes::find($id);

        $exercices = Exercice::select(['id', 'name'])->get()->toArray();

        return view('calendar.presence', compact('class', 'exercices'));
    }


    private function listToCalendar($data) {


        $bgClassStatus = [
            0 => 'bg-primary',
            1 => 'bg-success',
            2 => 'bg-warning',
            3 => 'bg-danger'
        ];

        $calendar = [];

        foreach($data as $item) {


            $badge = '<span class="bg-dark mt-1 rounded px-1"><small>'.$item->type.'</small></span>';

            if($item->type !== 'RP') {
                $badge = '';
            }

            $title = '<div>'.$badge.'<b>' .  $item->student->user->firstAndLast . '</b></div>';
            // $title .= '<div>'.$item->instructor->user->name.'</div>';
            $title .= '<div>'.$item->registration->modality->name;
            $title .= ' | ' . $item->classType;
            $title .= ' | ' . $item->instructor->user->firstName.'</div>';

            $calendar[] = [
                'id' => $item->id,
                'title' =>  $title,
                'start'     => $item->date .  'T' . $item->time,
                'end'       => $item->date .  'T' . date('H:i', strtotime($item->time . '+1 hour')),
                'className' => [$bgClassStatus[$item->status]],
                // 'color' => (isset($holidays[$item->date])) ? '#000' : 'null'
            ];
        }

        

        return response()->json($calendar);
    }

}
