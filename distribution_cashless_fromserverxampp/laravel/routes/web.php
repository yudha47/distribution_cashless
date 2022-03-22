<?php

use App\Http\Controllers\ActionClaimController;
use App\Http\Controllers\ActionSummaryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstructionCjController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WallboardController;

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

Route::get('/',[LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
Route::get('/home', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/dashboard/test', [DashboardController::class, 'test_function']);
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/pagenotfound', [DashboardController::class, 'page_404'])->middleware('auth');
Route::post('/dashboard/get_notif', [DashboardController::class, 'get_notif_all']);
Route::post('/dashboard/get_notif_action', [DashboardController::class, 'get_notif_action']);

Route::get('/wallboard/{mode?}', [WallboardController::class, 'index'])->middleware('auth');
Route::post('/wallboard/filter', [WallboardController::class, 'wallboard_daterange'])->middleware('auth');
Route::post('/wallboard/reload', [WallboardController::class, 'reload_action'])->middleware('auth');
Route::post('/wallboard/reload_count', [WallboardController::class, 'reload_count'])->middleware('auth');

Route::get('/summary/test', [ActionSummaryController::class, 'test_function']);
Route::get('/summary', [ActionSummaryController::class, 'index'])->middleware('auth');

Route::get('/users', [UserController::class, 'index'])->middleware('auth')->name('users');
Route::post('/users/add', [UserController::class, 'add_user'])->middleware('auth');
Route::post('/users/reset_password', [UserController::class, 'reset_password'])->middleware('auth');
Route::post('/users/get_user', [UserController::class, 'get_users'])->middleware('auth');
Route::post('/users/update', [UserController::class, 'update_users'])->middleware('auth');
Route::get('/users/delete/{id}', [UserController::class, 'delete_users'])->middleware('auth');
Route::post('/users/change_password', [UserController::class, 'change_password'])->middleware('auth');

Route::get('/action', [ActionClaimController::class, 'index']);
Route::get('/action/notif/{operator}/{type}', [ActionClaimController::class, 'action_by_notif'])->middleware('auth');
Route::get('/action/type/{type}/{mode?}/{operator?}', [ActionClaimController::class, 'action_type'])->middleware('auth');
Route::post('/action/filter', [ActionClaimController::class, 'action_daterange'])->middleware('auth');
Route::post('/action/refresh', [ActionClaimController::class, 'refresh_action'])->middleware('auth');
Route::post('/action/refresh_ft', [ActionClaimController::class, 'refresh_ft'])->middleware('auth');
Route::post('/action/refresh_status', [ActionClaimController::class, 'refresh_status'])->middleware('auth');
Route::post('/action/filter_status', [ActionClaimController::class, 'filter_status'])->middleware('auth');
Route::post('/action/input', [ActionClaimController::class, 'input_data'])->middleware('auth');
Route::post('/action/set_to_process', [ActionClaimController::class, 'set_to_process'])->middleware('auth');
Route::post('/action/get_action', [ActionClaimController::class, 'get_action'])->middleware('auth');
Route::post('/action/update', [ActionClaimController::class, 'update_action'])->middleware('auth');
Route::post('/action/delete', [ActionClaimController::class, 'delete_action'])->middleware('auth');
Route::post('/action/search', [ActionClaimController::class, 'search_action'])->middleware('auth');

Route::get('/instruction-cj/{mode?}', [InstructionCjController::class, 'index'])->middleware('auth');
Route::post('/instruction-cj/filter', [InstructionCjController::class, 'action_daterange'])->middleware('auth');
Route::post('/instruction-cj/refresh', [InstructionCjController::class, 'refresh_action'])->middleware('auth');
Route::post('/instruction-cj/refresh_ft', [InstructionCjController::class, 'refresh_ft'])->middleware('auth');
Route::post('/instruction-cj/refresh_status', [InstructionCjController::class, 'refresh_status'])->middleware('auth');
Route::post('/instruction-cj/input', [InstructionCjController::class, 'input_data'])->middleware('auth');
Route::post('/instruction-cj/get_action', [InstructionCjController::class, 'get_action'])->middleware('auth');
Route::post('/instruction-cj/set_to_process', [InstructionCjController::class, 'set_to_process'])->middleware('auth');
Route::post('/instruction-cj/update', [InstructionCjController::class, 'update_action'])->middleware('auth');
Route::post('/instruction-cj/filter_status', [InstructionCjController::class, 'filter_status'])->middleware('auth');
Route::post('/instruction-cj/delete', [InstructionCjController::class, 'delete_instruction'])->middleware('auth');
Route::post('/instruction-cj/search', [InstructionCjController::class, 'search_instruction'])->middleware('auth');