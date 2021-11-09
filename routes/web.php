<?php

use App\Http\Controllers\EngineeringController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SuperadminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/user/superadmin', function(){
    if(auth()->user()->position != 'superadmin') {
        abort(403);
    }
    $data = User::where('username', 'superadmin')->get();

    return view('users.profile', [
        'user' => $data[0]
    ]);
});

Route::put('/user/{user:username}/update-password', [UserController::class, 'updatePassword'])->middleware('auth');
Route::resource('user', UserController::class)->scoped(['user' => 'username'])->middleware('auth');

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate']);

Route::get('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/register', [UserController::class, 'userRegister']);
Route::get('/logout', [UserController::class, 'logout']);

Route::resource('/order', OrderController::class)->scoped(['order' => 'shop_order']);

Route::get('/superadmin', [SuperadminController::class, 'index'])->middleware('auth');
Route::resource('/engineering', EngineeringController::class)->middleware('auth');