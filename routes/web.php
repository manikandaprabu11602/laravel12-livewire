<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Livewire\ProductCrud;
use App\Livewire\StudentCrud;
use App\Http\Controllers\StripeController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public shop page
Route::get('/shop', function () {
    $products = App\Models\Product::all();
    return view('shop.index', compact('products'));
})->name('shop');

Route::get('/item', function () {
    $products = App\Models\Product::all();
    return view('items.index', compact('products'));
})->name('item');

Route::post('/stripe/checkout', [StripeController::class, 'checkout'])->name('stripe.checkout');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('/products', function() { return view('products.index'); })->name('products.index');
    Route::get('/products/create', function () { return view('products.create'); })->name('products.create');
    Route::get('/products/{id}/edit', function ($id) { return view('products.edit', ['id' => $id]); })->name('products.edit');

    Route::get('/students', StudentCrud::class)->name('students');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
