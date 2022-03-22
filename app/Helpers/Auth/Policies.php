<?php

use App\Models\User;
use Illuminate\Support\Str;

if (!function_exists("userHasRole")) {
  function userHasRole(User $user, $role) {
    return (Str::contains($user->role, $role) || $user->username == 'superadmin');
  }
}