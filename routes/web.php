<?php

use App\Jobs\GenerateCsvFiles;
use App\Jobs\GenerateStaticGtfs;
use App\Jobs\ProcessStopFile;
use App\Jobs\ProcessTripUpdate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::view('/', 'welcome')->name('home');

Route::get('/stops', function () {
    return view('stops');
})->name('stops');

Route::get('/download', function () {
    return view('download')->with('files', Storage::files('public/latest'));
})->name('download');

Route::layout('layouts.auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::livewire('login', 'auth.login')
            ->name('login');

        Route::livewire('register', 'auth.register')
            ->name('register');
    });

    Route::livewire('password/reset', 'auth.passwords.email')
        ->name('password.request');

    Route::livewire('password/reset/{token}', 'auth.passwords.reset')
        ->name('password.reset');

    Route::middleware('auth')->group(function () {
        Route::livewire('email/verify', 'auth.verify')
            ->middleware('throttle:6,1')
            ->name('verification.notice');

        Route::livewire('password/confirm', 'auth.passwords.confirm')
            ->name('password.confirm');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', 'Auth\EmailVerificationController')
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', 'Auth\LogoutController')
        ->name('logout');
});

Route::get('/dispatch', function () {
    if (app()->environment('local')) {
        dispatch(new ProcessTripUpdate());
    }

    return redirect('/');
});

Route::get('/generate', function () {
    if (app()->environment('local')) {
        dispatch(new GenerateStaticGtfs());
        dispatch(new ProcessStopFile(env('STOP_FILE_URL')));
        dispatch(new GenerateCsvFiles());
    }

    return redirect('/');
});
