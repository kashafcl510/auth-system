<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ViewsController;

Auth::routes();





Route::get('/reset', [ViewsController::class, 'resetPassword'])->name('reset.page');
Route::get('/forget', [ViewsController::class, 'forgetPassword'])->name('forget.page');



// Guest only
Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('authVelzon.login'))->name('login');
    Route::get('/register', fn () => view('authVelzon.register'))->name('register');

Route::get('/', fn () => view('authVelzon.login'));
});
// User
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [ViewsController::class, 'siteDashboard'])->name('site.dashboard');
    Route::get('/table', [ViewsController::class, 'table'])->name('site.velzonTable');
    Route::post('/table/create', [StudentController::class, 'store'])->name('student.create');
    Route::get('/table/index', [StudentController::class, 'index'])->name('student.index');
    Route::get('/listings', [ViewsController::class, 'listingPage'])->name('user.listing');
});

// Admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', [ViewsController::class, 'adminDashboard'])
            ->name('admin.dashboard');
    });









Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');






