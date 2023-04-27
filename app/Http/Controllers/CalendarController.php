<?php

namespace App\Http\Controllers;

use App\Services\CalendarService;
use App\Services\ClassService;
use App\Services\ExerciceService;
use App\Services\InstructorService;
use App\Services\ModalityService;
use App\Services\StudentService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{

    protected $calendarService;
    protected $studentService;
    protected $instructorService;
    protected $modalityService;
    protected $classService;
    protected $exerciceService;

    public function __construct(
        Request $request, 
        CalendarService $calendarService, 
        StudentService $studentService,
        InstructorService $instructorService,
        ModalityService $modalityService,
        ClassService $classService,
        ExerciceService $exerciceService
    )
    {
        parent::__construct($request);
        $this->calendarService   = $calendarService;
        $this->studentService    = $studentService;
        $this->instructorService = $instructorService;
        $this->modalityService   = $modalityService;
        $this->classService      = $classService;
        $this->exerciceService   = $exerciceService;
    }

    public function index(Request $request)
    {

        if($this->request->ajax()) {
            $data = $this->calendarService->listClasses($request->all());
            return $this->listToCalendar($data);
        }

        $instructors = $this->instructorService->listCombo();
        $students    = $this->studentService->listCombo(true);
        $modalities  = $this->modalityService->listCombo();
        
        return view('calendar.index', compact('instructors', 'modalities', 'students'));
    }

    public function show($id) {
        $class = $this->classService->findClass($id);
        return view('calendar.show', compact('class'));
    }

    public function edit($id) {

        $class     = $this->classService->findClass($id);
        $exercices = [];
        if($class->status == 1) {
            $exercices         = $this->exerciceService->listCombo();
        }

        return view('calendar.edit', compact('class', 'exercices'));
    }

    public function absense($id) {
        $class       = $this->classService->findClass($id);
        $instructors = $this->instructorService->listCombo();
        return view('calendar.absense', compact('class', 'instructors'));
    }

    public function presence($id) {
        $class     = $this->classService->findClass($id);
        $exercices = $this->exerciceService->listCombo();
        return view('calendar.presence', compact('class', 'exercices'));
    }

    public function evolution($id) {
        $class     = $this->classService->findClass($id);
        $exercices = $this->exerciceService->listCombo();
        return view('calendar.evolution', compact('class', 'exercices'));
    }

    public function remark($id, $select=false) {
        $class       = $this->classService->findClass($id);
        return view('calendar.remark-calendar', compact('class'));

    
       
    }

    public function select($id, Request $request) {

        $date = Carbon::parse($request->input('date'))->locale('pt-BR');

        $newDate = [
            'day'  =>$date->format('Y-m-d'),
            'time' => $date->format('H:i:s'),
            'full' => ucwords($date->translatedFormat('l, d \d\e F \d\e Y'))
        ];

        $classes = $this->classService->listClassByDay($date->format('Y-m-d'), $date->format('H:i:s'));

        $class       = $this->classService->findClass($id);
        $instructors = $this->instructorService->listCombo();

        return view('calendar.remark-select', compact('class', 'instructors', 'newDate', 'classes'))->render();
    }



    private function listToCalendar($data) {

        $bgClassStatus = [
            0 => 'bg-primary',
            1 => 'bg-green',
            2 => 'bg-warning',
            3 => 'bg-red'
        ];

        $calendar = [];
        $raw = [];

        foreach($data as $item) {

            $bg = $bgClassStatus[$item->status];

            if($item->type == 'RP' && $item->status == 0) {
                $bg = 'bg-light-blue';
            }
            
            $badge = '';

            if($item->finished) {
                $badge = '<i class="fas fa-check    "></i> ';
            }

            if($item->pendencies) {
                $badge = '<i class="fa fa-exclamation-circle mr-1 text-red" aria-hidden="true" sstyle="color:#F9584B"></i>';
            }

            if($item->registration->installmentToday) {
                $badge = '<i class="fa fa-exclamation-circle mr-1 text-red" aria-hidden="true" sstyle="color:#F9584B"></i>';
            }

            if($item->registration->hasInstallmentLate) {
                $badge = '<i class="fa fa-exclamation-circle mr-1 text-red" aria-hidden="true" sstyle="color:#F9584B"></i>';
            }

            

            $title = '<div class="mb-0">'.$badge.'<b>' .  $item->student->user->firstAndLast . '</b></div>';
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
                'raw' => [
                    'id' => $item->id,
                    'title' =>  $item->student->user->firstAndLast. '|' .$item->registration->modality->acronym,
                    'start'     => $item->date .  'T' . $item->time,
                    'end'       => $item->date .  'T' . date('H:i', strtotime($item->time . '+1 hour')),
                    'className' =>['fc-event-remark', 'bg-light']
                ]
            ];


            $raw[] = [
                'id' => $item->id,
                'title' =>  $item->student->user->firstAndLast . '|' .$item->registration->modality->acronym,
                'start'     => $item->date .  'T' . $item->time,
                'end'       => $item->date .  'T' . date('H:i', strtotime($item->time . '+1 hour')),
            ];
        }

        

        return response()->json($calendar);
    }

    

}
