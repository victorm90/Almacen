<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
       $item = new Categoria();
       $item->user_id = Auth::user()->id;
       $item->nombre = $request->nombre;
       $item->save();
       return to_route('categorias');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $titulo = 'Eliminar Categoria';   
        $item =Categoria::find($id);
        return view('modules.categorias.show', compact('titulo','item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $titulo = 'Editar Categoria';   
        $item =Categoria::find($id);
        return view('modules.categorias.edit', compact('titulo','item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Categoria::find($id);        
        $item->nombre = $request->nombre;
        $item->save();
        return to_route('categorias');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $item = Categoria::find($id);
       $item->delete();
       return to_route('categorias');
    }
}