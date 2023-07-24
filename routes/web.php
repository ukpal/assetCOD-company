<?php

use App\Http\Controllers\Administrator\AuthController;
use App\Http\Controllers\Administrator\HomeController;
use App\Http\Controllers\Administrator\ModuleController;
use App\Http\Controllers\Administrator\ModulePermissionController;
use App\Http\Controllers\Administrator\RoleController;
use App\Http\Controllers\Administrator\SettingController;
use App\Http\Controllers\Administrator\SubscriptionController;
use App\Http\Controllers\Administrator\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;




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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/clear',function(){
    \Artisan::call('cache:clear');
});

Route::redirect('/', 'admin/dashboard');
Route::redirect('/login', 'admin/login')->name('login');
Route::get('/logout', [AuthController::class, 'logout_new'])->name('logout');
// Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('checkAuth');

Route::get('/off-status',function(){
    // echo Session::get('companyStatus');
    Session::flush();
});
// Route::get('/off-status',[AuthController::class, 'offCompanyStatus']);

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/postlogin', [AuthController::class, 'postLogin'])->name('postLogin');
});

Route::group(['middleware' =>  ['checkAuth','dynamicDB','checkCompanyStatus','checkValidSubscription'],'prefix'=>'admin'], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    
    Route::prefix('modules')->group(function () {
        Route::controller(ModuleController::class)->group(function () {
            Route::get('/', 'modules')->name('modules');
            Route::get('/status/update', 'statusUpdate')->name('update.status');
        });
    });

    Route::prefix('subscription')->group(function () {
        Route::controller(SubscriptionController::class)->group(function () {
            Route::get('/', 'subscriptions')->name('subscription');
        });
    });

    Route::prefix('settings')->group(function () {
        Route::controller(SettingController::class)->group(function () {
            Route::get('/', 'index')->name('settings');
            Route::get('/get-general-setting', 'getAjaxData')->name('get-general-setting');
            Route::get('/edit', 'editSetting')->name('edit.setting');
            Route::post('/update', 'updateSetting')->name('update.setting');
        });
    });

    Route::prefix('roles')->group(function () {
        Route::controller(RoleController::class)->group(function () {
            Route::get('/', 'index')->name('roles');
            Route::get('/create', 'createRole')->name('create.role');
            Route::post('/store', 'storeRole')->name('store.role');
            Route::get('/edit/{role}', 'editRole')->name('edit.role');
            Route::post('/update/{role}', 'updateRole')->name('update.role');
        });
    });

    Route::prefix('users')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('users');
            Route::get('/status/update', 'statusUpdate')->name('users.update.status');
            Route::get('/create', 'createUser')->name('create.user');
            Route::post('/store', 'storeUser')->name('store.user');
            Route::get('/edit/{id}', 'edituser')->name('edit.user');
            Route::post('/update/{id}', 'updateUser')->name('update.user');
            Route::post('/delete/{id}', 'deleteUser')->name('delete.user');
        });
    });

    Route::get('role-permission/{role_id}',[RoleController::class, 'getPermissions'])->name('role.permission');
    Route::post('set-role-permission',[RoleController::class, 'setPermissions']);
});





