<?php
// includes/header.php

?><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FerreteApp - Gestión de Stock</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>




  <link rel="stylesheet" href="/ferreteApp/css/style.css" />
</head>
<body>
  <header>
    <div class="header-left">
      <img src="/ferreteApp/img/headerlogo.png" alt="Logo" class="logo-header" />
    </div>

    <button class="menu-toggle" aria-label="Abrir menú">
      ☰
    </button>

    <div class="user-menu" id="userMenu">
      <?php ?>
        <nav class="menu">
          <a href="/ferreteApp/#/inicio"     class="btn btn-link">Inicio</a>
          <a href="/ferreteApp/#/caja"  class="btn btn-link">Caja</a>
          <a href="/ferreteApp/#/productos"  class="btn btn-link">Productos</a>
          <a href="/ferreteApp/#/stock"      class="btn btn-link">Stock</a>
          <a href="/ferreteApp/components/egresosEingresos/egresosEingresos.php"  class="btn btn-link">Egresos/Ingresos</a>
          <a href="/ferreteApp/#/ventas"     class="btn btn-link">Ventas</a>
          <a href="/ferreteApp/#/reportes"   class="btn btn-link">Reportes</a>
          <a href="/ferreteApp/components/usuarios/usuarios.php"   class="btn btn-link">Usuarios</a>
        </nav>

    </div>
  </header>

  <div class="container">



<br><br>
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
            <tbody>
                <?php include 'assets/php/getUsuarios.php'; ?>
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario['id_usuario']; ?></td>
                            <td><?php echo htmlspecialchars($usuario['user']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                            <td><?php echo $usuario['rol'] === 'ADMIN' ? 'Administrador' : 'Empleado'; ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning" onclick="editarUsuario(<?php echo $usuario['id_usuario']; ?>)">Editar</button>
                                <button class="btn btn-sm btn-danger" onclick="borrarUsuario(<?php echo $usuario['id_usuario']; ?>)">Borrar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No hay usuarios registrados</td></tr>
                <?php endif; ?>
                </tbody>

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
            <input type="hidden" id="idUsuario">

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
                <option value="Administrador">ADMINISTRADOR</option>
                <option value="Empleado">EMPLEADO</option>
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




  </div> <!-- /.container -->
  <!-- Scripts bootstrap -->
  
  <script>
    document.querySelector('.menu-toggle').addEventListener('click', () => {
      document.getElementById('userMenu').classList.toggle('open');
    });
  </script>

  



<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<!-- Librerías varias -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>

<!-- Tus scripts -->

<script src="/ferreteApp/components/reportes/assets/script.js"></script>
<script src="/ferreteApp/components/ventas/assets/ventas.js"></script>
<script src="/ferreteApp/components/ventas/assets/nueva.js"></script>
<script src="/ferreteApp/components/ventas/assets/imprimir.js"></script>








<script src="/ferreteApp/components/usuarios/assets/js/usuario.js"></script>