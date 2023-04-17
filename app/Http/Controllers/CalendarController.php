<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Exercice;
use App\Models\Instructor;
use App\Models\Modality;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{


    public function __construct(Request $request)
    {
        parent::__construct($request);
    }


    public function index(Request $request)
    {

        

        

        if($this->request->ajax()) {

            $start = Carbon::parse($request->query('start'));
            $end   = Carbon::parse($request->query('end'));

        
            $data  = Classes::whereBetween('date', [$start, $end]);

            if($request->query('modality_id')) {
                $data = Classes::whereHas('registration', function($q) use($request) {
                    $q->where('modality_id','=', $request->query('modality_id'));
                });
            }
          
            $params = $request->except(['_', 'start', 'end', 'modality_id']);

            foreach ($params as $key => $value) {
                if ($value == "") continue;
                $data->where($key, $value);
            }

            $data = $data->get();

            return $this->listToCalendar($data);
        }

        $data = Instructor::all();
        $instructors = [];
        foreach($data as $inst) {
            $instructors[] = [$inst->id, $inst->user->name];
        }

        $modalities = Modality::select(['id', 'name'])->get()->toArray();
        

        return view('calendar.index', compact('instructors', 'modalities'));
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

            $bg = $bgClassStatus[$item->status];

            if($item->type == 'RP' && $item->status == 0) {
                $bg = 'bg-info';
            }
            
            // $badge = $this->checkEvent($item);

            $badge = '';

            if($item->pendencies) {
                $badge = '<i class="fa fa-exclamation-triangle " aria-hidden="true" style="color:#F9584B"></i>';
            }

            

            $title = '<div>'.$badge.'<b>' .  $item->student->user->firstAndLast . '</b></div>';
            // $title .= '<div>'.$item->instructor->user->name.'</div>';
            $title .= '<div>'.$item->registration->modality->acronym;
            $title .= ' | ' . $item->classType;
            // $title .= ' | ' . $item->instructor->user->firstName.'</div>';

            $calendar[] = [
                'id' => $item->id,
                'title' =>  $title,
                'start'     => $item->date .  'T' . $item->time,
                'end'       => $item->date .  'T' . date('H:i', strtotime($item->time . '+1 hour')),
                'className' => [$bg],
                // 'color' => (isset($holidays[$item->date])) ? '#000' : 'null'
            ];
        }

        

        return response()->json($calendar);
    }

    private function checkEvent($item) {
        $icon  = '<i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i> ';



        if($item->status == 1 && empty($item->evolution)) {
            return $icon;
        }

        if($item->status == 2 && $item->hasReplacement() === 0) {
            return $icon;
        }

        return null;
        
    }

}
