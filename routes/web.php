<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Livewire\Dash\DashboardComponent;
use App\Http\Livewire\Dash\MiCuentaComponent;
use App\Http\Livewire\Dash\EmpresasComponent;
use App\Http\Livewire\Dash\EmpresaDashboardComponent;
use App\Http\Livewire\Dash\EmpresaOrganigramaComponent;
use App\Http\Livewire\Dash\EmpresaUsuariosComponent;
use App\Http\Livewire\Dash\EmpresaProfesoresComponent;
use App\Http\Livewire\Dash\EmpresaCursosComponent;
use App\Http\Livewire\Dash\EmpresaPlanesComponent;
use App\Http\Livewire\Dash\AlumnoCursosComponent;
use App\Http\Livewire\Dash\AlumnoExamenesComponent;

// - - - - - - - - - - - - - - - -

// sitio
Route::view('/', 'site.index')->name('site');

// autenticación
require __DIR__.'/auth.php';

// dashboard
Route::prefix('dashboard')->middleware('auth', 'verified')->group(function(){

    // change
    Route::get('change-rol/{rol}', [DashController::class, 'changeRol'])->name('change.rol');
    Route::get('change-empresa/{empresa}', [DashController::class, 'changeEmpresa'])->name('change.empresa');

    // livewire
    Route::get('/', DashboardComponent::class)->name('dashboard')->middleware('redir');
    Route::get('mi-cuenta', MiCuentaComponent::class)->name('micuenta');

    Route::get('empresas', EmpresasComponent::class)->name('empresas.index');
    Route::get('empresas/{moEmpresa}/dashboard', EmpresaDashboardComponent::class)->name('empresas.dashboard.index');
    Route::get('empresas/{moEmpresa}/organigrama', EmpresaOrganigramaComponent::class)->name('empresas.organigrama.index');
    Route::get('empresas/{moEmpresa}/usuarios', EmpresaUsuariosComponent::class)->name('empresas.usuarios.index');
    Route::get('empresas/{moEmpresa}/profesores', EmpresaProfesoresComponent::class)->name('empresas.profesores.index');
    Route::get('empresas/{moEmpresa}/cursos', EmpresaCursosComponent::class)->name('empresas.cursos.index');
    Route::get('empresas/{moEmpresa}/planes', EmpresaPlanesComponent::class)->name('empresas.planes.index');
    Route::get('alumno/cursos', AlumnoCursosComponent::class)->name('alumno.cursos.index');
    Route::get('alumno/examenes', AlumnoExamenesComponent::class)->name('alumno.examenes.index');

    // Controladores

    Route::get('certificado/{moEvaluacion}', [DashController::class, 'generarCertificado'])->name('certificado');


});

Route::get('slink', function () {
    Artisan::call('storage:link');
});