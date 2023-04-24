<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class AccountReceivableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::where('type', 'R')->latest()->get();

        if($this->request->ajax()) {
            return $this->listToDataTable($transactions);
         }
 
         return view('account_receive.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function listToDataTable($data) {

        $response = [];

        foreach($data as $item) {
            $response[] = [
                'id' => $item->id,
                'date' => $item->date,
                'name' => sprintf('<a href="%s">%s</a>', route('modality.show', $item), $item->description),
                'value' => $item->value,
                'method' => $item->paymentMethod->name,
                'status' => $item->statusLabel,
                'created_at' => $item->created_at->format('d/m/Y')
            ];
        }

        return response()->json(['data' => $response]);
    }
}
