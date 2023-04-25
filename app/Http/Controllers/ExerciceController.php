<?php

namespace App\Http\Controllers;

use App\Models\Exercice;
use App\Http\Requests\StoreExerciceRequest;
use App\Http\Requests\UpdateExerciceRequest;
use App\Services\ExerciceService;
use Illuminate\Http\Request;

class ExerciceController extends Controller
{

    protected $exerciceService;

    public function __construct(Request $request, ExerciceService $exerciceService)
    {
        parent::__construct($request);
        $this->exerciceService = $exerciceService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if($this->request->ajax()) {
            return $this->exerciceService->listToDataTable();
        }

        $exercices = $this->exerciceService->latest();
        $count     = count($exercices);
 
        return view('exercice.index', compact('count'));
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
        $data       = $request->except(['_token', '_method']);
        $redirectTo = route('exercice.index');

        if($this->exerciceService->create($data)) {
            return redirect($redirectTo)->with('success','Exercício criado com sucesso!');
        }

        return redirect($redirectTo)->with('error','Houve algum erro ao salvar o exercício');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$exercice = $this->exerciceService->find($id)) {
            return redirect()->route('exercice.index')->with('error', 'Exercício não encontrado');
        }

        return view('exercice.show', compact('exercice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$exercice = $this->exerciceService->find($id)) {
            return redirect()->route('exercice.index')->with('error', 'Exercício não encontrado');
        }

        return view('exercice.edit', compact('exercice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExerciceRequest  $request
     * @param  \App\Models\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExerciceRequest $request, $id)
    {
        $data = $request->except(['_token', '_method']);

        if(!$exercice = $this->exerciceService->find($id)) {
            return redirect()->route('exercice.index')->with('error', 'Exercício não encontrado');
        }

        if($this->exerciceService->update($exercice, $data)) {
            return redirect()->route('exercice.show', $exercice)->with('success','Exercício atualizado com sucesso!');
        }

        return redirect()->route('exercice.index')->with('error','Não foi possível atualizar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(!$exercice = $this->exerciceService->find($id)) {
            return redirect()->route('exercice.index')->with('error', 'Exercício não encontrado');
        }

        if($this->exerciceService->delete($exercice)) {
            return redirect()->route('exercice.index')->with('success','Exercício removido com sucesso');
        }

        return redirect()->route('exercice.index')->with('error','Item not removed successfully!');
    }

    
}
