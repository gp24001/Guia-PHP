<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LibroController extends Controller
{
    public function index()
    {
        return response()->json(Libro::with(['categoria', 'autores'])->get());
    }

    public function show(Libro $libro)
    {
        return response()->json($libro->load(['categoria', 'autores', 'detallePrestamos']));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:200',
            'año_publicacion' => 'nullable|integer',
            'id_categoria' => 'required|exists:categorias,id',
            'id_autores' => 'sometimes|array',
            'id_autores.*' => 'exists:autores,id',
        ]);

        $libro = Libro::create(Arr::only($data, ['titulo', 'año_publicacion', 'id_categoria']));

        if ($request->has('id_autores')) {
            $libro->autores()->sync($request->input('id_autores', []));
        }

        return response()->json($libro->load(['categoria', 'autores']), 201);
    }

    public function update(Request $request, Libro $libro)
    {
        $data = $request->validate([
            'titulo' => 'sometimes|required|string|max:200',
            'año_publicacion' => 'nullable|integer',
            'id_categoria' => 'sometimes|required|exists:categorias,id',
            'id_autores' => 'sometimes|array',
            'id_autores.*' => 'exists:autores,id',
        ]);

        $libro->update(Arr::only($data, ['titulo', 'año_publicacion', 'id_categoria']));

        if ($request->has('id_autores')) {
            $libro->autores()->sync($request->input('id_autores', []));
        }

        return response()->json($libro->load(['categoria', 'autores']));
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();

        return response()->json(null, 204);
    }
}