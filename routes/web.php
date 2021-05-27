<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\OrderController as AdminOrderController;
use App\Http\Controllers\dashboard\PaymentController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\ServiceController as AdminServiceController;
use App\Http\Controllers\dashboard\ShopController;
use App\Http\Controllers\FileAccessController;
use App\Http\Controllers\user\AddressController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\CheckoutController;
use App\Http\Controllers\user\OrderController;
use App\Http\Controllers\user\PageController;
use App\Http\Controllers\user\ServiceController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/product/search', [PageController::class, 'search'])->name('user.products.search');
Route::get('/product', [PageController::class, 'showAllProduct'])->name('user.products.index');
Route::get('/category/{category}', [PageController::class, 'showProductCategory'])->name('categories.show');
Route::get('product/{product}', [PageController::class, 'product'])->name('products.show');
Route::prefix('service')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/{service}', [ServiceController::class, 'show'])->name('services.show');
});
Route::get('/contact', [PageController::class, 'contact'])->name('contacts.index');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('carts.index');
    Route::post('/cart', [CartController::class, 'store'])->name('carts.store');
    Route::patch('/cart', [CartController::class, 'update'])->name('carts.update');
    Route::get('/cart/{cart}', [CartController::class, 'destroy'])->name('carts.destroy');

    Route::get('/user/address', [AddressController::class, 'index'])->name('profile.address');
    Route::patch('/user/address', [AddressController::class, 'update'])->name('address.update');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkouts.store');

    Route::resource('orders', OrderController::class);
    Route::get('/orders/{order}/success', [OrderController::class, 'success'])->name('orders.success');
    Route::get('/orders/{order}/payment', [OrderController::class, 'payment'])->name('orders.payment');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/orders/{order}/payment', [OrderController::class, 'paymentProcess'])->name('orders.paymentProcess');
    Route::patch('/orders/{order}/received', [OrderController::class, 'received'])->name('orders.received');
});

Route::middleware(['auth:sanctum', 'verified', 'admin'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::prefix('categories')->group(function(){
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::patch('/{category}', [CategoryController::class, 'update'])->name('categories.update');
            Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        });

        Route::prefix('orders')->group(function(){
            Route::get('/', [AdminOrderController::class, 'all'])->name('admin.orders.index');
            Route::get('/new', [AdminOrderController::class, 'newList'])->name('admin.orders.newlist');
            Route::get('/process', [AdminOrderController::class, 'processList'])->name('admin.orders.processlist');
            Route::get('/delivered', [AdminOrderController::class, 'deliveredList'])->name('admin.orders.deliveredlist');
            Route::get('/done', [AdminOrderController::class, 'doneList'])->name('admin.orders.donelist');
            Route::get('/cancel', [AdminOrderController::class, 'cancelList'])->name('admin.orders.cancellist');
            Route::get('/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
            Route::patch('/{order}/cancel', [AdminOrderController::class, 'cancel'])->name('admin.orders.cancel');
            Route::patch('/{order}/confirm', [AdminOrderController::class, 'confirm'])->name('admin.orders.confirm');
            Route::patch('/{order}/delivered', [AdminOrderController::class, 'delivered'])->name('admin.orders.delivered');
            Route::patch('/{order}/done', [AdminOrderController::class, 'done'])->name('admin.orders.done');
        });

        Route::prefix('products')->group(function(){
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::post('/', [ProductController::class, 'store'])->name('products.store');
            Route::get('/create', [ProductController::class, 'create'])->name('products.create');
            Route::patch('/{product}', [ProductController::class, 'update'])->name('products.update');
            Route::get('{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        });

        Route::prefix('services')->group(function () {
            Route::get('/', [AdminServiceController::class, 'index'])->name('admin.services.index');
            Route::get('/{service}', [AdminServiceController::class, 'show'])->name('admin.services.show');
            Route::patch('/{service}', [AdminServiceController::class, 'update'])->name('admin.services.update');
        });

        Route::prefix('shop')->group(function(){
            Route::get('/', [ShopController::class, 'index'])->name('shops.index');
            Route::patch('/', [ShopController::class, 'update'])->name('shops.update');
        });

        Route::resource('payments', PaymentController::class);
    });

    Route::get('/file/serve/payment/{file}', [FileAccessController::class, 'serve'])->name('images.payment');
});

Route::prefix('email')->group(function () {
    Route::get('/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('dashboard')->with('message', 'Verification successfull!');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) use ($request) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status == Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
