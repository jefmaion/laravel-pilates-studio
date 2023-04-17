<?php

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
        return date($format, strtotime($value)) . $suffix;
    }
}