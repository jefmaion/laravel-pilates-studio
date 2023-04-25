<?php

namespace App\Http\Controllers;

use App\Models\InstructorModality;
use App\Http\Requests\StoreInstructorModalityRequest;
use App\Http\Requests\UpdateInstructorModalityRequest;
use App\Models\Instructor;
use App\Models\Modality;
use App\Services\InstructorService;
use App\Services\ModalityService;

class InstructorModalityController extends Controller
{

    protected $instructorService;
    protected $modalityService;

    public function __construct(ModalityService $modalityService, InstructorService $instructorService)
    {
        $this->modalityService = $modalityService;
        $this->instructorService = $instructorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idInstructor)
    {
        if(!$instructor = $this->instructorService->find($idInstructor)) {
            return redirect()->route('instructor.index')->with('warning','Professor não encontrado!');
        }

        $modalities = $this->modalityService->listCombo();

        return view('instructor.modality.index', compact('instructor', 'modalities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInstructorModalityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInstructorModalityRequest $request, $idInstructor)
    {

        $data = $request->except(['_method', '_token']);

        if(!$instructor = $this->instructorService->find($idInstructor)) {
            return redirect()->route('instructor.index')->with('warning','Professor não encontrado!');
        }

        $this->instructorService->addModality($instructor, $data);

        return redirect()->route('instructor.modality.index', $instructor)->with('success', 'Modalidade atribuída com sucesso');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InstructorModality  $instructorModality
     * @return \Illuminate\Http\Response
     */
    public function show(InstructorModality $instructorModality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InstructorModality  $instructorModality
     * @return \Illuminate\Http\Response
     */
    public function edit(InstructorModality $instructorModality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInstructorModalityRequest  $request
     * @param  \App\Models\InstructorModality  $instructorModality
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInstructorModalityRequest $request, InstructorModality $instructorModality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InstructorModality  $instructorModality
     * @return \Illuminate\Http\Response
     */
    public function destroy($idInstructor, $id )
    {

        if(!$instructor = $this->instructorService->find($idInstructor)) {
            return redirect()->route('instructor.index')->with('warning','Professor não encontrado!');
        }

        $this->instructorService->removeModality($instructor, $id);
        
        return redirect()->route('instructor.modality.index', $instructor)->with('success', 'Modalidade removida com sucesso');
    }
}
