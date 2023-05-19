<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ProductsController;
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

Route::get('/', [DashboardController::class, 'home']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'
])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', [AdminController::class, 'index'
])->middleware(['auth', 'verified'])->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // shop
    Route::get('/shop/grid', [DashboardController::class, 'shopGrid'])->name('shop-grid');

    // checkout
    Route::get('/checkout', [DashboardController::class, 'checkout'])->name('checkout');

    // contact
    Route::get('/contact', [DashboardController::class, 'contact'])->name('contact');

    // Start for admin
    //Author CRUD
    Route::get('/author', [AuthorController::class, 'index'])->name('new.author');
    Route::post('/store/author', [AuthorController::class, 'store'])->name('store.author');
    Route::get('/show/author', [AuthorController::class, 'showAuthor'])->name('show.author');
    Route::get('/edit/author/{id}', [AuthorController::class, 'editAuthor'])->name('edit.author');
    Route::post('/update/author', [AuthorController::class, 'update'])->name('update.author');
    Route::delete('/delete/{id}', [AuthorController::class, 'destroy'])->name('delete.author');

    // Category CRUD
    Route::get('/category', [CategoriesController::class, 'index'])->name('new.category');
    Route::post('/store/category', [CategoriesController::class, 'store'])->name('store.category');
    Route::get('/show/category', [CategoriesController::class, 'showCategory'])->name('show.category');
    Route::get('/edit/category/{id}', [CategoriesController::class, 'edit'])->name('edit.category');
    Route::post('/update/category', [CategoriesController::class, 'update'])->name('update.category');
    Route::delete('/cat/delete/{id}', [CategoriesController::class, 'destroy'])->name('delete.category');

    // Book CRUD
    Route::get('/book', [BooksController::class, 'index'])->name('book');
    Route::post('/store/book', [BooksController::class, 'store'])->name('store.book');
    Route::get('/show/book', [BooksController::class, 'showBook'])->name('show.book');
    Route::get('/edit/book/{id}', [BooksController::class, 'edit'])->name('edit.book');
    Route::post('/update/book', [BooksController::class, 'update'])->name('update.book');
    Route::delete('/book/delete/{id}', [BooksController::class, 'destroy'])->name('delete.book');

    //Discount CRUD
    Route::get('/discount', [DiscountController::class, 'index'])->name('discount');
    Route::post('/store/discount', [DiscountController::class, 'store'])->name('store.discount');
    Route::get('/show/discount', [DiscountController::class, 'showDiscount'])->name('show.discount');
    Route::get('/edit/discount/{id}', [DiscountController::class, 'edit'])->name('edit.discount');
    Route::post('/update/discount', [DiscountController::class, 'update'])->name('update.discount');
    Route::delete('/discount/delete/{id}', [DiscountController::class, 'destroy'])->name('delete.discount');
    // End for admin
    
    // heart
    Route::get('/heart/{id}', [FavoriteController::class, 'heartSave'])->name('heart');
    Route::get('/favourites', [FavoriteController::class, 'heartShow'])->name('show.favourite');
    Route::delete('/favourite/delete/{id}', [FavoriteController::class, 'delete'])->name('delete.favourite');

    //cart
    Route::get('/cart/store/{id}', [CartController::class, 'cartSave'])->name('cart.store');
    Route::get('/carts', [CartController::class, 'cartShow'])->name('show.cart');
    Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('delete.cart');

    //buy
    Route::post('/process/checkout', [CartController::class, 'processCheckout'])->name('process.checkout');
    Route::post('/place/order', [CheckoutController::class, 'placeOrder'])->name('place.order');

    //product_details
    Route::get('/product/details/{id}', [CheckoutController::class,'productDetails'])->name('product.details');
    Route::get('/ordered', [CheckoutController::class,'orderList'])->name('ordered');

    //show_products
    Route::get('/category/wise/{id}',[CategoriesController::class, 'show'])->name('category.wise');

    // book_search
    Route::post('/search',[BooksController::class, 'search'])->name('search');

    //lists
    Route::get('/pending',[ProductsController::class, 'pending'])->name('pending.list');
    Route::get('/accept-pending/{id}',[ProductsController::class, 'acceptPending'])->name('accept.pending');
    Route::get('/reject-pending/{id}',[ProductsController::class, 'rejectPending'])->name('reject.pending');
    Route::get('/delivery',[ProductsController::class, 'delivery'])->name('delivery.list');
    Route::get('/accept-delivery/{id}',[ProductsController::class, 'acceptDelivery'])->name('accept.delivery');
    Route::get('/reject-delivery/{id}',[ProductsController::class, 'rejectDelivery'])->name('reject.delivery');
    Route::get('/total',[ProductsController::class, 'total'])->name('total.list');

    //newsletter
    Route::post('/newsletter',[NoticeController::class, 'store'])->name('newsletter');
});

require __DIR__.'/auth.php';
