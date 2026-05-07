<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
    public function index()
    {
        return response()->json(
            Empleado::with('usuario')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:100',
            'email'        => 'required|email|unique:usuarios,email',
            'password'     => 'required|string|min:6',
            'dni'          => 'nullable|string|max:20',
            'especialidad' => 'nullable|string|max:50',
            'rol'          => 'required|in:tecnico,admin',
        ]);

        $usuario = Usuario::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'rol'      => $request->rol,
        ]);

        $empleado = Empleado::create([
            'usuario_id'    => $usuario->id,
            'dni'           => $request->dni,
            'especialidad'  => $request->especialidad,
            'disponibilidad'=> true,
        ]);

        return response()->json($empleado->load('usuario'), 201);
    }

    public function update(Request $request, $id)
    {
        $empleado = Empleado::find($id);

        if (!$empleado) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }

        $empleado->update([
            'dni'            => $request->dni,
            'especialidad'   => $request->especialidad,
            'disponibilidad' => $request->disponibilidad,
        ]);

        if ($request->nombre || $request->email) {
            $empleado->usuario->update([
                'nombre' => $request->nombre ?? $empleado->usuario->nombre,
                'email'  => $request->email ?? $empleado->usuario->email,
                'rol'    => $request->rol ?? $empleado->usuario->rol,
            ]);
        }

        return response()->json($empleado->load('usuario'));
    }

    public function destroy($id)
    {
        $empleado = Empleado::find($id);

        if (!$empleado) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }

        $empleado->usuario->delete();
        $empleado->delete();

        return response()->json(['message' => 'Empleado eliminado correctamente']);
    }
}
