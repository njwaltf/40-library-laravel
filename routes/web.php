<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DontHaveAccess;
use App\Http\Controllers\LibrarianDashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

// guest route
Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'auth']);
});

Route::get('/home', function () {
    return redirect('/');
});

// error route
Route::get('/you-dont-have-access', [DontHaveAccess::class, 'index'])->name('you-dont-have-access');

Route::resource('/bookings-management', BookingController::class);

// auth route
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // admin route
    // Route::get('/dashboard-admin', [AdminDashboardController::class, 'index'])->middleware('userAccess:admin');
    // user model
    Route::get('/users-management', [UserController::class, 'index'])->middleware('userAccess:admin')->name('users-management');
    Route::get('/users-management/{id}', [UserController::class, 'show'])->middleware('userAccess:admin');
    Route::get('/users-management-create', [UserController::class, 'create'])->middleware('userAccess:admin');
    Route::post('/users-management-create', [UserController::class, 'store'])->middleware('userAccess:admin');
    Route::get('/users-management/{id}/edit', [UserController::class, 'edit'])->middleware('userAccess:admin');
    Route::post('/users-management-delete/{id}', [UserController::class, 'destroy'])->middleware('userAccess:admin');
    Route::post('/users-management-edit', [UserController::class, 'update'])->middleware('userAccess:admin');
    // book model
    Route::resource('/books-management', BookController::class)->middleware('userAccess:admin');
    Route::resource('/categories-management', CategoryController::class)->middleware('userAccess:admin');
    Route::resource('/bookings-management', BookingController::class)->middleware(['userAccess:librarian', 'userAccess:admin']);
    // Route::resource('/bookings-management', BookingController::class)->middleware(['userAccess:admin', 'userAccess:librarian']);
    // export
    Route::get('/pdf/export-booking/', [BookingController::class, 'exportBookingPDF']);
    Route::get('/qr/export-booking/{id}', [BookingController::class, 'exportPDF']);
    Route::get('/export/invoice/{id}', [BookingController::class, 'generateInvoice']);



    // member route
    Route::get('/dashboard-member', [DashboardController::class, 'index'])->middleware('userAccess:member');

    // librarian route
    Route::get('/dashboard-librarian', [LibrarianDashboardController::class, 'index'])->middleware('userAccess:librarian');
});
