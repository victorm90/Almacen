@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
    <main id="main" class="main">
        <div class="pagetitle mb-4">
            <h1 class="fw-bold text-primary">Gestión de Usuarios</h1>
        </div>
        
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-bottom">
                            <h5 class="card-title mb-0 text-secondary">
                                <i class="fas fa-users-cog me-2"></i>Listado de Usuarios
                            </h5>
                            <a href="{{ route('usuarios.create') }}" class="btn btn-primary rounded-pill">
                                <i class="fa-solid fa-user-plus me-2"></i>Nuevo
                            </a>
                        </div>
        
                        <div class="card-body pt-4">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Rol</th>
                                            <th class="text-center" style="width: 12%">Password</th>
                                            <th class="text-center" style="width: 10%">Estado</th>
                                            <th class="text-center" style="width: 15%">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-usuarios" class="border-top-0">
                                        @include('modules.usuarios.tbody')
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Opcional: Footer con estadísticas -->
                        <div class="card-footer bg-light">
                            <div class="text-muted small">
                                <span class="me-3"><i class="fas fa-database me-1"></i> Total registros: {{ $estadisticas->total }}</span>
                                <span class="me-3"><i class="fas fa-check-circle text-success me-1"></i> Activos: {{ $estadisticas->activos }}</span>
                                <span><i class="fas fa-times-circle text-danger me-1"></i> Inactivos:{{ $estadisticas->inactivos }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    @include('modules.usuarios.modal_cambiar_password')
@endsection

@push('scripts')
    <script>
        function recargar_tbody() {
            $.ajax({
                type: "GET",
                url: "{{ route('usuarios.tbody') }}",
                success: function(respuesta) {
                    console.log(respuesta);
                }
            });
        }

        function cambiar_estado(id, estado) {
            $.ajax({
                type: "GET",
                url: "usuarios/cambiar-estado/" + id + "/" + estado,
                success: function(respuesta) {
                    if (respuesta == 1) {
                        Swal.fire({
                            title: 'Exito!',
                            text: 'Cambio de estado exitoso!',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        });
                        recargar_tbody();
                    } else {
                        Swal.fire({
                            title: 'Fallo!',
                            text: 'No se llevo a cabo el cambio!',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                }
            });
        }

        function agregar_id_usuario(id) {
            $('#id_usuario').val(id);
        }

        function cambio_password() {
            let id = $('#id_usuario').val();
            let password = $('#password').val();

            $.ajax({
                type: "GET",
                url: "usuarios/cambiar-password/" + id + "/" + password,
                success: function(respuesta) {
                    if (respuesta == 1) {
                        Swal.fire({
                            title: 'Exito!',
                            text: 'Cambio de password exitoso!',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        });
                        $('#frmPassword')[0].reset();
                    } else {
                        Swal.fire({
                            title: 'Fallo!',
                            text: 'Cambio de password no exitoso!',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                }
            });

            return false;
        }

        $(document).ready(function() {
            $('.form-check-input').on("change", function() {
                let id = $(this).attr("id");
                let estado = $(this).is(":checked") ? 1 : 0;
                cambiar_estado(id, estado);
            });
        });
    </script>
@endpush
