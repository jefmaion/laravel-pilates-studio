<?php 

namespace App\Services;

use App\Models\Student;
use App\Models\User;

class StudentService extends Service {

    public function __construct(Student $student)
    {
        parent::__construct($student);
    }

    public function findStudent($id) {
        return Student::find($id);
    }

    public function createStudent(array $request) {

        if(!$user = User::create($request)) {
            return false;
        }

        $student = new Student();
        $student->fill($request)->user()->associate($user)->save();

        return $student;

    }

    public function updateStudent(Student $student, array $request) {

        $student->fill($request)->save();
        return $student->user->fill($request)->save();
    }

    public function deleteStudent(Student $student) {

        $user = $student->user;

        $student->delete();
        $user->delete();

        return true;
    }

    public function listStudents() {
        return Student::with(['user','registration'])->get();
    }


    public function listEnrolledStudents() {
        return Student::with('user')->whereHas('registration', function($q)  {
                $q->where('status',1);
            })->get();
    }

    public function listCombo($justEnrolled=false) {

        $data = $this->listStudents();

        if($justEnrolled) {
            $data = $this->listEnrolledStudents();
        }

        $items = array_map(function($student) {
            return [$student['id'], $student['user']['name']];
        }, $data->toArray());

         
        $sort = [];
        foreach ($items as $key => $row) {
            $sort[$key]  = $row[1];
        }

        // // Sort the data with attack descending
        array_multisort($sort, SORT_ASC, $items);

        return $items;
    }

    public function listToDataTable() {

        $response = [];
        $data = $this->listStudents();

        foreach($data as $item) {
            $response[] = [
                'id' => $item->id,
                'name' => image(asset($item->user->image)) . anchor(route('student.show', $item), $item->user->name, 'ml-2'),
                'phone_wpp' => $item->user->phone_wpp,
                'created_at' => $item->created_at->format('d/m/Y'),
                'has_registration' => ($item->registration->count()) ? 'Sim' : 'Não'
            ];
        }


        return json_encode(['data' => $response]);
    }

}