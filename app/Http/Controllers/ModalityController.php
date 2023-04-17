<?php

namespace App\Http\Controllers;

use App\Models\Modality;
use App\Http\Requests\StoreModalityRequest;
use App\Http\Requests\UpdateModalityRequest;

class ModalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modalities = Modality::all();
        $count = count($modalities);

        if($this->request->ajax()) {
            return $this->listToDataTable($modalities);
         }
 
         return view('modality.index', compact('count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modality = new Modality();
        return view('modality.create', compact('modality'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreModalityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModalityRequest $request)
    {
        $data = $request->validated();

        $redirectTo = route('modality.index');

        if(Modality::create($data)) {
            return redirect($redirectTo)->with('success','Item created successfully!');
        }

        return redirect($redirectTo)->with('error','Not Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modality  $modality
     * @return \Illuminate\Http\Response
     */
    public function show(Modality $modality)
    {
        return view('modality.show', compact('modality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modality  $modality
     * @return \Illuminate\Http\Response
     */
    public function edit(Modality $modality)
    {
        return view('modality.edit', compact('modality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateModalityRequest  $request
     * @param  \App\Models\Modality  $modality
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModalityRequest $request, Modality $modality)
    {

        $data = $request->except(['_token', '_method']);

        $modality->fill($data);

        $redirectTo = route('modality.show', $modality);

        if($modality->save()) {
            return redirect($redirectTo)->with('success','Item created successfully!');
        }

        return redirect($redirectTo)->with('error','Not Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modality  $modality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modality $modality)
    {
        $redirectTo = route('modality.index');

        if($modality->delete()) {
            return redirect($redirectTo)->with('success','Item removed successfully!');
        }

        return redirect($redirectTo)->with('error','Item not removed successfully!');
    }


    private function listToDataTable($data) {

        $response = [];

        foreach($data as $item) {
            $response[] = [
                'id' => $item->id,
                'name' => sprintf('<a href="%s">%s</a>', route('modality.show', $item), $item->name),
                'status' => $item->status,
                'created_at' => $item->created_at->format('d/m/Y')
            ];
        }

        return response()->json(['data' => $response]);
    }
}
