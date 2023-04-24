<?php 

namespace App\Services;

use App\Models\Student;
use App\Models\User;

class StudentService {


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
        return Student::latest()->get();
    }


}