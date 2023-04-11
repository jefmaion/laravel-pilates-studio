<?php

namespace App\Http\Controllers;

use App\Http\Requests\AbsenseRequest;
use App\Models\Classes;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
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
    public function edit(Classes $classes)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassesRequest  $request
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassesRequest $request, Classes $classes)
    {
        dd($request->all());
    }

    public function absense(AbsenseRequest $request, Classes $class)
    {


        

        $class->status = $request->input('absense_type');
        $class->comments = $request->input('comments');
        $class->finished = 1;
        

        if($request->input('has_replacement')) {



            $newClass = $class->replicate();

            $newClass->date = $request->input('date');
            $newClass->time = $request->input('time');
            $newClass->instructor_id = $request->input('instructor_id');
            $newClass->type                    = 'RP';
            $newClass->status                  = 0;
            $newClass->finished                = 0;
            $newClass->scheduled_instructor_id = $newClass->instructor_id;
    
            $newClass->parent()->associate($class);
            
            $newClass->save();
    
            $class->parent()->associate($newClass);
    
          
        }

        return $class->save();
    }

    public function presence(Request $request, Classes $class)
    {

        $class->status = 1;
        $class->finished = 1;
        $class->evolution = $request->input('evolution');
        $class->exercices()->sync($request->input('exercices'));
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
