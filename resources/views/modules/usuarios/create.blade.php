@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Agregar Usuario</h1>
    
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Agregar Nuevo Usuario</h5>
            
            <form action="{{ route("usuarios.store") }}" method="POST">
                @csrf
                <label for="name" class="fw-bold">Nombre del usuario</label>
                <input type="text" class="form-control" required name="name" id="name">

                <label for="email" class="mt-2 fw-bold">Email</label>
                <input type="text" name="email" id="email" class="form-control" required>

                <label for="password" class="mt-2 fw-bold">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>

                <label for="rol" class="mt-2 fw-bold">Rol de usuario</label>
                <select name="rol" id="rol" class="form-select">
                  <option value="">Selecciona el rol</option>
                  <option value="admin">Admin</option>
                  <option value="cajero">Cajero</option>
                </select>

                <button class="btn btn-primary mt-4">Guardar</button>
                <a href="{{ route("usuarios") }}" class="btn btn-info mt-4">
                    Cancelar
                </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
@endsection
