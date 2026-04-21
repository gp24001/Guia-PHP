<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PrestamoController extends Controller
{
    public function index()
    {
        return response()->json(Prestamo::with(['usuario', 'libros'])->get());
    }

    public function show(Prestamo $prestamo)
    {
        return response()->json($prestamo->load(['usuario', 'libros', 'detallePrestamos']));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_usuario' => 'required|exists:users,id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_prestamo',
            'id_libros' => 'sometimes|array',
            'id_libros.*' => 'exists:libros,id',
        ]);

        $prestamo = Prestamo::create(Arr::only($data, ['id_usuario', 'fecha_prestamo', 'fecha_devolucion']));

        if ($request->has('id_libros')) {
            $prestamo->libros()->sync($request->input('id_libros', []));
        }

        return response()->json($prestamo->load(['usuario', 'libros']), 201);
    }

    public function update(Request $request, Prestamo $prestamo)
    {
        $data = $request->validate([
            'id_usuario' => 'sometimes|required|exists:users,id',
            'fecha_prestamo' => 'sometimes|required|date',
            'fecha_devolucion' => 'nullable|date',
            'id_libros' => 'sometimes|array',
            'id_libros.*' => 'exists:libros,id',
        ]);

        $prestamo->update(Arr::only($data, ['id_usuario', 'fecha_prestamo', 'fecha_devolucion']));

        if ($request->has('id_libros')) {
            $prestamo->libros()->sync($request->input('id_libros', []));
        }

        return response()->json($prestamo->load(['usuario', 'libros']));
    }

    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();

        return response()->json(null, 204);
    }
}