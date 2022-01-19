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
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\SearchController;
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

Route::get('/user/superadmin', function(){
    if(auth()->user()->position != 'superadmin') {
        abort(403);
    }
    $data = User::where('username', 'superadmin')->get();

    return view('users.profile', [
        'user' => $data[0]
    ]);
});

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate']);

Route::get('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/register', [UserController::class, 'userRegister']);
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/scan', [TestController::class, 'index']);
Route::get('/qr', [TestController::class, 'qrIndex']);
Route::get('/qr/{input}', [TestController::class, 'generateQR']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        $route = auth()->user()->position;
        return redirect('/' . $route);
    });

    Route::patch('/user/profile-picture', [UserController::class, 'uploadImg']);
    Route::get('/user/delete-profile-picture/{username}', [UserController::class, 'deleteImg']);
    Route::put('/user/{user:username}/update-password', [UserController::class, 'updatePassword']);
    Route::resource('user', UserController::class)->scoped(['user' => 'username']);

    Route::resource('/job-type', JobTypeController::class);

    Route::get('/superadmin', [SuperadminController::class, 'index']);
    Route::get('/superadmin/table', [SuperadminController::class, 'table']);

    Route::get('/engineering/table', [EngineeringController::class, 'table']);
    Route::resource('/engineering', EngineeringController::class);

    Route::get('/marketing/table', [MarketingController::class, 'table']);
    Route::resource('/marketing', MarketingController::class);

    Route::get('/tool/table', [ToolController::class, 'table']);
    Route::get('/tool/get-drawing/{toolCode}/{cust}', [ToolController::class, 'getDrawing']);
    Route::resource('/tool', ToolController::class)->scoped(['tool' => 'drawing']);

    Route::get('/flow-process/table', [FlowProcessController::class, 'table']);
    Route::get('/flow-process/create-new/{no_drawing}', [FlowProcessController::class, 'createNew']);
    Route::get('/flow-process/make-master/{shop_order}', [FlowProcessController::class, 'makeMaster']);
    Route::get('/flow-process/copy/{shop_order}', [FlowProcessController::class, 'copyFlowProcessFromMaster']);
    Route::get('/flow-process/print/{shop_order}', [FlowProcessController::class, 'print']);
    Route::get('/flow-process/delete/{shop_order}', [FlowProcessController::class, 'deleteFlowProcess']);
    Route::resource('/flow-process', FlowProcessController::class);

    Route::resource('/work-center', WorkCenterController::class);

    Route::get('/customer/table', [CustomerController::class, 'table']);
    Route::post('/customer/contact/create', [CustomerController::class, 'addContact']);
    Route::get('/customer/contact/{id}', [CustomerController::class, 'contactDetail']);
    Route::put('/customer/contact/{id}', [CustomerController::class, 'editContact']);
    Route::get('/customer/contact/{id}/delete', [CustomerController::class, 'deleteContact']);
    Route::resource('/customer', CustomerController::class)->scoped(['customer' => 'code']);

    Route::get('/order/print-label/{shop_order}', [OrderController::class, 'printLabel']);
    Route::resource('/order', OrderController::class)->scoped(['order' => 'shop_order']);

    Route::get('/search', [SearchController::class, 'search']);

    Route::get('/productions/process/{shop_order}', [ProductionController::class, 'processForm']);
    Route::resource('/productions', ProductionController::class);
});