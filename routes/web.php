<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ViewsController;

Auth::routes();


Route::get('/login', fn () => view('authVelzon.login'))->name('login');
Route::get('/register', fn () => view('authVelzon.register'))->name('register');
Route::get('/', fn () => view('authVelzon.login'));

Route::get('/reset', [ViewsController::class, 'resetPassword'])->name('reset.page');
Route::get('/forget', [ViewsController::class, 'forgetPassword'])->name('forget.page');


//user routes
Route::middleware(['auth', 'role:user'])->group(function(){
Route::get('/dashboard' , [ViewsController::class, 'siteDashboard'])->name('site.dashboard');
});




// admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function(){

Route::get('/dashboard' , [ViewsController::class, 'adminDashboard'])->name('admin.dashboard');
});






Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




