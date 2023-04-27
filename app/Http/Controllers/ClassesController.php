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

        $this->classService->updateClass($class, $data);

        if($request->ajax()){
            return true;
        }

        return redirect()->route('registration.show', $class->registration)->with('success', 'Aula Alterada');
    }

    public function absense(AbsenseRequest $request, Classes $class)
    {
        return $this->classService->absense($class, $request->input('absense_type'), $request->input('absense_comments'));
    }

    public function presence(Request $request, Classes $class)
    {
        return  $this->classService->presence($class, $request->input('exercices'), $request->input('evolution'));
    }

    public function reset(Classes $class) 
    {
        return $this->classService->reset($class);
    }

    public function remark(RemarkRequest $request, Classes $class) 
    {
        return $this->classService->remarkClass($class, $request->all());
        // return redirect()->route('calendar.index')->with('success', 'Aula Reagendada com successo!');
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
