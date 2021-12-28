<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EngineeringController;
use App\Http\Controllers\FlowProcessController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\MarketingController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\WorkCenterController;

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
    $route = auth()->user()->position;
    return redirect('/' . $route);
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

Route::patch('/user/profile-picture', [UserController::class, 'uploadImg'])->middleware('auth');
Route::get('/user/delete-profile-picture/{username}', [UserController::class, 'deleteImg'])->middleware('auth');
Route::put('/user/{user:username}/update-password', [UserController::class, 'updatePassword'])->middleware('auth');
Route::resource('user', UserController::class)->scoped(['user' => 'username'])->middleware('auth');

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate']);

Route::get('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/register', [UserController::class, 'userRegister']);
Route::get('/logout', [UserController::class, 'logout']);

Route::resource('/order', OrderController::class)->scoped(['order' => 'shop_order']);

Route::resource('/job-type', JobTypeController::class)->middleware('auth');

Route::get('/superadmin', [SuperadminController::class, 'index'])->middleware('auth');
Route::get('/superadmin/table', [SuperadminController::class, 'table'])->middleware('auth');

Route::get('/engineering/table', [EngineeringController::class, 'table'])->middleware('auth');
Route::resource('/engineering', EngineeringController::class)->middleware('auth');

Route::get('/marketing/table', [MarketingController::class, 'table'])->middleware('auth');
Route::resource('/marketing', MarketingController::class)->middleware('auth');

Route::get('/tool/table', [ToolController::class, 'table'])->middleware('auth');
Route::get('/tool/get-drawing/{toolCode}/{cust}', [ToolController::class, 'getDrawing'])->middleware('auth');
Route::resource('/tool', ToolController::class)->scoped(['tool' => 'drawing'])->middleware('auth');

Route::get('/flow-process/table', [FlowProcessController::class, 'table'])->middleware('auth');
Route::get('/flow-process/create-new/{no_drawing}', [FlowProcessController::class, 'createNew'])->middleware('auth');
Route::get('/flow-process/copy/{shop_order}/{no_drawing}', [FlowProcessController::class, 'copy'])->middleware('auth');
Route::resource('/flow-process', FlowProcessController::class)->middleware('auth');

Route::resource('/work-center', WorkCenterController::class)->middleware('auth');

Route::get('/customer/table', [CustomerController::class, 'table'])->middleware('auth');
Route::post('/customer/contact/create', [CustomerController::class, 'addContact'])->middleware('auth');
Route::get('/customer/contact/{id}', [CustomerController::class, 'contactDetail'])->middleware('auth');
Route::put('/customer/contact/{id}', [CustomerController::class, 'editContact'])->middleware('auth');
Route::get('/customer/contact/{id}/delete', [CustomerController::class, 'deleteContact'])->middleware('auth');
Route::resource('/customer', CustomerController::class)->scoped(['customer' => 'code'])->middleware('auth');

Route::get('/scan', [TestController::class, 'index']);