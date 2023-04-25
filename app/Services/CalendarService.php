<?php

namespace App\Services;

use App\Models\Classes;
use Carbon\Carbon;

class CalendarService
{


    public function listClasses($params) {

        

        $start = Carbon::parse($params['start']);
        $end   = Carbon::parse($params['end']);

    
        $data  = Classes::whereBetween('date', [$start, $end])->orderBy('id', 'desc');

        if($params['_modality_id']) {
            $data = Classes::whereHas('registration', function($q) use($params) {
                $q->where('modality_id','=', $params['_modality_id']);
            });
        }

        $params = array_diff_key($params, array_flip(['_', 'start', 'end', '_modality_id']));

        foreach ($params as $key => $value) {
            if ($value == "") continue;
            $key = ltrim($key, $key[0]);
            $data->where($key, $value);
        }


        return $data->get();

    }

}