<?php

if (!function_exists('classTime')) {
    function classTime() {
        return  [
            '07:00:00' => '07:00',
            '08:00:00' => '08:00',
            '09:00:00' => '09:00',
            '10:00:00' => '10:00',
            '11:00:00' => '11:00',
            '12:00:00' => '12:00',
            '13:00:00' => '13:00',
            '14:00:00' => '14:00',
            '15:00:00' => '15:00',
            '16:00:00' => '16:00',
            '17:00:00' => '17:00',
            '18:00:00' => '18:00',
            '19:00:00' => '19:00',
            '20:00:00' => '20:00',
        ];
    }
}

if (!function_exists('classWeek')) {
    function classWeek($id=null) {
        $data =  [
            1 => 'Segunda-Feira',
            2 => 'Terça-Feira',
            3 => 'Quarta-Feira',
            4 => 'Quinta-Feira',
            5 => 'Sexta-Feira',
            6 => 'Sábado'
        ] ;

        return (empty($id)) ? $data : $data[$id];
    }
}

if(!function_exists('classMonths')) {
    function classMonths($id=null) {
        $data = [
            1 => 'Mensal',
            2 => 'Bimestral',
            3 => 'Trimestre',
            6 => 'Semestral',
            12 => 'Anual'
        ];

        return (empty($id)) ? $data : $data[$id];
    }
}

if(!function_exists('image')) {
    function image($src) {
        return sprintf('<img alt="image" src="%s" class="rounded-circle" width="35" data-toggle="tooltip">', $src);
    }
}

if(!function_exists('anchor')) {
    function anchor($href='#', $label='#', $class='') {
        return sprintf('<a href="%s" class="%s">%s</a>', $href, $class, $label);
    }
}

if(!function_exists('currency')) {
    function currency($value=null, $toDatabase=false) {
        if (empty($value)) {
            return;
        }

        if($toDatabase) {
            return str_replace(",", ".", str_replace('.', '', $value));
        }
        
        return number_format($value, 2, ",", ".");
    }
}

if(!function_exists('formatData')) {
    function formatData($value, $format='d/m/Y', $suffix='') {

        if(empty($value)) {
            return null;
        }

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        return date($format, strtotime($value)) . $suffix;
    }
}