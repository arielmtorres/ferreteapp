<div id="productos-section" class="container py-4">


  <!-- Título principal -->
  <h2 class="mb-4">🛠️ Productos</h2>

  <!-- Tabla de Productos -->
  <section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="mb-0">📋 Lista de Productos</h3>
      <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-producto">+ Agregar Producto</button>
    </div>

    <div class="table-responsive">
    <table class="table table-bordered table-hover" id="tabla-productos">
    <thead class="table-light text-center">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Marca</th>
      <th>Categoría</th>
      <th>Precio</th>
      <th>Ubicación</th> <!-- 🔹 NUEVA COLUMNA -->
      <th>QR</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody class="text-center">
    <tr>
      <td>PROD-001</td>
      <td>Taladro 500W</td>
      <td>Black+Decker</td>
      <td>Herramientas eléctricas</td>
      <td>$8,500</td>
      <td>A1</td> <!-- 🔹 NUEVO VALOR -->
      <td>
        <button class="btn btn-outline-secondary btn-sm">📱 Ver QR</button>
      </td>
      <td>
        <button class="btn btn-sm btn-warning">Editar</button>
        <button class="btn btn-sm btn-danger">Borrar</button>
      </td>
    </tr>
    <tr>
      <td>PROD-002</td>
      <td>Llave francesa 10”</td>
      <td>Tramontina</td>
      <td>Herramientas manuales</td>
      <td>$2,100</td>
      <td>B2</td> <!-- 🔹 NUEVO VALOR -->
      <td>
        <button class="btn btn-outline-secondary btn-sm">📱 Ver QR</button>
      </td>
      <td>
        <button class="btn btn-sm btn-warning">Editar</button>
        <button class="btn btn-sm btn-danger">Borrar</button>
      </td>
    </tr>
    <tr>
      <td>PROD-003</td>
      <td>Cinta métrica 5m</td>
      <td>Irwin</td>
      <td>Medición</td>
      <td>$900</td>
      <td>C3</td> <!-- 🔹 NUEVO VALOR -->
      <td>
        <button class="btn btn-outline-secondary btn-sm">📱 Ver QR</button>
      </td>
      <td>
        <button class="btn btn-sm btn-warning">Editar</button>
        <button class="btn btn-sm btn-danger">Borrar</button>
      </td>
    </tr>
  </tbody>
</table>

    </div>
  </section>

  <!-- Tabla de Categorías de Productos -->
  <section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="mb-0">🏷️ Categorías de Productos</h3>
      <button class="btn btn-success btn-sm">+ Agregar Categoría</button>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="tabla-categorias-productos">
        <thead class="table-light text-center">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <tr>
            <td>CAT-PROD-001</td>
            <td>Herramientas eléctricas</td>
            <td>Productos con alimentación eléctrica o batería</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
          <tr>
            <td>CAT-PROD-002</td>
            <td>Herramientas manuales</td>
            <td>Herramientas de uso manual sin motor</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
          <tr>
            <td>CAT-PROD-003</td>
            <td>Medición</td>
            <td>Instrumentos de medición y precisión</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Modal: Agregar/Editar Producto -->
<div class="modal fade" id="modal-producto" tabindex="-1" aria-labelledby="modalProductoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalProductoLabel">➕ Agregar Producto</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <form id="form-producto">
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label for="productoNombre" class="form-label fw-semibold">Nombre del Producto</label>
              <input type="text" class="form-control" id="productoNombre" required>
            </div>
            <div class="col-md-6">
              <label for="productoMarca" class="form-label fw-semibold">Marca</label>
              <input type="text" class="form-control" id="productoMarca" required>
            </div>
            <div class="col-md-4">
              <label for="productoCategoria" class="form-label fw-semibold">Categoría</label>
              <select class="form-select" id="productoCategoria" required>
                <option value="" disabled selected>Seleccionar...</option>
                <option>Herramientas eléctricas</option>
                <option>Herramientas manuales</option>
                <option>Medición</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="productoPrecio" class="form-label fw-semibold">Precio</label>
              <input type="number" class="form-control" id="productoPrecio" min="0" step="0.01" required>
            </div>
            <div class="col-md-4">
              <label for="productoQR" class="form-label fw-semibold">Código QR (opcional)</label>
              <input type="text" class="form-control" id="productoQR" placeholder="Se puede autogenerar">
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer bg-light">
        <button type="submit" class="btn btn-success" form="form-producto">Guardar Producto</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal: Ver Código QR -->
<div class="modal fade" id="modal-ver-qr" tabindex="-1" aria-labelledby="modalVerQRLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="modalVerQRLabel">📱 Código QR del Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <!-- Contenedor donde se generará el código QR -->
        <div id="contenedor-qr" class="d-flex justify-content-center mb-3"></div>
        <p class="small text-muted">Este código QR puede ser escaneado para identificar el producto.</p>
      </div>
      <div class="modal-footer bg-light">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


</div>

