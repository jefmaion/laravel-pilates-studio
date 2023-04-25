<?php

namespace App\Http\Controllers;

use App\Services\CalendarService;
use App\Services\ClassService;
use App\Services\ExerciceService;
use App\Services\InstructorService;
use App\Services\ModalityService;
use App\Services\StudentService;
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

    public function remark($id) {
        $class       = $this->classService->findClass($id);
        $instructors = $this->instructorService->listCombo();
        return view('calendar.remark', compact('class', 'instructors'));
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
            
            $badge = '';

            if($item->pendencies) {
                $badge = '<i class="fa fa-exclamation-circle mr-1" aria-hidden="true" style="color:#F9584B"></i>';
            }

            if($item->registration->installmentToday) {
                $badge = '<i class="fa fa-exclamation-circle mr-1" aria-hidden="true" style="color:#F9584B"></i>';
            }

            if($item->registration->hasInstallmentLate) {
                $badge = '<i class="fa fa-exclamation-circle mr-1" aria-hidden="true" style="color:#F9584B"></i>';
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
            ];
        }

        

        return response()->json($calendar);
    }

    

}
