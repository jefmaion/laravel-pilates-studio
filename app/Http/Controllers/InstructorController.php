<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
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
        
        $instructors = $this->instructorService->listInstructor();

        if($this->request->ajax()) {
           return $this->listToDataTable($instructors);
        }

        return view('instructor.index', compact('instructors'));
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
            return redirect()->route('instructor.index')->with('success','Aluno cadastrado com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
        return view('instructor.show', compact('instructor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructor $instructor)
    {
        return view('instructor.edit', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInstructorRequest  $request
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInstructorRequest $request, Instructor $instructor)
    {
        $data = $request->except(['_token', '_method']);


        if($this->instructorService->updateInstructor($instructor, $data)) {
            return redirect()->route('instructor.index')->with('success','Aluno atualizado com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        if($this->instructorService->deleteInstructor($instructor)) {
            return redirect()->route('instructor.index')->with('success','Aluno excluido com sucesso!');
        }
    }

    private function listToDataTable($data) {

        $response = [];

        foreach($data as $item) {
            $response[] = [
                'id' => $item->id,
                'name' => image(asset($item->user->image)) . anchor(route('instructor.show', $item), $item->user->name, 'ml-2'),
                'phone_wpp' => $item->user->phone_wpp,
                'created_at' => $item->created_at->format('d/m/Y')
            ];
        }


        return response()->json(['data' => $response]);
    }
}
