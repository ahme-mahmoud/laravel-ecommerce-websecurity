<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Dashboard (Jetstream)
|--------------------------------------------------------------------------
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'Home'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Redirect User After Login
|--------------------------------------------------------------------------
*/
Route::get('/redirect-user', function () {
    if (!Auth::check()) return redirect('/login');

    return Auth::user()->usertype == 1
        ? redirect('/admin/dashboard')
        : redirect('/');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/dashboard', [AdminController::class, 'Dashboard'])
    ->middleware('auth')
    ->name('admin.dashboard');

Route::get('/view_category', [AdminController::class, 'ViewCategory'])->name('admin.category');
Route::post('/add_category', [AdminController::class, 'AddCategory'])->name('admin.add_category');
Route::get('/delete_category/{id}', [AdminController::class, 'DeleteCategory']);

Route::get('/view_product', [AdminController::class, 'ViewProduct'])->name('admin.view_product');
Route::post('/add_product', [AdminController::class, 'AddProduct'])->name('admin.add_product');

Route::get('/show_product', [AdminController::class, 'ShowProduct'])->name('admin.show_product');
Route::get('/delete_product/{id}', [AdminController::class, 'DeleteProduct']);
Route::get('/edit_product/{id}', [AdminController::class, 'EditProduct']);
Route::post('/update_product/{id}', [AdminController::class, 'UpdateProduct']);

Route::get('/admin/user-orders', [AdminController::class, 'UserOrders'])
    ->middleware('auth')
    ->name('admin.user_orders');

/*
|--------------------------------------------------------------------------
| Google OAuth
|--------------------------------------------------------------------------
*/
Route::get('/auth/google', function () {
    return Socialite::driver('google')->stateless()->redirect();
})->name('google.redirect');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::updateOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name' => $googleUser->getName(),
            'email_verified_at' => now(),
            'password' => bcrypt(uniqid()),
        ]
    );

    Auth::login($user, true);
    return redirect('/');
})->name('google.callback');

/*
|--------------------------------------------------------------------------
| User Routes (الواجهة)
|--------------------------------------------------------------------------
*/
Route::get('/shop', [HomeController::class, 'ShopPage'])->name('user.shop');
Route::get('/contact', [HomeController::class, 'ContactPage'])->name('user.contact');

Route::get('/my-account', [HomeController::class, 'UserAccount'])
    ->middleware('auth')
    ->name('user.account');

Route::get('/user/logout', [HomeController::class, 'UserLogout'])
    ->middleware('auth')
    ->name('user.logout');

Route::get('/my-cart', [HomeController::class, 'CartPage'])
    ->middleware('auth')
    ->name('user.cart');

Route::post('/add-to-cart/{id}', [HomeController::class, 'AddToCart'])
    ->middleware('auth');

Route::get('/orders', [HomeController::class, 'UserOrders'])
    ->middleware('auth')
    ->name('user.orders');


    Route::get('/checkout', function () {
    return view('user.checkout');
})->middleware('auth')->name('user.checkout');

/*
|--------------------------------------------------------------------------
| Product Details
|--------------------------------------------------------------------------
*/
Route::get('/product_details/{id}', [HomeController::class, 'ProductDetails'])
    ->name('product.details');

/*
|--------------------------------------------------------------------------
| 🔐 Security Utility - File Encrypt / Decrypt (OpenSSL)
|--------------------------------------------------------------------------
| Admin / Auth Only
*/
Route::get('/security/file-crypto', function () {
    return view('admin.file_crypto');
})->middleware('auth')->name('security.file_crypto');

Route::post('/security/file-encrypt', function (Request $request) {

    $request->validate([
        'file' => 'required|file',
        'password' => 'required'
    ]);

    $data = file_get_contents($request->file('file')->getRealPath());

    $key = hash('sha256', $request->password, true);
    $iv  = substr($key, 0, 16);

    $encrypted = openssl_encrypt(
        $data,
        'aes-256-cbc',
        $key,
        OPENSSL_RAW_DATA,
        $iv
    );

    return response($encrypted)
        ->header('Content-Type', 'application/octet-stream')
        ->header('Content-Disposition', 'attachment; filename="encrypted.enc"');

})->middleware('auth')->name('security.file_encrypt');

Route::post('/security/file-decrypt', function (Request $request) {

    $request->validate([
        'file' => 'required|file',
        'password' => 'required'
    ]);

    $data = file_get_contents($request->file('file')->getRealPath());

    $key = hash('sha256', $request->password, true);
    $iv  = substr($key, 0, 16);

    $decrypted = openssl_decrypt(
        $data,
        'aes-256-cbc',
        $key,
        OPENSSL_RAW_DATA,
        $iv
    );

    return response($decrypted)
        ->header('Content-Type', 'application/octet-stream')
        ->header('Content-Disposition', 'attachment; filename="decrypted.txt"');

})->middleware('auth')->name('security.file_decrypt');



