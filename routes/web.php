<?php

use App\Enums\EventStatus;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $featuredEvents = Event::query()
        ->where('status', EventStatus::Published)
        ->where('starts_at', '>=', now())
        ->withCount('tickets')
        ->orderByDesc('is_featured')
        ->orderBy('starts_at')
        ->take(6)
        ->get();

    return view('welcome', compact('featuredEvents'));
});

Route::middleware(['auth', 'verified', 'role:organisateur'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('events', EventController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return redirect(auth()->user()->homeUrl());
    })->name('home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
