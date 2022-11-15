<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TemporalAuthController;
use App\Http\Controllers\Personal\ArchivosController;

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

Route::view('/', 'welcome');
// Route::redirect('/', 'auth/login/temporal');

// /* Auth 365 */
// Route::group(['middleware' => ['web', 'guest'], 'namespace' => 'App\Http\Controllers\Auth'], function(){
//     Route::get('login', 'AuthController@login')->name('login');
//     Route::get('connect', 'AuthController@connect')->name('connect');
// });

// Route::group(['middleware' => ['web', 'MsGraphAuthenticated'], 'prefix' => 'app', 'namespace' => 'App\Http\Controllers'], function(){
//     Route::get('/', 'PagesController@app')->name('app');
//     Route::get('logout', 'Auth\AuthController@logout')->name('logout');
// });

// /* Auth Normal Temporal*/
// Route::prefix('auth')->group(function (){
//     Route::get('login/temporal', [TemporalAuthController::class, 'login'])->name('login.temporal');
//     Route::post('authenticate/temporal', [TemporalAuthController::class, 'authenticate'])->name('authenticate.temporal');
//     Route::post('logout/temporal', [TemporalAuthController::class, 'logout'])->name('logout.temporal');
// });

Route::post('/updateFiles', [ArchivosController::class, 'update'])->name('updateFiles');