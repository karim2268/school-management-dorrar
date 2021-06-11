<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\backend\ProfileController;


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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');

///////////////User Management//////////////////////////

Route::prefix('users/')->group(function () {
    Route::get('view', [UserController::class, 'UserView'] )->name('users.view');

    Route::get('edit/{id}', [UserController::class, 'UserEdit'] )->name('users.edit');
    Route::post('update/{id}', [UserController::class, 'UserUpadte'] )->name('users.update');


    Route::get('delete/{id}', [UserController::class, 'UserDelete'] )->name('users.delete');

    Route::get('add', [UserController::class, 'UserAdd'] )->name('users.add');

    Route::post('store', [UserController::class, 'UserStore'] )->name('users.store');
});

//user profile and change password
Route::prefix('profile/')->group(function () {
    Route::get('view', [ProfileController::class, 'ProfileView'] )->name('users.profile');

    Route::get('changepassword', [ProfileController::class, 'ChangePassword'] )->name('users.changepassword');

   
});