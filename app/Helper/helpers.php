<?php

if (! function_exists('get_percentage')) {
    function get_percentage($value, $percent)
    {
        if ( $value > 0 ) {
            return round($percent * ($value / 100),2);
        } else {
            return 0;
        }
    }
}
