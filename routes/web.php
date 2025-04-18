<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('members', 'members.members')->name('members');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('programs', 'programs.programs')->name('programs');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('subscriptions', 'subscriptions.subscriptions')->name('subscriptions');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('transactions', 'transactions.transactions')->name('transactions');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('attendance', 'attendances.attendances')->name('attendance');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
