<?php

namespace App\Http\Controllers;

use App\Models\AccountReceivable;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use App\Services\StudentService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountReceivableController extends Controller
{

    protected $studentService;

    public function __construct(Request $request, StudentService $studentService)
    {
        parent::__construct($request);
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = AccountReceivable::with(['category', 'paymentMethod'])->latest()->get();

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
        $account        = new AccountReceivable();
        $paymentMethods = PaymentMethod::select('id', 'name')->get()->toArray();
        $categories     = Category::select('id', 'name')->get()->toArray();
        $students       = $this->studentService->listCombo();

        return view('account_receive.create', compact('account', 'paymentMethods', 'categories', 'students'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_method', '_token']);

        if($data['status'] == 1) {
            $data['pay_date'] = $data['date'];
            $data['amount']   = $data['value'];
        }

        AccountReceivable::create($data);

        return redirect()->route('receive.index')->with('success','Conta atualizado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = AccountReceivable::find($id);

        return view('account_receive.show', compact('account'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function receive($id)
    {
        $account = AccountReceivable::find($id);
        $paymentMethods = PaymentMethod::select('id', 'name')->get()->toArray();
        $categories = Category::select('id', 'name')->get()->toArray();

        $account->amount = $account->value;

        $dateToPay = date('Y-m-d');
        
        if($dateToPay > $account->date) {
            $daysLate  = Carbon::parse($dateToPay)->diffInDays($account->date);
            $fees      = ($daysLate * 0.033) / 100;
            $account->amount = $account->value +  ($account->value * (2 / 100)) + ($account->fees * $account->value);
        }
        return view('account_receive.receive', compact('account', 'paymentMethods', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = AccountReceivable::find($id);
        $paymentMethods = PaymentMethod::select('id', 'name')->get()->toArray();
        $categories = Category::select('id', 'name')->get()->toArray();
        $students = $this->studentService->listCombo();

        return view('account_receive.edit', compact('account', 'paymentMethods', 'categories', 'students'));
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

      

        $data = $request->except(['_method', '_token']);
        
        // $data['status'] = 1;
        $data['user_id'] = auth()->user()->id;

        $account = AccountReceivable::find($id);

        // dd($data);

        $account->fill($data)->update();

        if($url = $request->get('to')) {
            return redirect($url)->with('success','Conta atualizado com sucesso!');
        }

        return redirect()->route('receive.index')->with('success','Conta atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccountReceivable::find($id)->delete();

        return redirect()->route('receive.index')->with('success','Conta atualizado com sucesso!');
    }

    private function listToDataTable($data) {

        $response = [];

        foreach($data as $item) {
            $response[] = [
                'id' => $item->id,
                'date' => formatData($item->date),
                'pay_date' => (!empty($item->pay_date)) ? formatData($item->pay_date) : null,
                'name' => sprintf('<a href="%s">%s</a>', route('receive.show', $item), $item->description),
                'value' => currency($item->value),
                'category' => $item->category->name,
                'amount' => currency($item->amount),
                'method' => $item->paymentMethod->name,
                'status' => $item->statusLabel,
                'created_at' => $item->created_at->format('d/m/Y')
            ];
        }

        return response()->json(['data' => $response]);
    }
}
