<?php

namespace App\Helpers;


if (! function_exists('_pr')) {
    function _pr($data, $die = false)
    {
        echo '<pre style="background:#111;color:#0f0;padding:10px;">';
        print_r($data);
        echo '</pre>';

        if ($die) {
            die;
        }
    }
}
