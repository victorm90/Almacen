@extends('layouts.login')

@section('contenido')
<main class="login-page">
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7">
                        <!-- Logo -->
                        <div class="text-center mb-5">
                            <a href="" class="logo">                                
                                <h2 class="text-primary fw-bold">Gestión de Almacén</h2>
                            </a>
                        </div>

                        <!-- Tarjeta de Login -->
                        <div class="card shadow-lg">
                            <div class="card-body p-5">
                                <!-- Encabezado -->
                                <div class="text-center mb-2">
                                    <img src="{{ asset('img/login.jpg') }}" alt="Logo" class="img-fluid mb-1" style="max-height: 70px;">
                                    <h3 class="card-title mb-2 fw-bold text-gradient">Bienvenido</h3>
                                    <p class="text-muted">Ingrese sus credenciales para continuar</p>
                                </div>

                                <!-- Formulario -->
                                <form class="needs-validation" novalidate method="POST" action="{{ route('logear') }}">
                                    @csrf
                                    <!-- Usuario -->
                                    <div class="mb-4">
                                        <label for="email" class="form-label">Usuario</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="bi bi-person-fill text-primary"></i>
                                            </span>
                                            <input type="email" name="email" class="form-control border-start-0" 
                                                   id="email" placeholder="usuario@ejemplo.com" required>
                                        </div>
                                    </div>

                                    <!-- Contraseña -->
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between">
                                            <label for="password" class="form-label">Contraseña</label>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="bi bi-lock-fill text-primary"></i>
                                            </span>
                                            <input type="password" name="password" class="form-control border-start-0" 
                                                   id="password" placeholder="••••••••" required>
                                        </div>
                                    </div>

                                    <!-- Botón Submit -->
                                    <button class="btn btn-primary w-100 py-2 mb-3 fw-bold" type="submit">
                                        Iniciar Sesión
                                        <i class="bi bi-arrow-right-short ms-2"></i>
                                    </button>

                                    <!-- Errores -->
                                    @if($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <ul class="mb-0">
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>

                        <!-- Créditos -->
                        <div class="text-center mt-4">
                            <p class="text-muted small">
                                Desarrollado por 
                                <a href="https://pourvous.cu/" target="_blank" class="text-decoration-none text-primary">
                                    PorVouseCode
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<style>
    .login-page {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .card {
        border-radius: 1rem;
        border: none;
        transition: transform 0.3s;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    .text-gradient {
        background: linear-gradient(45deg, #0d6efd, #00c4ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .input-group-text {
        transition: all 0.3s;
    }
    
    .form-control:focus {
        box-shadow: none;
        border-color: #0d6efd;
    }
    
    .form-control {
        padding: 0.75rem 1rem;
        transition: all 0.3s;
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #0d6efd, #0b5ed7);
        border: none;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }
</style>
@endsection
