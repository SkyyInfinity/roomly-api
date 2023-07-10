<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route('admin.login'));
});

// if logged as admin
// Route::group([], function() {
//     Route::get('/admin', function() {
//         return redirect()->route('admin.dashboard');
//     });
//     Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
//     Route::get('/admin/users', [AdminController::class, 'getAllUsers'])->name('admin.users.index');
//     Route::get('/admin/users/{id}', [AdminController::class, 'getSingleUser'])->name('admin.users.single');
//     Route::patch('/admin/users/{id}', [AdminController::class, 'editSingleUser'])->name('admin.users.edit');
//     Route::delete('/admin/users/{id}', [AdminController::class, 'deleteSingleUser'])->name('admin.users.delete');
// });