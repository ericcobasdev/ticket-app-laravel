<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsTechnician;

// Página de bienvenida (pública)
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

// Dashboard general para usuarios autenticados
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

// Grupo de rutas protegidas por auth
Route::middleware('auth')->group(function () {

    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas comunes de tickets (todos los roles)
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    Route::put('/tickets/{ticket}/close', [TicketController::class, 'close'])->name('tickets.close');

    // Rutas solo para ADMIN
    Route::middleware([IsAdmin::class])->group(function () {
        Route::put('/tickets/{ticket}/assign', [TicketController::class, 'assign'])->name('tickets.assign');
        Route::get('/admin/dashboard', [TicketController::class, 'dashboard'])->name('admin.dashboard');
    });

    // Rutas solo para TÉCNICO
    Route::middleware([IsTechnician::class])->group(function () {
        Route::get('/tecnico/tickets', [TicketController::class, 'tecnicoTickets'])->name('tecnico.tickets');
        Route::put('/tickets/{ticket}/resolve', [TicketController::class, 'resolve'])->name('tickets.resolve');
    });

    


});

require __DIR__.'/auth.php';

