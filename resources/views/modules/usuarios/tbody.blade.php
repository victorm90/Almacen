@foreach ($items as $item)
    <tr>
        <td class="fw-medium text-center">{{ $item->id }}</td>
        <td class="fw-medium text-center">{{ $item->email }}</td>
        <td class="fw-medium text-center">{{ $item->name }}</td>
        <td>{{ $item->rol }}</td>
        <td>
            <a href="#" onclick="agregar_id_usuario({{ $item->id }})" class="btn btn-secondary"
                data-bs-toggle="modal" data-bs-target="#cambiar_password">
                <i class="fa-solid fa-user-lock"></i>
            </a>
        </td>
        <td class="text-center">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="{{ $item->id }}"
                    {{ $item->activo ? 'checked' : '' }}>
            </div>
        </td>
        <td>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal"
                data-user-id="{{ $item->id }}" data-user-name="{{ $item->name }}"
                data-user-email="{{ $item->email }}" data-user-rol="{{ $item->rol }}">
                <i class="fa-solid fa-user-pen"></i>
            </button>
            {{-- <a href="{{ route("usuarios.edit", $item->id) }}" class="btn btn-warning">
        <i class="fa-solid fa-user-pen"></i>
        </a> --}}

        </td>
    </tr>
@endforeach

<!-- Modal de Edición (fuera del foreach pero dentro del tbody) -->
<!-- Modal de Edición -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="editUserId">

                    <div class="mb-3">
                        <label for="editName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="editRol" class="form-label">Rol</label>
                        <select class="form-select" id="editRol" name="rol" required>
                            <option value="admin">Admin</option>
                            <option value="cajero">Cajero</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Configuración del modal corregida
document.addEventListener('DOMContentLoaded', function() {
    const editModal = document.getElementById('editUserModal');
    
    editModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        
        // Obtener datos del botón
        const userId = button.dataset.userId;
        const userName = button.dataset.userName;
        const userEmail = button.dataset.userEmail;
        const userRol = button.dataset.userRol;

        // Actualizar formulario
        document.getElementById('editUserId').value = userId;
        document.getElementById('editName').value = userName;
        document.getElementById('editEmail').value = userEmail;
        document.getElementById('editRol').value = userRol;

        // Actualizar acción del formulario
        const actionUrl = "{{ route('usuarios.update', ['id' => ':id']) }}".replace(':id', userId);
        document.getElementById('editUserForm').action = actionUrl;
        
        console.log('Datos cargados:', {userId, userName, userEmail, userRol}); // Para depuración
    });
});
</script>
