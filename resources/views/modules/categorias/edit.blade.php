@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Categorias</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">INICIO</a></li>
                    <li class="breadcrumb-item"><a href="{{route('categorias')}}">CATEGORIAS</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Editar Categoria</h5>

                                <form action="{{route('categorias.update', $item->id)}}" 
                                method="POST">
                                @csrf
                                @method("PUT")
                                    <label class="fw-bold" for="nombre">Nombre de Categoria</label>
                                    <input type="text" class="form-control" required 
                                    name="nombre" id="nombre" value="{{$item->nombre}}">
                                    <button class="btn btn-info mt-4">Actualizar</button>
                                </form>                                                             

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
        <section class="section dashboard">

        </section>
    </main>
@endsection