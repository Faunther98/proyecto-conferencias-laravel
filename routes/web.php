<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Roles\ListarRolesComponent;
use App\Livewire\Usuarios\ListarUsuariosComponent;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/', \App\Livewire\Publico\HomeComponent::class)->name('home');


Route::get('/hola', function () {
    return '<h1>Probando cómo se conecta routes</h1>';
});


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

    Route::get('/eventos', function () {
        return "Aquí listaremos los eventos próximamente";
    })->name('eventos.index');

    Route::get('/eventos/crear', function () {
        return "Aquí estará el formulario para crear un evento";
    })->name('eventos.create');



});

Route::get('/creditos', function () {
    return view('creditos');
})->name('creditos');

require __DIR__.'/auth.php';


//Para manejar errores 404
Route::fallback(function () {
    return redirect()->route('dashboard')->error('messages.pagina_no_existe');
});