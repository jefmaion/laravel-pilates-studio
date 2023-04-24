<?php

namespace App\Http\Controllers;

use App\Http\Requests\AbsenseRequest;
use App\Http\Requests\RemarkRequest;
use App\Models\Classes;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use App\Models\InstructorValues;
use App\Services\ClassService;
use Illuminate\Http\Request;

class ClassesController extends Controller
{

    protected $classService;

    public function __construct(Request $request, ClassService $classService)
    {
        parent::__construct($request);
        $this->classService = $classService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreClassesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class)
    {
        return view('class.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassesRequest  $request
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassesRequest $request, Classes $class)
    {
        $data = $request->except(['_method', '_token']);

        $class->fill($data)->update();

        if($request->ajax()){
            return true;
        }

        return redirect()->route('registration.show', $class->registration)->with('success', 'Aula Alterada');
    }

    public function absense(AbsenseRequest $request, Classes $class)
    {

        return $this->classService->absense($class, $request->input('absense_type'), $request->input('absense_comments'));

        // $class->status = $request->input('absense_type');
        // $class->absense_comments = $request->input('absense_comments');
        // $class->finished = 1;
        
        // return $class->save();
    }

    public function presence(Request $request, Classes $class)
    {
        return  $this->classService->presence($class, $request->input('exercices'), $request->input('evolution'));
    }

    public function reset(Classes $class) {
        return $this->classService->reset($class);
    }

    public function remark(RemarkRequest $request, Classes $class) {

        $newClass                          = $class->replicate();
        $newClass->date                    = $request->input('date');
        $newClass->time                    = $request->input('time');
        $newClass->instructor_id           = $request->input('instructor_id');
        $newClass->scheduled_instructor_id = $newClass->instructor_id;
        $newClass->type                    = 'RP';
        $newClass->status                  = 0;
        $newClass->finished                = 0;
        $newClass->absense_comments        = null;
        $newClass->classes_id              = $class->id;
        $newClass->save();

        $class->has_replacement = 1;
        // $class->parent()->associate($newClass);

        return $class->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $classes)
    {
        //
    }
}
