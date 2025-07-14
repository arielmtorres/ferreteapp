<br>
<center><h2>Bienvenido</h2></center>
<br>
<section id="inicio">
<!-- Bajo stock -->
  <div class="col-md-12">
      <div class="card border-warning shadow-sm">
        <div class="card-body">
          <h5 class="card-title text-warning">⚠️ Productos con Bajo Stock</h5>
          <ul class="mb-0">
            <li>Destornillador plano – 3 unidades</li>
            <li>Disco de corte 4½" – 5 unidades</li>
            <li>Llave francesa – 2 unidades</li>
          </ul>
        </div>
      </div>
    </div>
<br><br>
<!-- Sección: Proveedores -->
  <section id="proveedores-section">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="mb-0">🏭 Proveedores</h3>
      <button class="btn btn-success btn-sm">+ Agregar Proveedor</button>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="tabla-proveedores">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Ubicación</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>PR-001</td>
            <td>Ferremax</td>
            <td>Proveedor mayorista de herramientas</td>
            <td>Ciudad Autónoma de Buenos Aires</td>
            <td class="text-center">
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
          <tr>
            <td>PR-002</td>
            <td>Herramientas SRL</td>
            <td>Distribuidor especializado en ferretería</td>
            <td>Rosario, Santa Fe</td>
            <td class="text-center">
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

<br><br>
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

</section>


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

<!-- Sección: Detalle de Movimientos -->
  <section>
    <h3 class="mb-3">📋 Detalle de Movimientos de Caja Actual</h3>
    <div class="table-responsive">
      <table class="table table-sm table-bordered align-middle text-center" id="tabla-movimientos-caja">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Tipo</th>
            <th>Descripción</th>
            <th>Monto</th>
            <th>Hora</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Ingreso</td>
            <td>Venta mostrador - Factura #1234</td>
            <td>$5,000</td>
            <td>09:15</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Ingreso</td>
            <td>Venta mostrador - Factura #1235</td>
            <td>$7,000</td>
            <td>12:30</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Egreso</td>
            <td>Compra de repuestos</td>
            <td>$1,200</td>
            <td>14:10</td>
          </tr>
          <tr>
            <td>4</td>
            <td>Egreso</td>
            <td>Gastos menores</td>
            <td>$2,000</td>
            <td>16:45</td>
          </tr>
        </tbody>
        <tfoot class="table-light text-end">
          <tr>
            <th colspan="3" class="text-end">Total Ingresos:</th>
            <th class="text-success text-center" colspan="2">$12,000</th>
          </tr>
          <tr>
            <th colspan="3" class="text-end">Total Egresos:</th>
            <th class="text-danger text-center" colspan="2">$3,200</th>
          </tr>
          </tfoot>
      </table>
    </div>

    <!-- Total en Caja -->
    <div class="d-flex justify-content-end mt-3">
      <div class="card border-success" style="min-width: 250px;">
        <div class="card-body text-center">
          <h6 class="card-title fw-bold mb-1">💵 Total en Caja</h6>
          <p class="card-text fs-5 text-success mb-0">$8,800</p>
        </div>
      </div>
    </div>
  </section>
<br><br>
