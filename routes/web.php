<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Eventos\ListarEventosComponent;
use App\Livewire\Eventos\ListarSesionesComponent;
use App\Livewire\Roles\ListarRolesComponent;
use App\Livewire\Usuarios\ListarUsuariosComponent;
use App\Models\Usuario;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
*/


// VISTA HOME 

Route::get('/', \App\Livewire\Publico\HomeComponent::class)->name('home');






Route::get('/inicio', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/usuarios', ListarUsuariosComponent::class)->name('admin.usuarios.index')->middleware('permission:consultar-listado-usuarios|registrar-usuario|cambiar-estatus-usuario');
    Route::get('/roles', ListarRolesComponent::class)->name('admin.roles.index')->middleware('permission:consultar-listado-roles|registrar-rol');
// Rutas para el módulo de Eventos
    Route::get('/eventos', ListarEventosComponent::class)->name('eventos.listar');
//Ruta sesiones
Route::get('/eventos/{evento}/sesiones', ListarSesionesComponent::class)->name('eventos.sesiones');

});

Route::get('/creditos', function () {
    return view('creditos');
})->name('creditos');

require __DIR__.'/auth.php';


//Para manejar errores 404
Route::fallback(function () {
    return redirect()->route('dashboard')->error('messages.pagina_no_existe');
});