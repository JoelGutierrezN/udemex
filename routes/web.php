<?php

use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\Teachers\AdminHistorialController;
use App\Http\Controllers\Admin\Teachers\AdminInformacionAcademicaController;
use App\Http\Controllers\Admin\Teachers\AdminMateriasController;
use App\Http\Controllers\Admin\Teachers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TemporalAuthController;
use App\Http\Controllers\ExperienciaInicioController;
use App\Http\Controllers\InformacionAcademicaController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ImportarDocenteController;
use App\Http\Controllers\Personal\ArchivosController;
use App\Http\Controllers\Personal\HistorialController;
use App\Http\Controllers\Personal\MateriasController;
use App\Http\Controllers\ProfesoresInicioController;
use App\Http\Controllers\UsuarioController;
use \App\Http\Controllers\Admin\Teachers\AdminArchivosController;
use App\Http\Controllers\Graficas\GraficasController;


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
Route::middleware(['auth'])->prefix('administradores')->name('admin.')->group( function(){
    Route::get('/graficas', [GraficasController::class, 'example'])->name('example-graficas');
    Route::get('/getDataHistorial', [GraficasController::class, 'getDataHistorial'])->name('getDataHistorial');
});
/* Rutas Administrativas */
Route::middleware(['auth', 'admin'])->prefix('administradores')->name('admin.')->group( function(){
    Route::get('bienvenida', AdminIndexController::class)->name('welcome');
    Route::get('experienciaLaboral/{id}', [AdminInformacionAcademicaController::class, 'index'])->name('teachers.experienciaLaboral');
    Route::get('usu/{uuid}/download', [TeacherController::class, 'download'])->name('teachers.usu.download');
    Route::resource('profesores', TeacherController::class)->except('show')->names('teachers')->parameters(['profesores' => 'usuario']);
    Route::resource('docentesimport', ImportarDocenteController::class)->except('show')->names('teachersimport');
    Route::get('infoacademic/{uuid}/downloadinfo', [UsuarioController::class, 'downloadinfo'])->name('infoacademic.downloadinfo');
    Route::resource('infoacademica', AdminInformacionAcademicaController::class)->parameters(["infoacademica"=>"infoAcademica"])->except('index');

    // * Rutas para las capacitaciones
    Route::post('/updateFiles', [AdminArchivosController::class, 'update'])->name('teachers.updateFiles');
    Route::get('/getCapacitaciones/{id}', [AdminArchivosController::class, 'getCapacitaciones'])->name('teachers.getCapacitaciones');
    Route::get('/delete-capacitacion/{id}', [AdminArchivosController::class, 'deleteCapacitacion'])->name('teachers.deleteCapacitacion');
    Route::get('/capacitacion/ultimaActualizacion', [AdminArchivosController::class, 'ultimaActualizacion'])->name('teachers.lastCapacitacion');

    // * Rutas para las materias
    Route::post('/storeMaterias', [AdminMateriasController::class, 'store'])->name('teachers.storeMaterias');
    Route::get('/getMaterias/{id}', [AdminMateriasController::class, 'getMaterias'])->name('teachers.getMaterias');
    Route::get('/delete-materia/{id}', [AdminMateriasController::class, 'deleteMateria'])->name('teachers.deleteMateria');
    Route::get('/asignaturas/ultimaActualizacion', [AdminMateriasController::class, 'ultimaActualizacion'])->name('teachers.lastAsignatura');

    // * Rutas para el historial
    Route::post('/storeHistorial', [AdminHistorialController::class, 'store'])->name('teachers.storeHistorial');
    Route::get('/getHistorial/{id}', [AdminHistorialController::class, 'getHistorial'])->name('teachers.getHistorial');
    Route::get('/delete-historial/{id}', [AdminHistorialController::class, 'deleteHistorial'])->name('teachers.deleteHistorial');
    Route::get('/historial/ultimaActualizacion', [AdminHistorialController::class, 'ultimaActualizacion'])->name('teachers.lastHistorial');
});

/* Rutas de Profesores */
Route::middleware(['auth', 'teacher'])->prefix('profesores')->name('teacher.')->group( function(){
    Route::get('/', ProfesoresInicioController::class)->name('index');
    Route::view('welcome', 'teacher-modules.welcome')->name('welcome');
    Route::get('experienciaLaboral', ExperienciaInicioController::class)->name('experienciaLaboral');
    Route::resource('usuarios', UsuarioController::class);
    Route::get('usu/{uuid}/download', [UsuarioController::class, 'download'])->name('usu.download');
    Route::get('infoacademic/{uuid}/downloadinfo', [UsuarioController::class, 'downloadinfo'])->name('infoacademic.downloadinfo');
    Route::resource('infoacademica', InformacionAcademicaController::class)->parameters(["infoacademica"=>"infoAcademica"]);


    // * Rutas para las capacitaciones
    Route::post('/updateFiles', [ArchivosController::class, 'update'])->name('updateFiles');
    Route::get('/getCapacitaciones/{id}', [ArchivosController::class, 'getCapacitaciones'])->name('getCapacitaciones');
    Route::get('/delete-capacitacion/{id}', [ArchivosController::class, 'deleteCapacitacion'])->name('deleteCapacitacion');
    Route::get('/capacitacion/ultimaActualizacion', [ArchivosController::class, 'ultimaActualizacion'])->name('lastCapacitacion');

    // * Rutas para las materias
    Route::post('/storeMaterias', [MateriasController::class, 'store'])->name('storeMaterias');
    Route::get('/getMaterias/{id}', [MateriasController::class, 'getMaterias'])->name('getMaterias');
    Route::get('/delete-materia/{id}', [MateriasController::class, 'deleteMateria'])->name('deleteMateria');
    Route::get('/asignaturas/ultimaActualizacion', [MateriasController::class, 'ultimaActualizacion'])->name('lastAsignatura');

    // * Rutas para el historial
    Route::post('/storeHistorial', [HistorialController::class, 'store'])->name('storeHistorial');
    Route::get('/getHistorial/{id}', [HistorialController::class, 'getHistorial'])->name('getHistorial');
    Route::get('/delete-historial/{id}', [HistorialController::class, 'deleteHistorial'])->name('deleteHistorial');
    Route::get('/historial/ultimaActualizacion', [HistorialController::class, 'ultimaActualizacion'])->name('lastHistorial');

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
