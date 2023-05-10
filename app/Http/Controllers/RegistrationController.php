<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Requests\UpdateRegistrationRequest;
use App\Services\InstructorService;
use App\Services\ModalityService;
use App\Services\PaymentMethodService;
use App\Services\RegistrationService;
use App\Services\StudentService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    protected $registrationService;
    protected $modalityService;
    protected $paymentMethodService;
    protected $instructorService;
    protected $studentService;

    public function __construct(
        Request $request, 
        RegistrationService $registrationService,
        ModalityService $modalityService,
        PaymentMethodService $paymentMethod,
        InstructorService $instructorService,
        StudentService $studentService
    )
    {
        parent::__construct($request);
        $this->registrationService = $registrationService;
        $this->modalityService = $modalityService;
        $this->paymentMethodService = $paymentMethod;
        $this->instructorService = $instructorService;
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if($this->request->ajax()) {
            return $this->registrationService->listToDataTable($this->request->get('active'));
        }

        return view('registration.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->edit(null, false);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRegistrationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegistrationRequest $request)
    {
        $data = $request->all();

        if($registration = $this->registrationService->makeRegistration($data)) {
            return redirect()->route('registration.show', $registration)->with('success', 'Matrícula Realizada com successo!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$registration = $this->registrationService->findRegistration($id)) {
            return redirect()->route('registration.index')->with('warning','Matrícula não encontrada!');
        }

        return view('registration.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit($id=null, $renew=false)
    {

        $view = 'registration.edit';

        if(is_null($id)) {
            $registration = new Registration();
        }
        
        if(!is_null($id)) { 
            if(!$registration = $this->registrationService->findRegistration($id)) {
                return redirect()->route('registration.index')->with('warning','Matrícula não encontrada!');
            }
        }

        $modalities     = $this->modalityService->listCombo();
        $instructors    = $this->instructorService->listCombo();
        $paymentMethods = $this->paymentMethodService->listCombo();
        $students       = $this->studentService->listCombo();
        
        $weekclass = [];
        foreach($registration->weekclass as $wk) {
            $weekclass['time'][$wk->weekday] = $wk->time;
            $weekclass['instructor'][$wk->weekday] = $wk->instructor_id;
        }

        if(empty($registration->id)) {
            $view = 'registration.create';
        }

        if($renew) {
            $view = 'registration.renew';

            $registration->start = $registration->end;
        }


        return view($view, compact('registration', 'modalities', 'instructors', 'students', 'weekclass', 'paymentMethods'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegistrationRequest  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegistrationRequest $request, $id)
    {

        $data = $request->all();

        if(!$registration = $this->registrationService->findRegistration($id)) {
            return redirect()->route('registration.index')->with('warning','Matrícula não encontrada!');
        }

        if($this->registrationService->updateRegistration($registration, $data)) {
            return redirect()->route('registration.show', $registration)->with('success', 'Matrícula Atualizada com successo!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        if(!$registration = $this->registrationService->findRegistration($id)) {
            return redirect()->route('registration.index')->with('warning','Matrícula não encontrada!');
        }

        if($this->registrationService->delete($registration)) {
            return redirect()->route('registration.index')->with('success', 'Matrícula Excluida com successo!');
        }
    }

    public function cancel($id) {

        if(!$registration = $this->registrationService->findRegistration($id)) {
            return redirect()->route('registration.index')->with('warning','Matrícula não encontrada!');
        }

        return view('registration.cancel', compact('registration'));
    }

    public function abort($id, Request $request) {

        if(!$registration = $this->registrationService->findRegistration($id)) {
            return redirect()->route('registration.index')->with('warning','Matrícula não encontrada!');
        }

        $this->registrationService->cancelRegistration($registration, $request->input('comments'));

        return redirect()->route('registration.index')->with('success', 'Matrícula Cancelada com successo!');
       
    }

    public function renew($id) {
        return $this->edit($id, true);
    }

    
}
