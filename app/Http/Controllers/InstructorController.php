<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;
use App\Models\User;
use App\Services\InstructorService;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    
    protected $instructorService;

    public function __construct(Request $request, InstructorService $instructorService)
    {
        parent::__construct($request);
        $this->instructorService = $instructorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->request->ajax()) {
           return $this->instructorService->listToDataTable();
        }

        $count       = $this->instructorService->countAll();

        return view('instructor.index', compact('count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('instructor.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInstructorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInstructorRequest $request)
    {
        $data = $request->except(['_token', '_method']);

        if($this->instructorService->createInstructor($data)) {
            return redirect()->route('instructor.index')->with('success','Professor cadastrado com sucesso!');
        }

        return redirect()->route('instructor.index')->with('error','Não foi possível cadastrar o professor');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$instructor = $this->instructorService->find($id)) {
            return redirect()->route('instructor.index')->with('warning','Professor não encontrado!');
        }

        return view('instructor.show', compact('instructor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$instructor = $this->instructorService->find($id)) {
            return redirect()->route('instructor.index')->with('warning','Professor não encontrado!');
        }

        return view('instructor.edit', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInstructorRequest  $request
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInstructorRequest $request, $id)
    {
        $data = $request->except(['_token', '_method']);

        if(!$instructor = $this->instructorService->find($id)) {
            return redirect()->route('instructor.index')->with('warning','Professor não encontrado!');
        }

        if($this->instructorService->updateInstructor($instructor, $data)) {
            return redirect()->route('instructor.index')->with('success','Professor atualizado com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$instructor = $this->instructorService->find($id)) {
            return redirect()->route('instructor.index')->with('warning','Professor não encontrado!');
        }

        if($this->instructorService->deleteInstructor($instructor)) {
            return redirect()->route('instructor.index')->with('success','Professor excluido com sucesso!');
        }
    }

    
}
