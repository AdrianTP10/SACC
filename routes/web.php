<?php

use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\PeriodoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasPermissions;


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
->only(['index','store','update','create','edit','destroy','show'])
->middleware(['auth']);

Route::get('/nuevas-solicitudes', [SolicitudController::class,'indexDepartamento'])->name('departamento.solicitudes')
->middleware(['auth']);

Route::get('/mis-solicitudes', [SolicitudController::class,'indexAlumno'])->name('alumno.solicitudes')
->middleware(['auth']);

Route::get('/mis-creditos', [SolicitudController::class,'misCreditos'])->name('alumno.creditos')
->middleware(['auth']);

/* Route::get('/mis-creditos', [SolicitudController::class,'misCreditos'])->name('misSolicitudes')
->middleware(['auth']); */

Route::resource('periodo', PeriodoController::class)
->only(['index','store','update','create','edit','destroy'])
->middleware(['auth']);

Route::resource('departamento', DepartamentoController::class)
->only(['index','store','update','create','edit','destroy'])
->middleware(['auth']);

Route::resource('usuario', UsuarioController::class)
->only(['index','store','update','create','edit','destroy'])
->middleware(['auth']);


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard',[
        'hasRole' =>[
            'admin' => Auth::user()->hasRole('admin'),
            'departamento' => Auth::user()->hasRole('departamento'),
            'alumno' => Auth::user()->hasRole('alumno'),
        ],
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
