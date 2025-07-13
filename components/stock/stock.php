<div id="stock-section" class="container py-4">

  <!-- Título principal -->
  <h2 class="mb-4">Gestión de Stock</h2>

<!-- Sección: Stock Actual -->
<section id="stock-actual" class="mb-5">
  <h3 class="mb-3">📦 Stock Actual</h3>
  <div class="input-group mb-3">
    <input type="text" id="search-stock" class="form-control" placeholder="Buscar producto...">
    <button class="btn btn-outline-primary" id="btn-buscar-stock">Buscar</button>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-hover" id="tabla-stock-actual">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Nombre del Producto</th>
          <th>Cantidad</th>
          <th>Marca</th>
          <th>Ubicación</th> <!-- NUEVA COLUMNA -->
        </tr>
      </thead>
      <tbody>
        <tr><td>001</td><td>Martillo de acero</td><td>25</td><td>Tramontina</td><td>Estante A1</td></tr>
        <tr><td>002</td><td>Taladro eléctrico 500W</td><td>8</td><td>Black+Decker</td><td>Estante B3</td></tr>
        <tr><td>003</td><td>Juego de llaves Allen</td><td>40</td><td>Stanley</td><td>Estante C2</td></tr>
        <tr><td>004</td><td>Destornillador plano</td><td>50</td><td>Bahco</td><td>Estante A2</td></tr>
        <tr><td>005</td><td>Cinta métrica 5m</td><td>30</td><td>Irwin</td><td>Estante D1</td></tr>
      </tbody>
    </table>
  </div>
</section>


  <!-- Sección: Facturas de Ingreso -->
  <section id="facturas-section" class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="mb-0">🧾 Facturas de Ingreso</h3>
      <button class="btn btn-success btn-sm">+ Agregar Factura</button>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="tabla-facturas">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Proveedor</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>F-1001</td>
            <td>Ferremax</td>
            <td>2025-07-10</td>
            <td>$15,000</td>
            <td class="text-center"><button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-detalle-factura">Ver Detalle</button></td>
          </tr>
          <tr>
            <td>F-1002</td>
            <td>Herramientas SRL</td>
            <td>2025-07-08</td>
            <td>$8,600</td>
            <td class="text-center"><button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-detalle-factura">Ver Detalle</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Modal de Detalle de Factura -->
  <div class="modal fade" id="modal-detalle-factura" tabindex="-1" aria-labelledby="detalleFacturaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detalleFacturaLabel">Detalle de Factura</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <table class="table table-sm table-bordered">
            <thead class="table-light">
              <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody id="tabla-detalle-factura-body">
              <tr><td>Martillo de acero</td><td>10</td><td>$500</td><td>$5,000</td></tr>
              <tr><td>Cinta métrica 5m</td><td>20</td><td>$300</td><td>$6,000</td></tr>
              <tr><td>Taladro eléctrico</td><td>2</td><td>$2,000</td><td>$4,000</td></tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" id="btn-editar-factura">Editar</button>
          <button type="button" class="btn btn-danger" id="btn-borrar-factura">Borrar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

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

</div>
