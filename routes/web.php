<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CanchasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\Auth\LoginController;


// vistas del login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');




// metodo post para el login y logout
Route::post('/login', [LoginController::class, 'loginUser'])
    ->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');
    

// rutas protegidas
Route::middleware(['auth', 'check.status'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home'); 

    // rutas de concatcos
    Route::get('contacto', [ContactoController::class, 'index'])->name('contacto.index');
    Route::post('contacto', [ContactoController::class, 'store'])->name('contacto.store');
       
   //funciomes de canchas
    Route::get('/canchas', [CanchasController::class, 'index'])->name('canchas.index');
    Route::post('crearReserva', [CanchasController::class, 'create'])->name('reservas.create');
    Route::get('horas-disponibles', [CanchasController::class, 'getHorasDisponibles'])->name('horas-disponibles');
    Route::get('/comprobante-reserva', [CanchasController::class, 'generarComprobante']);

    // funciones de usuarios
    Route::get('/getUsuarios', [UsuariosController::class, 'getUsuarios']);
    Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::post('crearUsuario', [UsuariosController::class, 'createUser'])->name('user.create');
    Route::get('verUsuario/{id}', [UsuariosController::class, 'getUser']);
    Route::post('editarUsuario/{id}', [UsuariosController::class, 'update']);
    Route::get('editarUsuario/{id}', [UsuariosController::class, 'getUser']);;
    Route::delete('eliminarUsuario/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
    Route::post('deshabilitarUsuario/{id}', [UsuariosController::class, 'deshabilitarUsuario']);
    Route::post('/filtrarUsuarios', [UsuariosController::class, 'filtrarUsuarios']);
    Route::get('/filtrarUsuarios', [UsuariosController::class, 'index']);
    
});
