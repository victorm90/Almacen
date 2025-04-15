<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="editUserModalLabel">
                    <i class="fas fa-user-edit me-2"></i>Editar Usuario
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="editUserId">
                    <div class="row g-4">
                        <!-- Campos del formulario -->
                        <div class="col-md-6">
                            <label for="editName" class="form-label fw-medium text-muted mb-2">
                                Nombre completo <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg rounded-3" 
                                   id="editName" name="name" required>
                        </div>

                        <div class="col-md-6">
                            <label for="editEmail" class="form-label fw-medium text-muted mb-2">
                                Correo electrónico <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control form-control-lg rounded-3" 
                                   id="editEmail" name="email" required>
                        </div>

                        <div class="col-md-6">
                            <label for="editRol" class="form-label fw-medium text-muted mb-2">
                                Rol del usuario <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-lg rounded-3" 
                                    id="editRol" name="rol" required>
                                <option value="admin">Administrador</option>
                                <option value="cajero">Cajero</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-lg btn-outline-secondary rounded-pill" 
                            data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-lg btn-warning rounded-pill">
                        <i class="fas fa-save me-2"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>