@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle mb-4">
      <h1 class="fw-bold text-primary">Editar Usuario</h1>
      <nav class="d-flex">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('usuarios') }}">Usuarios</a></li>
              <li class="breadcrumb-item active">Editar #{{ $item->id }}</li>
          </ol>
      </nav>
  </div>

  <section class="section">
      <div class="row justify-content-center">
          <div class="col-lg-8">
              <div class="card shadow-sm border-0">
                  <div class="card-header bg-white py-3 border-bottom">
                      <h5 class="card-title mb-0 text-secondary">
                          <i class="fas fa-user-edit me-2"></i>Editar Registro: {{ $item->name }}
                      </h5>
                  </div>
                  
                  <div class="card-body pt-4">
                      <form action="{{ route('usuarios.update', $item->id) }}" method="POST" class="needs-validation" novalidate>
                          @csrf
                          @method('PUT')
                          
                          <div class="row g-4">
                              <!-- Nombre -->
                              <div class="col-md-6">
                                  <label for="name" class="form-label fw-medium text-muted mb-2">
                                      Nombre completo <span class="text-danger">*</span>
                                  </label>
                                  <input type="text" 
                                         class="form-control form-control-lg rounded-3" 
                                         id="name" 
                                         name="name" 
                                         required
                                         value="{{ $item->name }}"
                                         placeholder="Ej: Juan Pérez">
                                  <div class="invalid-feedback">
                                      Por favor ingrese el nombre del usuario
                                  </div>
                              </div>

                              <!-- Email -->
                              <div class="col-md-6">
                                  <label for="email" class="form-label fw-medium text-muted mb-2">
                                      Correo electrónico <span class="text-danger">*</span>
                                  </label>
                                  <input type="email" 
                                         class="form-control form-control-lg rounded-3" 
                                         id="email" 
                                         name="email" 
                                         required
                                         value="{{ $item->email }}"
                                         placeholder="Ej: usuario@dominio.com">
                                  <div class="invalid-feedback">
                                      Por favor ingrese un email válido
                                  </div>
                              </div>
                              
                              <!-- Rol -->
                              <div class="col-md-6">
                                  <label for="rol" class="form-label fw-medium text-muted mb-2">
                                      Rol del usuario <span class="text-danger">*</span>
                                  </label>
                                  <select class="form-select form-select-lg rounded-3" 
                                          id="rol" 
                                          name="rol" 
                                          required>
                                      <option value="">Seleccione un rol...</option>
                                      <option value="admin" {{ $item->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
                                      <option value="cajero" {{ $item->rol == 'cajero' ? 'selected' : '' }}>Cajero</option>
                                  </select>
                                  <div class="invalid-feedback">
                                      Debe seleccionar un rol para el usuario
                                  </div>
                              </div>
                          </div>

                          <!-- Botones -->
                          <div class="d-flex justify-content-end gap-3 mt-5 border-top pt-4">
                              <a href="{{ route('usuarios') }}" class="btn btn-lg btn-outline-secondary px-4 rounded-pill">
                                  <i class="fas fa-times me-2"></i> Cancelar
                              </a>
                              <button type="submit" class="btn btn-lg btn-warning px-4 rounded-pill">
                                  <i class="fas fa-sync-alt me-2"></i> Actualizar
                              </button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </section>
</main>

<!-- Script para mostrar/ocultar contraseña -->
<script>
document.getElementById('togglePassword').addEventListener('click', function() {
  const passwordField = document.getElementById('password');
  const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordField.setAttribute('type', type);
  this.querySelector('i').classList.toggle('fa-eye-slash');
});
</script>

<style>
.form-control-lg {
  padding: 0.75rem 1.25rem;
  font-size: 1rem;
}

.form-label {
  font-size: 0.9rem;
}

.btn-warning {
  background: linear-gradient(135deg, #f59e0b, #fbbf24);
  border: none;
  color: white;
  transition: all 0.3s ease;
}

.btn-warning:hover {
  background: linear-gradient(135deg, #d97706, #f59e0b);
  color: white;
}
</style>
@endsection
