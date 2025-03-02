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
                                <h5 class="card-title">Estas seguro de eliminar esta categoria..?</h5>

                                <form action="{{route('categorias.destroy', $item->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                    <label class="fw-bold" for="nombre">Nombre de Categoria</label>
                                    <input type="text" class="form-control" readonly 
                                     name="nombre" id="nombre" value="{{$item->nombre}}">
                                    <button class="btn btn-danger mt-4">Eliminar</button>
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