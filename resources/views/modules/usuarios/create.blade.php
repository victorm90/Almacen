@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
    <main id="main" class="main">
        <div class="pagetitle mb-4">
            <h1 class="fw-bold text-primary">Nuevo Usuario</h1>
            <nav class="d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('usuarios') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active">Crear Usuario</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3 border-bottom">
                            <h5 class="card-title mb-0 text-secondary">
                                <i class="fas fa-user-plus me-2"></i>Registro de Nuevo Usuario
                            </h5>
                        </div>

                        <div class="card-body pt-4">
                            <form action="{{ route('usuarios.store') }}" method="POST" class="needs-validation" novalidate>
                                @csrf

                                <div class="row g-4">
                                    <!-- Nombre -->
                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-medium text-muted mb-2">
                                            Nombre completo <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control form-control-lg rounded-3" id="name"
                                            name="name" required placeholder="Ej: Juan Pérez">
                                        <div class="invalid-feedback">
                                            Por favor ingrese el nombre del usuario
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <label for="email" class="form-label fw-medium text-muted mb-2">
                                            Correo electrónico <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control form-control-lg rounded-3" id="email"
                                            name="email" required placeholder="Ej: usuario@dominio.com">
                                        <div class="invalid-feedback">
                                            Por favor ingrese un email válido
                                        </div>
                                    </div>

                                    <!-- Contraseña -->
                                    <div class="col-md-6">
                                        <label for="password" class="form-label fw-medium text-muted mb-2">
                                            Contraseña <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-lg rounded-3"
                                                id="password" name="password" required placeholder="Mínimo 8 caracteres">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="invalid-feedback">
                                            La contraseña es requerida
                                        </div>
                                        <div class="progress mt-2" style="height: 4px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
                                        </div>
                                    </div>

                                    <!-- Rol -->
                                    <div class="col-md-6">
                                        <label for="rol" class="form-label fw-medium text-muted mb-2">
                                            Rol del usuario <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-select-lg rounded-3" id="rol" name="rol"
                                            required>
                                            <option value="" selected disabled>Seleccione un rol...</option>
                                            <option value="admin">Administrador</option>
                                            <option value="cajero">Cajero</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Debe seleccionar un rol para el usuario
                                        </div>
                                    </div>
                                </div>

                                <!-- Botones -->
                                <div class="d-flex justify-content-end gap-2 mt-5 border-top pt-4">
                                  <a href="{{ route('usuarios') }}" class="btn btn-floating btn-cancel">
                                      <i class="fas fa-times"></i>
                                      <span>Cancelar</span>
                                  </a>
                                  <button type="submit" class="btn btn-floating btn-save">
                                      <i class="fas fa-save"></i>
                                      <span>Guardar</span>
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

        .progress {
            background-color: #e9ecef;
        }

        .rounded-pill {
            transition: all 0.3s ease;
        }

        .rounded-pill:hover {
            transform: translateY(-1px);
        }

        .btn-floating {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1.25rem;
    border-radius: 8px;
    transition: all 0.2s ease;
    border: none;
    font-size: 0.875rem;
}

.btn-floating i {
    font-size: 0.9rem;
    transition: transform 0.2s ease;
}

.btn-save {
    background: #3b82f6;
    color: white;
    box-shadow: 0 2px 4px rgba(59, 130, 246, 0.1);
}

.btn-cancel {
    background: #f8fafc;
    color: #64748b;
    border: 1px solid #e2e8f0;
}

.btn-save:hover {
    background: #2563eb;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(59, 130, 246, 0.2);
}

.btn-cancel:hover {
    background: #e2e8f0;
    transform: translateY(-1px);
}

.btn-floating:hover i {
    transform: scale(1.05);
}
    </style>
@endsection
