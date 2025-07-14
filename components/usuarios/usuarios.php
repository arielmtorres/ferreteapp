<!-- Sección: Gestión de Usuarios -->
<section id="usuarios-section" class="mb-5">
  <!-- Título y botón -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">👥 Gestión de Usuarios</h3>
    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-agregar-usuario">+ Agregar Usuario</button>
  </div>

  <!-- Buscador -->
  <div class="input-group mb-3">
    <input type="text" id="buscar-usuario" class="form-control" placeholder="Buscar por nombre, email o rol...">
    <button class="btn btn-outline-primary" id="btn-buscar-usuario">Buscar</button>
  </div>

  <!-- Tabla de usuarios -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover" id="tabla-usuarios">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Rol</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>U-001</td>
          <td>Juan Pérez</td>
          <td>juan@example.com</td>
          <td>Administrador</td>
          <td class="text-center">
            <button class="btn btn-sm btn-warning">Editar</button>
            <button class="btn btn-sm btn-danger">Borrar</button>
          </td>
        </tr>
        <tr>
          <td>U-002</td>
          <td>Lucía Gómez</td>
          <td>lucia@example.com</td>
          <td>Empleado</td>
          <td class="text-center">
            <button class="btn btn-sm btn-warning">Editar</button>
            <button class="btn btn-sm btn-danger">Borrar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

<!-- Modal: Agregar Usuario -->
<div class="modal fade" id="modal-agregar-usuario" tabindex="-1" aria-labelledby="modalAgregarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalAgregarUsuarioLabel">➕ Agregar Usuario</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <form id="form-usuario">
        <div class="modal-body">
          <div class="mb-3">
            <label for="nombreUsuario" class="form-label fw-semibold">Nombre</label>
            <input type="text" class="form-control" id="nombreUsuario" required>
          </div>
          <div class="mb-3">
            <label for="emailUsuario" class="form-label fw-semibold">Email</label>
            <input type="email" class="form-control" id="emailUsuario" required>
          </div>
          <div class="mb-3">
            <label for="rolUsuario" class="form-label fw-semibold">Rol</label>
            <select class="form-select" id="rolUsuario" required>
              <option value="" disabled selected>Seleccionar</option>
              <option value="Administrador">Administrador</option>
              <option value="Empleado">Empleado</option>
            </select>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="submit" class="btn btn-success">Guardar Usuario</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>
