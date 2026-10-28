<?php

namespace database\seeders;

use App\Models\Carrera;
use App\Models\Estudiante;
use Illuminate\Database\Seeder;

class UniversidadSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear 5 Carreras
        $carrera1 = Carrera::create(['nombre' => 'Ingeniería de Sistemas', 'codigo' => 'C001', 'facultad' => 'Ingeniería y Arquitectura', 'duracion_semestres' => 10]);
        $carrera2 = Carrera::create(['nombre' => 'Medicina Humana', 'codigo' => 'C002', 'facultad' => 'Ciencias de la Salud', 'duracion_semestres' => 14]);
        $carrera3 = Carrera::create(['nombre' => 'Derecho', 'codigo' => 'C003', 'facultad' => 'Derecho y Ciencias Políticas', 'duracion_semestres' => 12]);
        $carrera4 = Carrera::create(['nombre' => 'Administración', 'codigo' => 'C004', 'facultad' => 'Ciencias Económicas', 'duracion_semestres' => 10]);
        $carrera5 = Carrera::create(['nombre' => 'Contabilidad', 'codigo' => 'C005', 'facultad' => 'Ciencias Económicas', 'duracion_semestres' => 10]);

        // 2. Crear 15 Estudiantes distribuidos entre ellas
        $carreras = [$carrera1, $carrera2, $carrera3, $carrera4, $carrera5];

        for ($i = 1; $i <= 15; $i++) {
            // Asigna una carrera de forma cíclica o aleatoria del arreglo
            $carreraAsignada = $carreras[$i % 5];

            Estudiante::create([
                'carrera_id' => $carreraAsignada->id,
                'codigo' => 'EST2026' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nombres_apellidos' => "Estudiante Ejemplo " . $i,
                'email' => "estudiante" . $i . "@uandina.edu.pe",
                'fecha_nacimiento' => '2000-01-' . str_pad($i, 2, '0', STR_PAD_LEFT),
            ]);
        }
    }
}

