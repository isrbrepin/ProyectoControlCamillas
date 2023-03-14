<?php

use App\Http\Controllers\SalaController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { 
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {
    Route::resources([
        //No pongo medicos como route resource porque voy a añadirle middlewares diferentes
        //'medicos' => MedicoController::class,
        'salas' => SalaController::class,
        'especialidads' => EspecialidadController::class,
        'pacientes' => PacienteController::class,
    ]);
    Route::get('/pacientes-hoy', [PacienteController::class, 'pacientesHoy']);
    //Todos los usuarios pueden listar y ver el detalle de un médico
    Route::get('/medicos', [MedicoController::class, 'index'])->name('medicos.index');
    Route::get('/medicos/{medico}', [MedicoController::class, 'show'])->name('medicos.show');
});

//Solo los administradores pueden crear y borrar médicos, así como trabajar con el CRUD de Medicamentos
Route::middleware(['auth', 'tipo_usuario:3'])->group(function () {
    Route::get('/medicos/create', [MedicoController::class, 'create'])->name('medicos.create');
    Route::post('/medicos', [MedicoController::class, 'store'])->name('medicos.store');
    Route::delete('/medicos/{medico}', [MedicoController::class, 'destroy'])->name('medicos.destroy');
    Route::resources([
        'medicamentos' => MedicamentoController::class,
    ]);
});

//Tanto los médicos como los administradores pueden editar el médico y trabajar con las salas
Route::middleware(['auth', 'tipo_usuario:1,3'])->group(function () {
    Route::get('/medicos/{medico}/edit', [MedicoController::class, 'edit'])->name('medicos.edit');
    Route::put('/medicos/{medico}', [MedicoController::class, 'update'])->name('medicos.update');
    //Dos rutas que tienen además un middleware con un Policy para hilar fino
    Route::post('/salas/{sala}/attach-medicamento', [SalaController::class, 'attach_medicamento'])
        ->name('salas.attachMedicamento')
        ->middleware('can:attach_medicamento,sala');
    Route::delete('/salas/{sala}/detach-medicamento/{medicamento}', [SalaController::class, 'detach_medicamento'])
        ->name('salas.detachMedicamento')
        ->middleware('can:detach_medicamento,sala');
});
