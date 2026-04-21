<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    // GET /api/citas
    public function index(Request $request)
{
    $usuario = $request->user();

    if ($usuario->rol === 'admin') {
        $citas = Cita::with(['usuario', 'servicio'])->get();
    } else {
        $citas = Cita::with(['servicio'])
            ->where('usuario_id', $usuario->id)
            ->get();
    }

    return response()->json($citas);
}

    // POST /api/citas
    public function store(Request $request)
    {
        $request->validate([
            'servicio_id'  => 'required|exists:servicios,id',
            'fecha_cita'   => 'required|date',
            'hora_cita'    => 'required',
            'observaciones'=> 'nullable|string',
        ]);

        $cita = Cita::create([
            'usuario_id'   => $request->user()->id,
            'servicio_id'  => $request->servicio_id,
            'fecha_cita'   => $request->fecha_cita,
            'hora_cita'    => $request->hora_cita,
            'observaciones'=> $request->observaciones,
            'estado'       => 'pendiente',
        ]);

        return response()->json($cita, 201);
    }

    // GET /api/citas/{id}
    public function show(Request $request, $id)
    {
        $cita = Cita::with(['servicio', 'usuario'])->find($id);

        if (!$cita) {
            return response()->json(['message' => 'Cita no encontrada'], 404);
        }

        // Cliente solo puede ver sus propias citas
        if ($request->user()->rol !== 'admin' && $cita->usuario_id !== $request->user()->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return response()->json($cita);
    }

    // PUT /api/citas/{id}
    public function update(Request $request, $id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['message' => 'Cita no encontrada'], 404);
        }

        $cita->update($request->all());

        return response()->json($cita);
    }

    // DELETE /api/citas/{id}
    public function destroy($id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['message' => 'Cita no encontrada'], 404);
        }

        $cita->delete();

        return response()->json(['message' => 'Cita eliminada correctamente']);
    }
}