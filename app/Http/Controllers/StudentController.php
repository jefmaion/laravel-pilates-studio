<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\User;
use App\Services\StudentService;
use App\View\Components\Avatar;
use App\View\Components\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use stdClass;

class StudentController extends Controller
{

    protected $studentService;

    public function __construct(Request $request, StudentService $studentService)
    {
        parent::__construct($request);
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     
        $students = $this->studentService->listStudents();
        $count = count($students);

        if($this->request->ajax()) {
           return $this->listToDataTable($students);
        }

        return view('student.index', compact('count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('student.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {

        $data = $request->except(['_token', '_method']);

       

        if($this->studentService->createStudent($data)) {
            return redirect()->route('student.index')->with('success','Aluno cadastrado com sucesso!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->except(['_token', '_method']);


        if($this->studentService->updateStudent($student, $data)) {
            return redirect()->route('student.index')->with('success','Aluno atualizado com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        if($this->studentService->deleteStudent($student)) {
            return redirect()->route('student.index')->with('success','Aluno excluido com sucesso!');
        }
    }


    private function listToDataTable($data) {

        $response = [];

        foreach($data as $item) {
            $response[] = [
                'id' => $item->id,
                'name' => image(asset($item->user->image)) . anchor(route('student.show', $item), $item->user->name, 'ml-2'),
                'phone_wpp' => $item->user->phone_wpp,
                'created_at' => $item->created_at->format('d/m/Y')
            ];
        }


        return response()->json(['data' => $response]);
    }
}
