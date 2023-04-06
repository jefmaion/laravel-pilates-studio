<?php

namespace App\Http\Controllers;

use App\Models\InstructorModality;
use App\Http\Requests\StoreInstructorModalityRequest;
use App\Http\Requests\UpdateInstructorModalityRequest;
use App\Models\Instructor;
use App\Models\Modality;

class InstructorModalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Instructor $instructor)
    {

        $modalities = Modality::select(['id', 'name'])->get()->toArray();


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
    public function store(StoreInstructorModalityRequest $request, Instructor $instructor)
    {

        $data = $request->except(['_method', '_token']);

        $instructor->modalities()->attach($instructor, $data);

        return redirect()->route('instructor.modality.index', $instructor)->with('success', 'Adicionado com sucesso');

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
    public function destroy(Instructor $instructor, $id )
    {
        $instructor->modalities()->detach($id);
        return redirect()->route('instructor.modality.index', $instructor)->with('success', 'Removido com sucesso');
    }
}
