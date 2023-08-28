<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;

Route::middleware('AuthUser')->group(function () {
    Route::get('/logout', function () {
        Session::forget('user');
        return redirect('/');
    });
});

Route::get('/admin-logout', function () {
    Session::forget('admin');
    return redirect('/admin');
});


Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('pay');
Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback']);


Route::get('/', [ProductController::class, 'index']);
Route::get('/search', [ProductController::class, 'searchProducts']);
Route::post('/removecart', [ProductController::class, 'remove'])->name('remove.cart');
Route::post('/ordernow', [ProductController::class, 'orderNow']);
Route::get('/cartlist', [ProductController::class, 'cartList']);
Route::get('/checkout', [ProductController::class, 'checkout']);
Route::get('/product/{id}', [ProductController::class, 'product']);
Route::get('/manage-products', [ProductController::class, 'allProducts']);
Route::post('/addtocart', [ProductController::class, 'addToCart'])->name('add.cart');
Route::get('/header', [ProductController::class, 'header']);
Route::get('/cart/count', [ProductController::class, 'cartNum']);

Route::view('/register', 'register');
Route::view('login', 'login');
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin', [AdminController::class, 'login']);
Route::get('/dashboard', [AdminController::class, 'adminDetails']);
Route::get('/dashboard', [ProductController::class, 'recentOrder']);
Route::post('/profile-picture', [AdminController::class, 'profilePicture']);
Route::post('/add-category', [ProductController::class, 'addCategory'])->name('add.category');
Route::get('/manage-categories', [ProductController::class, 'showCategories']);
Route::post('/add-product', [ProductController::class, 'addProduct']);
Route::post('/delete-cat', [ProductController::class, 'deleteCategory'])->name('delete.cat');
Route::post('/delete-prd', [ProductController::class, 'deleteProduct'])->name('delete.prd');
Route::get('/edit-product/{id}', [ProductController::class, 'showProduct']);
Route::post('/update-product', [ProductController::class, 'updateProduct']);
Route::get('/customers-orders', [ProductController::class, 'showOrders']);
Route::post('/update_order', [ProductController::class, 'updateOrder'])->name('order.update');
