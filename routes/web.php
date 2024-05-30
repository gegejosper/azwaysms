<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\SmsController;

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
    return view('welcome');
});

//Route::get('/users', [UsersController::class, 'users']);
Route::get('/register', [UsersController::class, 'register_user']);
Route::get('/execute_sms', [SmsController::class, 'execute_sms']);

Route::prefix('panel')->group(function(){
    Route::get('/dashboard', [PanelController::class, 'dashboard']);
    Route::get('/api', [PanelController::class, 'api']);
    Route::get('/settings', [PanelController::class, 'settings']);
    Route::get('/sms_logs', [PanelController::class, 'sms_logs']);
    Route::get('/accounts', [PanelController::class, 'accounts']);
    Route::get('/accounts/{client_id}', [PanelController::class, 'account_view']);
    Route::post('/load/add', [PanelController::class, 'load_add']);
});
