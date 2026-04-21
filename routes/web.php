<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Eventos\ListarEventosComponent;
use App\Livewire\Eventos\ListarSesionesComponent;
use App\Livewire\Inscripciones\ListarInscripcionesUsuarioComponent;
use App\Livewire\Publico\CarteleraEventosComponent;
use App\Livewire\Roles\ListarRolesComponent;
use App\Livewire\Usuarios\ListarUsuariosComponent;
use Illuminate\Support\Facades\Route;

// HOME público
Route::get('/', CarteleraEventosComponent::class)->name('home');

// Inicio logueados
Route::get('/inicio', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Requieren Login
Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/usuarios', ListarUsuariosComponent::class)->name('admin.usuarios.index')
        ->middleware('permission:consultar-listado-usuarios|registrar-usuario|cambiar-estatus-usuario');
        
    Route::get('/roles', ListarRolesComponent::class)->name('admin.roles.index')
        ->middleware('permission:consultar-listado-roles|registrar-rol');

    
    //Gestión de eventos  Admin/Organizador
    Route::get('/eventos', ListarEventosComponent::class)
        ->name('eventos.listar')
        ->middleware('can:ver-eventos');

    // Ruta de sesiones del evento 
    Route::get('/eventos/{evento}/sesiones', ListarSesionesComponent::class)
        ->name('eventos.sesiones')
        ->middleware('can:ver-eventos'); 

    // Ruta mis inscripciones (Solo Asistentes)
    Route::get('/mis-inscripciones', ListarInscripcionesUsuarioComponent::class)
        ->name('asistente.inscripciones')
        ->middleware('can:ver-mis-inscripciones');
});

Route::get('/creditos', function () {
    return view('creditos');
})->name('creditos');

require __DIR__.'/auth.php';

// Para manejar errores 404
Route::fallback(function () {
    return redirect()->route('dashboard')->error('messages.pagina_no_existe');
});