<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Requests\UpdateRegistrationRequest;
use App\Models\Instructor;
use App\Models\Modality;
use App\Models\Student;
use App\Services\RegistrationService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    protected $registrationService;

    public function __construct(Request $request, RegistrationService $registrationService)
    {
        parent::__construct($request);
        $this->registrationService = $registrationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $registrations = Registration::all();


        
        if($this->request->ajax()) {
            return $this->listToDataTable($registrations);
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
        // $modalities = Modality::select(['id', 'name'])->get()->toArray();

        // $data = Instructor::all();
        
        // $instructors = [];
        // foreach($data as $inst) {
        //     $instructors[] = [$inst->id, $inst->user->name];
        // }

        // $data = Student::all();
        
        // $students = [];
        // foreach($data as $inst) {
        //     $students[] = [$inst->id, $inst->user->name];
        // }

        // return view('registration.create', compact('modalities', 'instructors', 'students'));

        return $this->edit(new Registration());
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

        // dd($data);

        if($this->registrationService->makeRegistration($data)) {
            return redirect()->route('registration.index')->with('success', 'Matrícula Realizada com successo!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        return view('registration.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        
        $modalities = Modality::select(['id', 'name'])->get()->toArray();

        $data = Instructor::all();
        
        $instructors = [];
        foreach($data as $inst) {
            $instructors[] = [$inst->id, $inst->user->name];
        }

        $data = Student::all();
        
        $students = [];
        foreach($data as $inst) {
            $students[] = [$inst->id, $inst->user->name];
        }

        if(empty($registration->id)) {
            return view('registration.create', compact('registration', 'modalities', 'instructors', 'students'));
        }

        return view('registration.edit', compact('registration', 'modalities', 'instructors', 'students'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegistrationRequest  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegistrationRequest $request, Registration $registration)
    {

        $data = $request->all();

 

        if($this->registrationService->updateRegistration($registration, $data)) {
            return redirect()->route('registration.index')->with('success', 'Matrícula Atualizada com successo!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {   

        $registration->classes()->delete();
        $registration->delete();


        return redirect()->route('registration.index')->with('success', 'Matrícula Excluida com successo!');
    }

    private function listToDataTable($data) {

        $response = [];

        foreach($data as $item) {
            $response[] = [
                'name' => image(asset($item->student->user->image)) . sprintf('<a href="%s">%s</a>', route('registration.show', $item), $item->student->user->name),
                'start' => $item->start,
                'end' => $item->end->format('d/m/Y'),
                'modality' => $item->modality->name,
                'created_at' => $item->created_at->format('d/m/Y')
            ];
        }

        return response()->json(['data' => $response]);
    }
}
