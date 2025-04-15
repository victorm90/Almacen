<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = "Usuarios";
    $items = User::all();
    
    // Consulta única para obtener todas las estadísticas
    $estadisticas = User::selectRaw('
        COUNT(*) as total,
        SUM(CASE WHEN activo = 1 THEN 1 ELSE 0 END) as activos,
        SUM(CASE WHEN activo = 0 THEN 1 ELSE 0 END) as inactivos
    ')->first();

    return view('modules.usuarios.index', compact(
        'items',
        'titulo',
        'estadisticas'
    ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titulo = 'Usuario nuevo';
        return view('modules.usuarios.create', compact('titulo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'activo' => true,
                'rol' => $request->rol
            ]);

            return to_route('usuarios')->with('success', 'Usuario guardado con exito!');
        } catch (Exception $e) {
            return to_route('usuarios')->with('error', 'Error al guardar usuario!' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = User::find($id);
        $titulo = "Editar usuario";
        return view('modules.usuarios.edit', compact('item', 'titulo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.$id,
                'rol' => 'required|in:admin,cajero'
            ]);
    
            $user = User::findOrFail($id);
            $user->update($request->all());
    
            return redirect()->route('usuarios')->with('success', '¡Usuario actualizado con éxito!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('usuarios')->with('error', 'Usuario no encontrado');
        } catch (Exception $e) {
            return redirect()->route('usuarios')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function tbody()
    {
        $items = User::all();
        return view('modules.usuarios.tbody', compact('items'));
    }

    public function estado($id, $estado)
    {
        $item = User::find($id);
        $item->activo = $estado;
        return $item->save();
    }

    public function cambio_password($id, $password)
    {
        $item = User::find($id);
        $item->password = Hash::make($password);
        return $item->save();
    }
}
