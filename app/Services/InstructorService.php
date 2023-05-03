<?php 

namespace App\Services;

use App\Models\Instructor;
use App\Models\User;

class InstructorService extends Service {

    
    public function __construct(Instructor $instructor)
    {
        parent::__construct($instructor);
    }

    public function findInstructor($id) {
        return Instructor::find($id);
    }

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

    public function addModality(Instructor $instructor, $data) {
        return $instructor->modalities()->attach($instructor, $data);
    }

    public function removeModality(Instructor $instructor, $idModality) {

        return $instructor->modalities()->detach($idModality);
    }

    public function deleteInstructor(Instructor $instructor) {

        $user = $instructor->user;

        $instructor->delete();
        $user->delete();

        return true;
    }

    public function listInstructor() {
        return Instructor::latest()->with('user')->get();
    }

    public function listCombo() {
        return array_map(function($instructor) {
            return [$instructor['id'], $instructor['user']['name']];
        }, $this->listInstructor()->toArray());
    }

    public function listToDataTable() {

        $response = [];
        $data = $this->listInstructor();

        foreach($data as $item) {
            $response[] = [
                'id' => $item->id,
                'name' => image(asset($item->user->image)) . anchor(route('instructor.show', $item), $item->user->name, 'ml-2'),
                'phone_wpp' => $item->user->phone_wpp,
                'created_at' => $item->created_at->format('d/m/Y')
            ];
        }


        return json_encode(['data' => $response]);
    }


}