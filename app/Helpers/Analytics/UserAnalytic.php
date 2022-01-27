<?php

use App\Models\Production;

if (!function_exists("userAnalytic")) {
  function userAnalytic($username) {
    $output = Production::whereProcessed_by($username)
                          ->where('end', '<>', null)
                          ->orderBy('created_at', 'desc')
                          ->get(['end']);

    return date('d-M-Y', strtotime($output->first()->end));
    // return gettype($output->first()->end);
    // return [1,3, 20, 10, 4, 18, 1,3, 20, 10, 4, 18, 0, 0, 0];
  }
}