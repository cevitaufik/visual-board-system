<?php

use App\Models\Production;

if (!function_exists("userAnalytic")) {
  function userAnalytic($username) {
    $data = Production::whereProcessed_by($username)
                          ->where('end', '<>', null)
                          ->orderBy('created_at', 'desc')
                          ->limit(100)
                          ->get(['end']);

    $outputsDate = [];
    foreach ($data as $output) {
      array_push($outputsDate, date('d-M-Y', strtotime($output->end)));
    }

    $outputsDate = array_count_values($outputsDate);

    $hundredDays = [];
    for ($i = 0; $i < 100; $i++) {
      array_push($hundredDays, date('d-M-Y', strtotime(now()->subDay($i))));
    }

    $outputs = [];
    foreach ($hundredDays as $day) {
      $outputs[$day] = 0;
    }

    foreach ($outputsDate as $key => $val) {
      $outputs["$key"] = $val;
    }

    return $outputs;
  }
}