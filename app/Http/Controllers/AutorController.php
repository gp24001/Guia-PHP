<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        return response()->json(Autor::all());
    }

    public function show(Autor $autor)
    {
        $autor->load('libros');

        return response()->json([
            'autor' => $autor->only(['id', 'nombre']),
            'libros' => $autor->libros,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:150',
        ]);

        $autor = Autor::create($data);

        return response()->json($autor, 201);
    }

    public function update(Request $request, Autor $autor)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:150',
        ]);

        $autor->update($data);

        return response()->json($autor->fresh());
    }

    public function destroy(Autor $autor)
    {
        $autor->delete();

        return response()->json(null, 204);
    }
}