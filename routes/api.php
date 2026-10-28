<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\EstudianteController;

// CRUD completo para carreras y estudiantes
Route::apiResource('carreras', CarreraController::class);
Route::apiResource('estudiantes', EstudianteController::class);

// Endpoint de relación personalizado con Eager Loading
Route::get('carreras/{id}/estudiantes', [CarreraController::class, 'obtenerEstudiantes']);

