<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth', 'verified'])->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // shop
    Route::get('/shop/grid', [DashboardController::class, 'shopGrid'])->name('shop-grid');

    // cart
    Route::get('/shop/cart', [DashboardController::class, 'shopCart'])->name('cart');

    // checkout
    Route::get('/checkout', [DashboardController::class, 'checkout'])->name('checkout');

    // contact
    Route::get('/contact', [DashboardController::class, 'contact'])->name('contact');

    //Author CRUD
    Route::get('/author', [AuthorController::class, 'index'])->name('new.author');
    Route::post('/store/author', [AuthorController::class, 'store'])->name('store.author');
    Route::get('/show/author', [AuthorController::class, 'showAuthor'])->name('show.author');
    Route::get('/edit/author/{id}', [AuthorController::class, 'editAuthor'])->name('edit.author');
    Route::post('/update', [AuthorController::class, 'update'])->name('update.author');
    Route::delete('/delete/{id}', [AuthorController::class, 'destroy'])->name('delete.author');

    // Category CRUD
    Route::get('/category', [CategoriesController::class, 'index'])->name('new.category');
    Route::post('/store/category', [CategoriesController::class, 'store'])->name('store.category');
    Route::get('/show/category', [CategoriesController::class, 'showCategory'])->name('show.category');
    Route::get('/edit/category/{id}', [CategoriesController::class, 'edit'])->name('edit.category');
    Route::post('/update', [CategoriesController::class, 'update'])->name('update.category');
    Route::delete('/delete/{id}', [CategoriesController::class, 'destroy'])->name('delete.category');

});

require __DIR__.'/auth.php';
