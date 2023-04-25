<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\User;
use App\Services\StudentService;
use Illuminate\Http\Request;

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
        if($this->request->ajax()) {
           return $this->studentService->listToDataTable();
        }

        $count = $this->studentService->countAll();

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
    public function show($id)
    {
        if(!$student = $this->studentService->find($id)) {
            return redirect()->route('student.index')->with('warning','Aluno não encontrado!');
        }

        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$student = $this->studentService->find($id)) {
            return redirect()->route('student.index')->with('warning','Aluno não encontrado!');
        }

        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $data = $request->except(['_token', '_method']);

        if(!$student = $this->studentService->find($id)) {
            return redirect()->route('student.index')->with('warning','Aluno não encontrado!');
        }

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
    public function destroy($id)
    {
        if(!$student = $this->studentService->find($id)) {
            return redirect()->route('student.index')->with('warning','Aluno não encontrado!');
        }

        if($this->studentService->deleteStudent($student)) {
            return redirect()->route('student.index')->with('success','Aluno excluido com sucesso!');
        }
    }


    
}
