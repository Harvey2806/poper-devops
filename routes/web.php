<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('students', StudentController::class);

//Route::prefix('admin')->namespace('Admin')->group(function () {
//    Route::resource('students', StudentController::class)->middleware('role:admin');
//});

//Route::middleware('role:student')->group(function () {
//    Route::get('profile', [StudentController::class, 'profile'])->name('students.profile');
//    Route::post('profile/update', [StudentController::class, 'updateProfile'])->name('students.profile.update');
//});
//
//Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin']], function () {
//    Route::get('users', [AdminController::class, 'manageUsers'])->name('users');
//    Route::post('users/assign-role', [AdminController::class, 'assignRole'])->name('users.assign-role');
//    Route::post('users/remove-role', [AdminController::class, 'removeRole'])->name('users.remove-role');
//    Route::post('users/give-permission', [AdminController::class, 'givePermission'])->name('users.give-permission');
//    Route::post('users/revoke-permission', [AdminController::class, 'revokePermission'])->name('users.revoke-permission');
//});