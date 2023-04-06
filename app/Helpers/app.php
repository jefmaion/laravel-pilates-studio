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