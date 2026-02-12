<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ListingController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ViewsController;


Auth::routes();





Route::get('/reset', [ViewsController::class, 'resetPassword'])->name('reset.page');
Route::get('/forget', [ViewsController::class, 'forgetPassword'])->name('forget.page');



// Guest only
Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('authVelzon.login'))->name('login');
    Route::get('/register', fn() => view('authVelzon.register'))->name('register');

    Route::get('/', fn() => view('authVelzon.login'));
});

// User
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [ViewsController::class, 'siteDashboard'])->name('site.dashboard');
    Route::get('/table', [ViewsController::class, 'table'])->name('site.velzonTable');
    Route::post('/table/create', [StudentController::class, 'store'])->name('student.create');
    Route::get('/table/index', [StudentController::class, 'index'])->name('student.index');
    Route::get('/listings', [ViewsController::class, 'listingPage'])->name('user.listing');
    Route::get('/listing/create', [ListingController::class, 'store'])->name('user.listing.store');
});

// Admin
// Route::middleware(['auth', 'role:admin'])
//     ->prefix('admin')
//     ->group(function () {
//         Route::get('/dashboard', [ViewsController::class, 'adminDashboard'])->name('admin.dashboard');
//         Route::get('/categories', [ViewsController::class, 'categoryPage'])->name('admin.categories');




//         Route::post('/categories/create', [CategoryController::class, 'store'])->name('admin.category.store');
//         Route::post('/categories/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
//         //for edit form data show
//         Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('admin.category.show');

//         Route::get('/categories/index', [CategoryController::class, 'index'])->name('admin.category.index');
//        Route::post('/category/toggle-status/{category}', [CategoryController::class, 'toggleStatus'])->name('admin.category.toggle-status');
//     });


// Admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', [ViewsController::class, 'adminDashboard'])->name('admin.dashboard');

        // Page + DataTables AJAX
        Route::get('/categories', [CategoryController::class, 'index'])
            ->name('admin.categories');

        // Create
        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('admin.category.store');

        // Show (for edit modal)
        Route::get('/categories/{category}', [CategoryController::class, 'show'])
            ->name('admin.category.show');

        // Update
        Route::put('/categories/{category}', [CategoryController::class, 'update'])
            ->name('admin.category.update');

        // Toggle status
        Route::post('/categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])
            ->name('admin.category.toggle-status');

        // delete row
        Route::delete(
            '/categories/{category}',
            [CategoryController::class, 'destroy']
        )
            ->name('admin.category.destroy');
    });







Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
