<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\prueba;
use App\Http\Controllers\UserController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::resource('/productos', ProductoController::class)
        ->middleware('role:administrador|administrador1');
    Route::resource('/pocos', prueba::class)
        ->middleware('role:administrador|administrador1');

    // Route::get('user/list', [UserController::class, 'list'])->name('user.list')
    //     ->middleware('role:administrador');
    // Route::view('role/list','role.list')->name('role.list')
    //     ->middleware('role:administrador');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
