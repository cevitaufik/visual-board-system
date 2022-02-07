<?php

use App\Models\Production;
use App\Models\User;

if (!function_exists("userContributions")) {
  function userContributions($username) {
    $data = Production::whereEnd_by($username)
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

if (!function_exists("contributions")) {
  function contributions() {
    $users = User::all(['username']);
    $dataOutput = Production::all();

    $contributions = [];

    foreach ($users as $user) {
      $contributions[$user->username] = $dataOutput->where('end_by', $user->username)->count();
    }

    arsort($contributions);

    return $contributions;
  }  
}