<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use stdClass;

class HelperController extends Controller
{
    

    public function zipcodeApi($zipcode) {
        $zipcode = str_replace("-", "",$zipcode);

        $data = new stdClass();
        $data->status = true;

        $apiURL = 'https://viacep.com.br/ws/' . $zipcode . '/json/';

        try {
            $response     = Http::get($apiURL);
            $statusCode   = $response->status();
            $data->data = json_decode($response->getBody());

            if (isset($data->data->erro)) {
                $data->status = false;
                $data->message = 'Cep não encontrado';
                return $data;
            }


            if ($statusCode == 400) {
                $data->status = false;
                $data->message = 'Informe um cep válido';
                return $data;
            }

            return $data;
            
        } catch (Exception $e) {
            $data->status = false;
            $data->message = 'Informe um cep válido';
            return $data;
        }
    }

}
