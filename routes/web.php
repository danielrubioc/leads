<?php
use App\Http\Controllers\v1\LeadController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::prefix('v1')->group(function () {
    Route::post('/leads', [LeadController::class, 'store']); // Ruta para crear un nuevo lead (v1)
    Route::get('/leads/{rut}', [LeadController::class, 'showLeadsByRut']); // Ruta para ver leads de un perfil por RUT (v1)
});


require __DIR__.'/auth.php';
