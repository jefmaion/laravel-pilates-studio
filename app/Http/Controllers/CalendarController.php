<?php

namespace App\Http\Controllers;

use App\Models\Classes;
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


    private function listToCalendar($data) {


        $bgClassStatus = [
            0 => 'bg-primary',
            1 => 'bg-success',
            2 => 'bg-warning',
            3 => 'bg-danger'
        ];

        $calendar = [];

        foreach($data as $item) {

            $title = '<div><b>' . date('H:i', strtotime($item->time)) . ' ' . $item->student->user->name . '</b></div>';
            // $title .= '<div>'.$item->instructor->user->name.'</div>';
            $title .= '<div>'.$item->registration->modality->name;
            $title .= ' / ' . $item->classType.'</div>';

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
