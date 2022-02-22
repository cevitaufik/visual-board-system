<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EngineeringController;
use App\Http\Controllers\FlowProcessController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\MailController;
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

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');

    Route::get('/register', 'register')->middleware('guest');
    Route::post('/register', 'userRegister');
    Route::get('/logout', 'logout');
});

Route::controller(TestController::class)->group(function () {
    Route::get('/scan', 'index');
    Route::get('/qr', 'qrIndex');
    Route::get('/qr/{input}', 'generateQR');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        $route = auth()->user()->position;
        return redirect('/' . $route);
    });

    Route::controller(UserController::class)->group(function () {
        Route::patch('/user/profile-picture', 'uploadImg');
        Route::get('/user/delete-profile-picture/{username}', 'deleteImg');
        Route::put('/user/{user:username}/update-password', 'updatePassword');
        Route::get('/user/contributions/{user:username}', 'userContributions');
        Route::get('/user/contributions', 'contributions');
    });

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

    Route::controller(FlowProcessController::class)->group(function () {
        Route::get('/flow-process/table', 'table');
        Route::get('/flow-process/create-new/{no_drawing}', 'createNew');
        Route::get('/flow-process/make-master/{shop_order}', 'makeMaster');
        Route::get('/flow-process/copy/{shop_order}', 'copyFlowProcessFromMaster');
        Route::get('/flow-process/print/{shop_order}', 'print');
        Route::get('/flow-process/delete/{shop_order}', 'deleteFlowProcess');
    });
    
    Route::resource('/flow-process', FlowProcessController::class);

    Route::resource('/work-center', WorkCenterController::class);

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer/table', 'table');
        Route::post('/customer/contact/create', 'addContact');
        Route::get('/customer/contact/{id}', 'contactDetail');
        Route::put('/customer/contact/{id}', 'editContact');
        Route::get('/customer/contact/{id}/delete', 'deleteContact');
    });
    
    Route::resource('/customer', CustomerController::class)->scoped(['customer' => 'code']);

    Route::get('/order/print-label/{shop_order}', [OrderController::class, 'printLabel']);
    Route::resource('/order', OrderController::class)->scoped(['order' => 'shop_order']);

    Route::get('/search', [SearchController::class, 'search']);

    Route::get('/productions/process/{shop_order}', [ProductionController::class, 'processForm']);
    Route::get('/productions/export-excel', [ProductionController::class, 'exportExcel']);
    Route::resource('/productions', ProductionController::class);

    Route::controller(MailController::class)->group(function() {
        Route::get('/send-email', 'confirmation');
        // el;6CybZZG9~
    });
});