<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TechStackController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StatisticProjectController;
use App\Http\Controllers\StatisticUserController;

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
    return redirect('login');
});


Route::middleware(['auth'])->group(function () {
	Route::resource('rooms', RoomController::class);
	Route::resource('customers', CustomerController::class);
	Route::resource('tech_stacks', TechStackController::class);
	Route::resource('projects', ProjectController::class);
	Route::resource('statistic_projects', StatisticProjectController::class);
	Route::resource('statistic_users', StatisticUserController::class);

	Route::resource('users', UserController::class);
	Route::get('/users/view-change-password/{user}', [UserController::class, 'viewChangePassword'])->name('users.view-change-password');
	Route::post('/users/change-password/{user}', [UserController::class, 'changePassword'])->name('users.change-password');

	Route::resource('roles', RoleController::class);
	Route::resource('permissions', PermissionController::class);
	Route::resource('types', TypeController::class);





});

require __DIR__.'/auth.php';
