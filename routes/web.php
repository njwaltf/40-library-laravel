<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DontHaveAccess;
use App\Http\Controllers\LibrarianDashboardController;
use App\Http\Controllers\LoginController;
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
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'auth']);
});
Route::get('/home', function () {
    return redirect('/dashboard-admin');
});
Route::get('/you-dont-have-access', [DontHaveAccess::class, 'index'])->name('you-dont-have-access');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard-admin', [AdminDashboardController::class, 'index'])->middleware('userAccess:admin');
    Route::get('/dashboard-member', [DashboardController::class, 'index'])->middleware('userAccess:member');
    Route::get('/dashboard-librarian', [LibrarianDashboardController::class, 'index'])->middleware('userAccess:librarian');
});
