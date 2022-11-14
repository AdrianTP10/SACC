<?php

use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



/* Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

Route::redirect('/', '/login');

/* Route::get('/', function () {
     return redirect('/login');
});  */


Route::resource('personal', PersonalController::class)
->only(['index','store','update','create','edit','destroy'])
->middleware(['auth']);


Route::resource('actividad', ActividadController::class)
->only(['index','store','update','create','edit','destroy'])
->middleware(['auth']);

Route::resource('alumno', AlumnoController::class)
->only(['index','store','update','create','edit','destroy'])
->middleware(['auth']);

Route::resource('solicitud', SolicitudController::class)
->only(['index','store','update','create','edit','destroy'])
->middleware(['auth']);


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
