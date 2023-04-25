<?php

namespace App\Services;

use App\Models\Classes;
use App\Models\InstructorModality;
use App\Models\InstructorRemuneration;
use App\Models\InstructorValues;
use App\Models\Modality;

class ClassService
{

    public function findClass($id) {
        return Classes::find($id);
    }

    public function updateClass(Classes $class, $data) {
        return $class->fill($data)->update();
    }

    public function remarkClass(Classes $class, $data) {

        $newClass                          = $class->replicate();
        $newClass->date                    = $data['date'];
        $newClass->time                    = $data['time'];
        $newClass->instructor_id           = $data['instructor_id'];
        $newClass->scheduled_instructor_id = $newClass->instructor_id;
        $newClass->type                    = 'RP';
        $newClass->status                  = 0;
        $newClass->finished                = 0;
        $newClass->absense_comments        = null;
        $newClass->classes_id              = $class->id;
        $newClass->save();

        $class->has_replacement = 1;
        // $class->parent()->associate($newClass);

        return $class->save();
    }

    public function reset(Classes $class) {
        $class->status           = 0;
        $class->absense_comments = null;
        $class->comments         = null;

        $class->remunerations()->whereNull('pay_date')->delete();

        return $class->save();
    }

    public function absense(Classes $class, $type, $comments = '')
    {
        $class->status = $type;
        $class->absense_comments = $comments;
        $class->finished = 1;

        if(!$class->save()) {
            return false; 
        }


        $this->setInstructorRemunerate($class);
        return true;
    }

    public function presence(Classes $class, $exercices = null, $evolution = null)
    {

        $class->status    = 1;
        $class->finished  = 1;
        $class->evolution = $evolution;

        if ($exercices) {
            $class->exercices()->sync($exercices);
        }

        $this->setInstructorRemunerate($class);

        return $class->save();
    }

    private function setInstructorRemunerate($class)
    {


        $modalityValues = $class->instructor->getModalityValues($class->registration->modality->id);

  
        if (!$modalityValues) {
            return;
        }

        if($class->status == 2) {
            return;
        }

        if ($class->status == 3 && $modalityValues->pivot->calc_on_absense == 0) {
            return;
        }

        $classValue = $class->registration->class_value;
        $value = 0;
        $remuneration = [];

        if ($modalityValues->pivot->remuneration_type == 'F') {
            $value = currency($modalityValues->pivot->remuneration_value, true);
        }

        if (in_array($modalityValues->pivot->remuneration_type, ['P'])) {
            $value = $classValue *  (currency($modalityValues->pivot->remuneration_value, true) / 100);
        }

        
        if($value > 0) {
            $remuneration[] = [
                'instructor_id' => $class->instructor_id,
                'classes_id'    => $class->id,
                'class_value' => $classValue,
                'instructor_value' => $value
            ];
        }

        

        if ($partners = InstructorModality::where('remuneration_type', 'S')->where('modality_id', $class->registration->modality->id)->get()) {

            $rest = $classValue - $value;

            foreach ($partners as $partner) {

                $partnerValue =   $rest *  (currency($partner->remuneration_value, true) / 100);

                $remuneration[] = [
                    'instructor_id' => $partner->instructor_id,
                    'classes_id'    => $class->id,
                    'class_value' => $classValue,
                    'instructor_value'   => $partnerValue
                ];
            }
        }


        
        
        foreach ($remuneration as $remun) {
            InstructorRemuneration::create($remun);
        }

        

    }
}
