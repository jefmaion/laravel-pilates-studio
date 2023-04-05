<?php

namespace App\Http\Controllers;

use App\Models\Exercice;
use App\Http\Requests\StoreExerciceRequest;
use App\Http\Requests\UpdateExerciceRequest;

class ExerciceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exercices = Exercice::all();

        if($this->request->ajax()) {
            return $this->listToDataTable($exercices);
         }
 
         return view('exercice.index', compact('exercices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exercice = new Exercice();
        return view('exercice.create', compact('exercice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExerciceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExerciceRequest $request)
    {
        $data = $request->except(['_token', '_method']);

        $redirectTo = route('exercice.index');

        if(Exercice::create($data)) {
            return redirect($redirectTo)->with('success','Item created successfully!');
        }

        return redirect($redirectTo)->with('error','Not Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function show(Exercice $exercice)
    {
        return view('exercice.show', compact('exercice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercice $exercice)
    {
        return view('exercice.edit', compact('exercice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExerciceRequest  $request
     * @param  \App\Models\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExerciceRequest $request, Exercice $exercice)
    {
        $data = $request->except(['_token', '_method']);

        $exercice->fill($data);

        $redirectTo = route('exercice.show', $exercice);

        if($exercice->save()) {
            return redirect($redirectTo)->with('success','Item created successfully!');
        }

        return redirect($redirectTo)->with('error','Not Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercice $exercice)
    {
        $redirectTo = route('exercice.index');

        if($exercice->delete()) {
            return redirect($redirectTo)->with('success','Item removed successfully!');
        }

        return redirect($redirectTo)->with('error','Item not removed successfully!');
    }

    private function listToDataTable($data) {

        $response = [];

        foreach($data as $item) {
            $response[] = [
                'id' => $item->id,
                'type' => $item->type,
                'name' => sprintf('<a href="%s">%s</a>', route('exercice.show', $item), $item->name),
                'created_at' => $item->created_at->format('d/m/Y')
            ];
        }

        return response()->json(['data' => $response]);
    }
}
