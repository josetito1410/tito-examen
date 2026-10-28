<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public function index() {
        return response()->json(Carrera::all(), 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'codigo' => 'required|string|unique:carreras,codigo',
            'facultad' => 'required|string',
            'duracion_semestres' => 'required|integer|between:6,14'
        ]);

        $carrera = Carrera::create($validated);
        return response()->json($carrera, 201);
    }

    public function show($id) {
        $carrera = Carrera::find($id);
        if (!$carrera) return response()->json(['message' => 'No encontrado'], 404);
        return response()->json($carrera, 200);
    }

    public function update(Request $request, $id) {
        $carrera = Carrera::find($id);
        if (!$carrera) return response()->json(['message' => 'No encontrado'], 404);

        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'codigo' => 'sometimes|required|string|unique:carreras,codigo,' . $id,
            'facultad' => 'sometimes|required|string',
            'duracion_semestres' => 'sometimes|required|integer|between:6,14'
        ]);

        $carrera->update($validated);
        return response()->json($carrera, 200);
    }

    public function destroy($id) {
        $carrera = Carrera::find($id);
        if (!$carrera) return response()->json(['message' => 'No encontrado'], 404);

        // Requisito 6 del examen: Rechazo con 409 si la carrera tiene estudiantes vinculados
        if ($carrera->estudiantes()->exists()) {
            return response()->json(['message' => 'Conflicto: La carrera tiene estudiantes matriculados'], 409);
        }

        $carrera->delete();
        return response()->json(null, 204);
    }

    // Actividad 6: Endpoint de relación usando eager loading con with()
    public function obtenerEstudiantes($id) {
        $carrera = Carrera::with('estudiantes')->find($id);
        if (!$carrera) return response()->json(['message' => 'No encontrado'], 404);
        return response()->json($carrera, 200);
    }
}
