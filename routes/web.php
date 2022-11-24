<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TemporalAuthController;
use App\Http\Controllers\Personal\ArchivosController;
use App\Http\Controllers\Personal\MateriasController;
use App\Http\Controllers\Personal\HistorialController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProfesoresInicioController;
use App\Http\Controllers\InformacionAcademicaController;

Route::redirect('/', 'auth/login/temporal')->middleware('guest');
/* Auth 365 */
Route::group(['middleware' => ['web', 'guest'], 'namespace' => 'App\Http\Controllers\Auth'], function(){
    Route::get('login', 'AuthController@login')->name('login');
    Route::get('connect', 'AuthController@connect')->name('connect');
});

Route::group(['middleware' => ['web', 'MsGraphAuthenticated'], 'prefix' => 'app', 'namespace' => 'App\Http\Controllers'], function(){
    // Route::get('/', 'PagesController@app')->name('app');
    Route::get('logout', 'Auth\AuthController@logout')->name('logout');
});

/* Auth Normal Temporal*/
Route::prefix('auth')->group(function (){
    Route::get('login/temporal', [TemporalAuthController::class, 'login'])->name('login.temporal');
    Route::post('authenticate/temporal', [TemporalAuthController::class, 'authenticate'])->name('authenticate.temporal');
    Route::post('logout/temporal', [TemporalAuthController::class, 'logout'])->name('logout.temporal');
});

/* Rutas Administrativas */
Route::middleware(['auth', 'admin'])->prefix('administradores')->name('admin.')->group( function(){
    Route::view('/', 'admin-modules.index')->name('index');
});

/* Rutas de Profesores */
Route::middleware(['auth', 'teacher'])->prefix('profesores')->name('teacher.')->group( function(){
    Route::view('/', 'teacher-modules.index')->name('index');
    Route::get('/welcome', ProfesoresInicioController::class)->name('welcome');
    Route::resource('usuarios', UsuarioController::class);
     Route::get('usu/{uuid}/download', [UsuarioController::class, 'download'])->name('usu.download');
    Route::resource('infoacademica', InformacionAcademicaController::class);


    // * Rutas para las capacitaciones
    Route::post('/updateFiles', [ArchivosController::class, 'update'])->name('updateFiles');
    Route::get('/getCapacitaciones/{id}', [ArchivosController::class, 'getCapacitaciones'])->name('getCapacitaciones');
    Route::get('/delete-capacitacion/{id}', [ArchivosController::class, 'deleteCapacitacion'])->name('deleteCapacitacion');

    // * Rutas para las materias
    Route::post('/storeMaterias', [MateriasController::class, 'store'])->name('storeMaterias');
    Route::get('/getMaterias/{id}', [MateriasController::class, 'getMaterias'])->name('getMaterias');
    Route::get('/delete-materia/{id}', [MateriasController::class, 'deleteMateria'])->name('deleteMateria');

    // * Rutas para el historial
    Route::post('/storeHistorial', [HistorialController::class, 'store'])->name('storeHistorial');
    Route::get('/getHistorial/{id}', [HistorialController::class, 'getHistorial'])->name('getHistorial');
    Route::get('/delete-historial/{id}', [HistorialController::class, 'deleteHistorial'])->name('deleteHistorial');

    // * Rutas para generar los PDF
    Route::get('/pdf', [PDFController::class, 'pdfExport'])->name('pdfExport');
    Route::get('/test_pdf', function(){
        return view('pdf/index');
    });
});

/* Rutas Rutas de Soporte */
Route::middleware(['auth', 'support'])->prefix('soporte')->name('support.')->group( function(){
    Route::view('/', 'support-modules.index')->name('index');
});

