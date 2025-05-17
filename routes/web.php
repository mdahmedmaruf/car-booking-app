<?php
//
//use App\Http\Controllers\DashboardController;
//use App\Http\Controllers\ProfileController;
//use Illuminate\Support\Facades\Route;
//
//use App\Http\Controllers\Admin\CarController as AdminCarController;
//use App\Http\Controllers\Admin\RentalController as AdminRentalController;
//use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
//
//use App\Http\Controllers\Frontend\PageController;
//use App\Http\Controllers\Frontend\CarController as FrontCar;
//use App\Http\Controllers\Frontend\RentalController as FrontRental;
//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//
//
//Route::middleware(['auth', 'admin'])
//    ->prefix('admin')
//    ->name('admin.')
//    ->group(function () {
//        // Car CRUD
//        Route::resource('cars', AdminCarController::class);
//        // Rental management
//        Route::resource('rentals', AdminRentalController::class);
//        // Customer management
//        Route::resource('customers', AdminCustomerController::class);
//
//        // Dashboard overview route, if you have one:
//        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//    });
//
//
//
//// Public pages
//Route::get('/',            [PageController::class,'home'])->name('home');
//Route::get('/about',       [PageController::class,'about'])->name('about');
//Route::get('/contact',     [PageController::class,'contact'])->name('contact');
//
//// Car browsing (available to guests or you can protect with auth)
//Route::get('/cars',        [FrontCar::class,'index'])->name('cars.index');
//Route::get('/cars/{car}',  [FrontCar::class,'show'])->name('cars.show');
//
//// Booking & history (customers only)
//Route::middleware(['auth','customer'])->group(function () {
//    Route::post('/rentals',        [FrontRental::class,'store'])->name('rentals.store');
//    Route::get('/my-bookings',     [FrontRental::class,'index'])->name('rentals.index');
//    Route::delete('/rentals/{rental}', [FrontRental::class,'destroy'])->name('rentals.destroy');
//});
//
//
//
////Route::get('/dashboard', function () {
////    return view('dashboard');
////})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});
//
//require __DIR__.'/auth.php';


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\CarController as FrontCar;
use App\Http\Controllers\Frontend\RentalController as FrontRental;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home, About, Contact
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Browse Cars
Route::get('/cars', [FrontCar::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [FrontCar::class, 'show'])->name('cars.show');

/*
|--------------------------------------------------------------------------
| Authenticated Dashboard
|--------------------------------------------------------------------------
|
| Both admins and customers use this /dashboard route.
|
*/
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Customer-Only Booking Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'customer'])->group(function () {
    Route::post('/rentals', [FrontRental::class, 'store'])->name('rentals.store');
    Route::get('/my-bookings', [FrontRental::class, 'index'])->name('rentals.index');
    Route::delete('/rentals/{rental}', [FrontRental::class, 'destroy'])->name('rentals.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Optional: admin can also use /admin/dashboard if desired
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('cars', AdminCarController::class);
        Route::resource('rentals', AdminRentalController::class);
        Route::resource('customers', AdminCustomerController::class);
    });

/*
|--------------------------------------------------------------------------
| Profile & Auth
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
