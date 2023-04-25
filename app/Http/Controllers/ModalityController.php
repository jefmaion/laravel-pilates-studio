<?php

namespace App\Http\Controllers;

use App\Models\Modality;
use App\Http\Requests\StoreModalityRequest;
use App\Http\Requests\UpdateModalityRequest;
use App\Services\ModalityService;
use Illuminate\Http\Request;

class ModalityController extends Controller
{

    protected $modalityService;

    public function __construct(Request $request, ModalityService $modalityService)
    {
        parent::__construct($request);
        $this->modalityService = $modalityService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if($this->request->ajax()) {
            return $this->modalityService->listToDataTable();
        }

        $modalities = $this->modalityService->latest();
        $count      = count($modalities);
 
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

        if($this->modalityService->create($data)) {
            return redirect()->route('modality.index')->with('success','Modalidade cadastrada com sucesso!');
        }

        return redirect()->route('modality.index')->with('error','Não foi possível cadastrar a modalidade');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modality  $modality
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$modality = $this->modalityService->find($id)) {
            return redirect()->route('modality.index')->with('warning','Modalidade não encontrada!');
        }

        return view('modality.show', compact('modality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modality  $modality
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if(!$modality = $this->modalityService->find($id)) {
            return redirect()->route('modality.index')->with('warning','Modalidade não encontrada!');
        }

        return view('modality.edit', compact('modality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateModalityRequest  $request
     * @param  \App\Models\Modality  $modality
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModalityRequest $request, $id)
    {

        $data = $request->except(['_token', '_method']);

        if(!$modality = $this->modalityService->find($id)) {
            return redirect()->route('modality.index')->with('warning','Modalidade não encontrada!');
        }

        if($this->modalityService->update($modality, $data)) {
            return redirect()->route('modality.show', $modality)->with('success','Modalidade atualizada com sucesso!');
        }


        return redirect()->route('modality.show', $modality)->with('error','Não foi possível atualizar!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modality  $modality
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(!$modality = $this->modalityService->find($id)) {
            return redirect()->route('modality.index')->with('warning','Modalidade não encontrada!');
        }

        if(!$this->modalityService->delete($modality)) {
            return redirect()->route('modality.index')->with('error',$this->modalityService->getErrorMessage());
        }

        return redirect()->route('modality.index')->with('success','Modalidade excluída com sucesso!');
    }

}
