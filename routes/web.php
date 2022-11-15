<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TemporalAuthController;
use App\Http\Controllers\Personal\ArchivosController;
use App\Http\Controllers\PDFController;

Route::redirect('/', 'auth/login/temporal')->middleware('guest');
/* Auth 365 */
Route::group(['middleware' => ['web', 'guest'], 'namespace' => 'App\Http\Controllers\Auth'], function(){
    Route::get('login', 'AuthController@login')->name('login');
    Route::get('connect', 'AuthController@connect')->name('connect');
});

Route::group(['middleware' => ['web', 'MsGraphAuthenticated'], 'prefix' => 'app', 'namespace' => 'App\Http\Controllers'], function(){
    Route::get('/', 'PagesController@app')->name('app');
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
    Route::view('/welcome', 'welcome')->middleware(['auth', 'teacher']);

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

Route::post('/updateFiles', [ArchivosController::class, 'update'])->name('updateFiles');
