<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CanchasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\Auth\LoginController;



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




//Auth::routes();


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'loginUser'])
    ->name('login.post');

// Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('contacto', [ContactoController::class, 'index'])->name('contacto.index');
    Route::get('canchas', [CanchasController::class, 'index'])->name('canchas.index');
    Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');

    Route::post('crearUsuario', [UsuariosController::class, 'createUser'])->name('user.create');
// });
