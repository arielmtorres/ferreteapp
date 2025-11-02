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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">





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


    <div class="header-right">
      <span>usuario</span>
      <img src="img/usuario.png" alt="Usuario" class="logo-header" 
          onerror="this.onerror=null;this.src='https://cdn-icons-png.flaticon.com/512/149/149071.png';" />
    </div>
  </header>

  <div class="container">


<div id="movimientos-section" class="container py-4">

<?php
session_start(); // 👈 iniciar sesión
require '../db/db.php';

$success = $_SESSION['success'] ?? null;
$error = $_SESSION['error'] ?? null;

// Limpiar las variables de sesión para que no aparezcan siempre
unset($_SESSION['success'], $_SESSION['error']);




$editarIngreso = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_ingreso'])) {
    $id = (int)$_POST['id_ingreso'];
    $stmt = $pdo->prepare("SELECT * FROM ingresos WHERE id_ingreso = ?");
    $stmt->execute([$id]);
    $editarIngreso = $stmt->fetch(PDO::FETCH_ASSOC);
}


?>

    <?php if ($success): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertSuccess">
        <?php 
                    if ($success === "insert-ingreso") echo "Ingreso agregado correctamente.";
                    elseif ($success === "update-ingreso") echo "Ingreso actualizado correctamente.";
                    elseif ($success === "delete-ingreso") echo "Ingreso eliminado correctamente.";
                    elseif ($success === "insert-egreso") echo "Egreso agregado correctamente.";
                    elseif ($success === "update-egreso") echo "Egreso actualizado correctamente.";
                    elseif ($success === "delete-egreso") echo "Egreso eliminado correctamente.";

                    elseif ($success === "insert-categoria-egreso") echo "Categoria de egreso agregada correctamente.";
                    elseif ($success === "update-categoria-egreso") echo "Categoria de egreso actualizada correctamente.";
                    elseif ($success === "delete-categoria-egreso") echo "Categoria de egreso eliminada correctamente.";

                   elseif ($success === "insert-categoria-ingreso") echo "Categoria de ingreso agregada correctamente.";
                    elseif ($success === "update-categoria-ingreso") echo "Categoria de ingreso actualizada correctamente.";
                    elseif ($success === "delete-categoria-ingreso") echo "Categoria de ingreso eliminada correctamente.";
                    
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertError">
                <?php echo htmlspecialchars($error); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>




  <!-- Título principal -->
  <h2 class="mb-5">Ingresos y Egresos</h2>


  <!-- Tabla de Ingresos -->
 <?php include 'assets/php/ingresos/getIngresos.php'; ?>

<section class=" mb-5" >
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div class="d-flex align-items-center gap-2">
      <i class="bi bi-cash-stack fs-4 text-success"></i>
      <h3 class="mb-0 fw-semibold text-dark">Ingresos</h3>
    </div>

    <button type="button" class="btn btn-success btn-sm d-flex align-items-center gap-1">
      <i class="bi bi-plus-lg"></i> Agregar Ingreso
    </button>
  </div>



  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead class="table-light text-center">
        <tr>
          <th>Fecha</th>
          <th>Categoría</th>
          <th>Descripción</th>
          <th>Monto</th>
          <th>Responsable</th>
          <th>Factura</th>
          <th>Método de pago</th>
          <th>Acciones</th>
        </tr>
      </thead>

      <tbody class="text-center">
        <?php if (!empty($ingresos)): ?>
          <?php foreach ($ingresos as $row): ?>
              <tr>
                  <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                  <td><?php echo htmlspecialchars($row['categoria']); ?></td>
                  <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                  <td>$<?php echo number_format($row['monto'], 2); ?></td>
                  <td><?php echo htmlspecialchars($row['responsable']); ?></td>
                  <td><?php echo $row['nro_factura'] ?: "-"; ?></td>
                  <td><?php echo htmlspecialchars($row['metodo_pago']); ?></td>
                  <td>
                      <!-- Botón de Editar -->
                      
                      <!-- Botón -->
                    <button 
                      class="btn btn-warning btn-sm btn-editar-ingreso" 
                      data-id="<?php echo $row['id_ingreso']; ?>">
                      Editar
                    </button>







                      <a href="/ferreteapp/components/egresosEingresos/assets/php/ingresos/deleteIngreso.php?id=<?php echo $row['id_ingreso']; ?>" 
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Seguro quieres eliminar este ingreso?');">
                          Eliminar
                      </a>

                  </td>
              </tr>
          <?php endforeach; ?>
      <?php else: ?>
          <tr><td colspan="8">No hay ingresos registrados.</td></tr>
      <?php endif; ?>


      </tbody>

    </table>
  </div>

</section>


  <!-- Tabla de Egresos -->
<!-- ======== EGRESOS ======== -->
 <?php include 'assets/php/egresos/getEgresos.php'; ?>
<section class="mb-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">💸 Egresos</h3>
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEgreso">
      + Agregar Egreso
    </button>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead class="table-light text-center">
        <tr>
          <th>Fecha</th>
          <th>Categoría</th>
          <th>Descripción</th>
          <th>Monto</th>
          <th>Responsable</th>
          <th>Factura</th>
          <th>Método de pago</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php if (isset($errorMsg)): ?>
          <tr><td colspan="8">Error: <?php echo htmlspecialchars($errorMsg); ?></td></tr>

        <?php elseif (empty($egresos)): ?>
          <tr><td colspan="8">No hay egresos registrados.</td></tr>

        <?php else: ?>
          <?php foreach ($egresos as $row): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['fecha']); ?></td>
              <td><?php echo htmlspecialchars($row['categoria']); ?></td>
              <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
              <td>$<?php echo number_format($row['monto'], 2); ?></td>
              <td><?php echo htmlspecialchars($row['responsable']); ?></td>
              <td><?php echo $row['nro_factura'] ?: "-"; ?></td>
              
              <td><?php echo htmlspecialchars($row['metodo_pago']); ?></td>
              <td>
                <button 
                  class="btn btn-warning btn-sm btn-editar-egreso" 
                  data-id="<?php echo $row['id_egreso']; ?>">
                  Editar
                </button>

                <a href="/ferreteApp/components/egresosEingresos/assets/php/egresos/deleteEgreso.php?id=<?php echo $row['id_egreso']; ?>" 
                  class="btn btn-danger btn-sm"
                  onclick="return confirm('¿Seguro que deseas eliminar este egreso?');">
                  Eliminar
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</section>

 <?php include 'assets/php/categoriaIngreso/getCategoriasIngresos.php'; ?>
<section class="mb-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">📈 Categorías de Ingresos</h3>
    <button class="btn btn-success btn-sm" id="btnAgregarCategoriaIngreso">+ Agregar Categoría</button>

  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover" id="tabla-categorias-ingresos">
      <thead class="table-light text-center">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Responsable</th>
          <th>Acciones</th>
          
        </tr>
      </thead>
      <tbody class="text-center">
        <?php
        // Traemos los datos usando el archivo que hace la consulta
       
        

        if (!empty($categorias)) {
          foreach ($categorias as $cat) {
              echo '
                  <tr>
                      <td>'.$cat['id_categoria_ingreso'].'</td>
                      <td>'.$cat['nombre'].'</td>
                      <td>'.$cat['descripcion'].'</td>
                      <td>'.($cat['responsable'] ?? 'Sin responsable').'</td>

                      <td>
                        <button class="btn btn-warning btn-sm" onclick="editarCategoria('.$cat['id_categoria_ingreso'].')">Editar</button>
                        <a href="/ferreteApp/components/egresosEingresos/assets/php/categoriaIngreso/deleteCategoriaIngreso.php?id='.$cat['id_categoria_ingreso'].'" 
                          class="btn btn-danger btn-sm"
                          onclick="return confirm(\'¿Seguro que deseas eliminar esta categoría?\');">
                          Borrar
                        </a>
                      </td>
                  </tr>
              ';
          }
      } else {
          echo '<tr><td colspan="5">No hay categorías registradas</td></tr>';
      }

        ?>
      </tbody>
    </table>
  </div>
</section>




<section class="mb-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">📉 Categorías de Egresos</h3>
    <button class="btn btn-success btn-sm"  id="btnAgregarCategoriaEgreso">+ Agregar Categoría</button>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover" id="tabla-categorias-egresos">
      <thead class="table-light text-center">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Responsable</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php include 'assets/php/categoriaEgreso/getCategoriasEgresos.php'; ?>



        <?php
          if (!empty($categoriasEgreso)) {
              foreach ($categoriasEgreso as $cat) {
                  echo '<tr data-id="' . $cat['id_categoria_egreso'] . '">
                          <td>' . $cat['id_categoria_egreso'] . '</td>
                          <td>' . $cat['nombre'] . '</td>
                          <td>' . $cat['descripcion'] . '</td>
                          <td>' . ($cat['responsable'] ?? 'Sin responsable') . '</td>
                          <td>
                              <button class="btn btn-warning btn-sm" onclick="editarCategoriaEgreso(' . $cat['id_categoria_egreso'] . ')">Editar</button>
                              <button class="btn btn-danger btn-sm" onclick="borrarCategoriaEgreso(' . $cat['id_categoria_egreso'] . ')">Borrar</button>
                          </td>
                      </tr>';
              }
          } else {
              echo "<tr><td colspan='5'>No hay categorías registradas</td></tr>";
          }
          ?>

      </tbody>
    </table>
  </div>
</section>





<!--------------------------------------- MODALS ------------------------------>

<!-- Modal Ingresos -->
<!-- Modal Ingresos (Agrega y Edita) -->
<div class="modal fade" id="modalIngreso" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formIngreso" action="/ferreteapp/components/egresosEingresos/assets/php/ingresos/saveIngreso.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModal">Agregar Ingreso</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="id_ingreso" name="id_ingreso">

          <div class="mb-3">
            <label>Categoría</label>
            <select class="form-control" name="id_categoria_ingreso" id="id_categoria_ingreso" required>
              <option value="">Seleccionar</option>
              <?php
              $stmt = $pdo->query("SELECT id_categoria_ingreso, nombre FROM categorias_ingresos ORDER BY nombre ASC");
              while($cat = $stmt->fetch(PDO::FETCH_ASSOC)){
                  echo "<option value='{$cat['id_categoria_ingreso']}'>{$cat['nombre']}</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label>Concepto</label>
            <input type="text" class="form-control" name="descripcion" id="descripcion" required>
          </div>

          <div class="mb-3">
            <label>Monto</label>
            <input type="number" step="0.01" class="form-control" name="monto" id="monto" required>
          </div>

          <div class="mb-3">
            <label>Responsable</label>
            <select class="form-control" name="id_usuario" id="id_usuario" required>
              <option value="">Seleccionar</option>
              <?php
              $stmt = $pdo->query("SELECT id_usuario, user FROM usuarios ORDER BY user ASC");
              while($u = $stmt->fetch(PDO::FETCH_ASSOC)){
                  echo "<option value='{$u['id_usuario']}'>{$u['user']}</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label>Método de pago</label>
            <input type="text" class="form-control" name="metodo_pago" id="metodo_pago">
          </div>

          <div class="mb-3">
            <label>Factura</label>
            <input type="text" class="form-control" name="nro_factura" id="nro_factura">
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal Egresos (Agrega y Edita) -->
<div class="modal fade" id="modalEgreso" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formEgreso" action="/ferreteApp/components/egresosEingresos/assets/php/egresos/saveEgreso.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModalEgreso">Agregar Egreso</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="id_egreso" name="id_egreso">

          <div class="mb-3">
            <label>Categoría</label>
            <select class="form-control" name="id_categoria_egreso" id="id_categoria_egreso" required>
              <option value="">Seleccionar</option>
              <?php
              $stmt = $pdo->query("SELECT id_categoria_egreso, nombre FROM categorias_egresos ORDER BY nombre ASC");
              while($cat = $stmt->fetch(PDO::FETCH_ASSOC)){
                  echo "<option value='{$cat['id_categoria_egreso']}'>{$cat['nombre']}</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label>Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion_egreso" required></textarea>
          </div>

          <div class="mb-3">
            <label>Monto</label>
            <input type="number" step="0.01" class="form-control" name="monto" id="monto_egreso" required>
          </div>

          <div class="mb-3">
            <label>Responsable</label>
            <select class="form-control" name="id_usuario" id="id_usuario_egreso" required>
              <option value="">Seleccionar</option>
              <?php
              $stmt = $pdo->query("SELECT id_usuario, user FROM usuarios ORDER BY user ASC");
              while($u = $stmt->fetch(PDO::FETCH_ASSOC)){
                  echo "<option value='{$u['id_usuario']}'>{$u['user']}</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label>Método de pago</label>
            <select class="form-control" name="metodo_pago" id="metodo_pago_egreso" required>
              <option value="">Seleccionar</option>
              <option value="Efectivo">Efectivo</option>
              <option value="Transferencia">Transferencia</option>
            </select>
          </div>

          <div class="mb-3">
            <label>N° de factura</label>
            <input type="text" class="form-control" name="nro_factura" id="nro_factura_egreso">
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="btnGuardarEgreso">Guardar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Categoría Ingreso -->
<div class="modal fade" id="modalCategoriaIngreso" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formCategoriaIngreso" action="/ferreteApp/components/egresosEingresos/assets/php/categoriaIngreso/saveCategoriaIngreso.php" method="POST">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModalCategoriaIngreso">Agregar Categoría</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_categoria_ingreso" id="id_categoria_ingreso">
          <div class="mb-3">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre_categoria" required>
          </div>
          <div class="mb-3">
            <label>Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion_categoria"></textarea>
          </div>
          <div class="mb-3">
          <label>Responsable</label>
          <select class="form-control" name="id_usuario" id="id_usuario_categoria" required>
            <option value="">Seleccionar</option>
            <?php
            $stmt = $pdo->query("SELECT id_usuario, user FROM usuarios ORDER BY user ASC");
            while ($u = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo "<option value='{$u['id_usuario']}'>{$u['user']}</option>";
            }
            ?>
          </select>
        </div>
        </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="btnGuardarCategoria">Guardar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
        
      </div>
    </form>
  </div>
</div>


<!-- Modal Categoría Egreso -->
<div class="modal fade" id="modalCategoriaEgreso" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formCategoriaEgreso" action="/ferreteApp/components/egresosEingresos/assets/php/categoriaEgreso/saveCategoriaEgreso.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModalCategoriaEgreso">Agregar Categoría</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_categoria_egreso" id="id_categoria_egreso_modal">

          <div class="mb-3">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre_categoria_egreso" required>
          </div>

          <div class="mb-3">
            <label>Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion_categoria_egreso"></textarea>
          </div>

          <div class="mb-3">
            <label>Responsable</label>
            <select class="form-control" name="id_usuario" id="id_usuario_categoria_egreso" required>
              <option value="">Seleccionar</option>
              <?php
              $stmt = $pdo->query("SELECT id_usuario, user FROM usuarios ORDER BY user ASC");
              while ($u = $stmt->fetch(PDO::FETCH_ASSOC)){
                  echo "<option value='{$u['id_usuario']}'>{$u['user']}</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="btnGuardarCategoriaEgreso">Guardar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
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
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>





<link rel="stylesheet" href="assets/css/style.css">

<script src="/ferreteApp/components/egresosEingresos/assets/js/ingreso.js"></script>




</body>
</html>
