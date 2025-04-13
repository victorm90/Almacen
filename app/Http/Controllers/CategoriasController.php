<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Categorias';
        $items = Categoria::all();
        return view('modules.categorias.index', compact('titulo', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titulo = 'Crear Categoria';
        return view('modules.categorias.create', compact('titulo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        try {
            /* $item = Categoria::create([
            'user_id' => Auth::id(),
            'nombre' => $validated['nombre']
        ]); */
            $item = new Categoria();
            $item->user_id = Auth::id();
            $item->fill($validated);
            $item->save();

            return redirect()->route('categorias')
                ->with('success', 'Categoría agregada exitosamente!!');
        } catch (QueryException $e) {
            Log::error('Error al crear categoría: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'input' => $request->all()
            ]);

            return redirect()->route('categorias')
                ->with('error', 'No se pudo crear la categoría. Por favor intente nuevamente.');
        } catch (\Exception $e) {
            Log::critical('Error inesperado al crear categoría: ' . $e->getMessage());

            return redirect()->route('categorias')
                ->with('error', 'Ocurrió un error inesperado. Contacte al soporte técnico.');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $titulo = 'Eliminar Categoria';
        $item = Categoria::find($id);
        return view('modules.categorias.show', compact('titulo', 'item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $titulo = 'Editar Categoria';
        $item = Categoria::find($id);
        return view('modules.categorias.edit', compact('titulo', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $id
        ]);

        try {
            $item = Categoria::findOrFail($id);
            $item->fill($validated);
            $item->save();

            return redirect()->route('categorias')
                ->with('success', 'Categoría actualizada exitosamente');
        } catch (ModelNotFoundException $e) {
            Log::warning("Intento de actualizar categoría inexistente - ID: $id", [
                'user_id' => Auth::id(),
                'ip' => $request->ip()
            ]);

            return redirect()->route('categorias')
                ->with('error', 'La categoría no existe o fue eliminada');
        } catch (QueryException $e) {
            Log::error('Error BD actualizando categoría: ' . $e->getMessage(), [
                'id' => $id,
                'user_id' => Auth::id(),
                'input' => $request->all()
            ]);

            return redirect()->route('categorias')
                ->with('error', 'Error al guardar en la base de datos. Intente nuevamente');
        } catch (\Exception $e) {
            Log::critical('Error inesperado actualizando categoría: ' . $e->getMessage(), [
                'id' => $id,
                'user_id' => Auth::id()
            ]);

            return redirect()->route('categorias')
                ->with('error', 'Error crítico al actualizar. Contacte al soporte');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $item = Categoria::findOrFail($id);
            
            // Opcional: Validar permisos adicionales
            if ($item->user_id != Auth::id()) {
                throw new \Exception('No tienes permisos para eliminar esta categoría');
            }
            
            $item->delete();
    
            return redirect()->route('categorias')
                ->with('success', 'Categoría eliminada exitosamente');
    
        } catch (ModelNotFoundException $e) {
            Log::warning("Intento de eliminar categoría inexistente - ID: $id", [
                'user_id' => Auth::id(),
                'ip' => request()->ip()
            ]);
            
            return redirect()->route('categorias')
                ->with('error', 'La categoría no existe o ya fue eliminada');
    
        } catch (QueryException $e) {
            Log::error('Error BD eliminando categoría: ' . $e->getMessage(), [
                'id' => $id,
                'user_id' => Auth::id()
            ]);
            
            $errorMessage = 'No se pudo eliminar la categoría. ';
            
            // Detectar error de integridad referencial
            if ($e->errorInfo[1] == 1451) {
                $errorMessage .= 'Existen registros relacionados que dependen de esta categoría.';
            } else {
                $errorMessage .= 'Error en la base de datos.';
            }
            
            return redirect()->route('categorias')
                ->with('error', $errorMessage);
    
        } catch (\Exception $e) {
            Log::critical('Error inesperado eliminando categoría: ' . $e->getMessage(), [
                'id' => $id,
                'user_id' => Auth::id()
            ]);
            
            return redirect()->route('categorias')
                ->with('error', 'Error crítico al eliminar: ' . $e->getMessage());
        }
    }
}
