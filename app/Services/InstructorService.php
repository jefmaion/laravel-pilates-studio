<?php 

namespace App\Services;

use App\Models\Instructor;
use App\Models\User;

class InstructorService {


    public function createInstructor(array $request) {

        if(!$user = User::create($request)) {
            return false;
        }

        $instructor = new Instructor();
        $instructor->fill($request)->user()->associate($user)->save();

        return $instructor;

    }

    public function updateInstructor(Instructor $instructor, array $request) {

        $instructor->fill($request)->save();
        return $instructor->user->fill($request)->save();
    }

    public function deleteInstructor(Instructor $instructor) {

        $user = $instructor->user;

        $instructor->delete();
        $user->delete();

        return true;
    }

    public function listInstructor() {
        return Instructor::all();
    }


}