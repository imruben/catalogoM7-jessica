<?php

use App\Http\Controllers\BagController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard',['name' => 'Hermos@']);
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth:sanctum'])->group(function(){
    // Bag products
    Route::controller(BagController::class)->group(function(){
        Route::get('/bags','index');
        Route::post('/bags','addProduct');
        Route::get('/record','record');
        Route::post('/delete','deleteRecord');
    });
    // Carrito compra
    Route::controller(CartController::class)->group(function(){
        Route::get('/cart','index');
        Route::post('/cart','buyAllBags');
        Route::delete('/cart/{id}','delete')->name('cart.delete');
    });

    // Dashboard para gestión de catalog y user 
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/dashboard','index');
        Route::post('/dashboard','create');
        Route::post('/dashboard/{id}/edit','update');
        Route::post('/dashboard/{id}','destroy');

    });
    
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
