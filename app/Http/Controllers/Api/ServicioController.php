<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    // GET /api/servicios
    public function index()
    {
        return response()->json(Servicio::all());
    }

    // POST /api/servicios
    public function store(Request $request)
    {
        $request->validate([
            'nombre_servicio' => 'required|string|max:100',
            'precio'          => 'nullable|numeric',
            'categoria'       => 'nullable|string|max:50',
            'imagen_url'      => 'nullable|string',
            'descripcion'     => 'nullable|string',
        ]);

        $servicio = Servicio::create($request->all());

        return response()->json($servicio, 201);
    }

    // GET /api/servicios/{id}
    public function show($id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }

        return response()->json($servicio);
    }

    // PUT /api/servicios/{id}
    public function update(Request $request, $id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }

        $servicio->update($request->all());

        return response()->json($servicio);
    }

    // DELETE /api/servicios/{id}
    public function destroy($id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }

        $servicio->delete();

        return response()->json(['message' => 'Servicio eliminado correctamente']);
    }
}