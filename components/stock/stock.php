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
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-agregar-factura">+ Agregar Factura</button>
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



<!-- Modal de Detalle de Factura -->
<div class="modal fade" id="modal-detalle-factura" tabindex="-1" aria-labelledby="detalleFacturaLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="detalleFacturaLabel">🧾 Detalle de Factura</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">

        <!-- Datos generales de la factura -->
        <div class="mb-4">
          <h6 class="fw-bold">Información de la Factura</h6>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label fw-semibold">Nº de Factura</label>
              <p class="form-control-plaintext">F-1001</p>
            </div>
            <div class="col-md-4">
              <label class="form-label fw-semibold">Proveedor</label>
              <p class="form-control-plaintext">Ferremax</p>
            </div>
            <div class="col-md-4">
              <label class="form-label fw-semibold">Fecha de Emisión</label>
              <p class="form-control-plaintext">2025-07-10</p>
            </div>
            <div class="col-md-4">
              <label class="form-label fw-semibold">Tipo de Pago</label>
              <p class="form-control-plaintext">Transferencia Bancaria</p>
            </div>
            <div class="col-md-4">
              <label class="form-label fw-semibold">Remito</label>
              <p class="form-control-plaintext">RMT-2345</p>
            </div>
            <div class="col-md-4">
              <label class="form-label fw-semibold">Total</label>
              <p class="form-control-plaintext">$15,000</p>
            </div>
            <div class="col-12">
              <label class="form-label fw-semibold">Observaciones</label>
              <p class="form-control-plaintext">Ingreso de herramientas para reposición de stock general.</p>
            </div>
          </div>
        </div>

        <!-- Tabla de productos -->
        <h6 class="fw-bold mb-2">Productos Incluidos</h6>
        <div class="table-responsive">
          <table class="table table-sm table-bordered align-middle">
            <thead class="table-light text-center">
              <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody id="tabla-detalle-factura-body" class="text-center">
              <tr><td>1</td><td>Martillo de acero</td><td>10</td><td>$500</td><td>$5,000</td></tr>
              <tr><td>2</td><td>Cinta métrica 5m</td><td>20</td><td>$300</td><td>$6,000</td></tr>
              <tr><td>3</td><td>Taladro eléctrico</td><td>2</td><td>$2,000</td><td>$4,000</td></tr>
            </tbody>
            <tfoot class="table-light text-end">
              <tr>
                <th colspan="4">Total:</th>
                <th>$15,000</th>
              </tr>
            </tfoot>
          </table>
        </div>

      </div>

      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-warning" id="btn-editar-factura">Editar</button>
        <button type="button" class="btn btn-danger" id="btn-borrar-factura">Eliminar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Agregar Factura -->
<div class="modal fade" id="modal-agregar-factura" tabindex="-1" aria-labelledby="modalAgregarFacturaLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalAgregarFacturaLabel">➕ Agregar Factura</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <!-- Datos de la factura -->
        <form id="form-agregar-factura">
          <div class="row g-3 mb-4">
            <div class="col-md-4">
              <label for="numeroFactura" class="form-label fw-semibold">Nº de Factura</label>
              <input type="text" class="form-control" id="numeroFactura" required>
            </div>
            <div class="col-md-4">
              <label for="proveedor" class="form-label fw-semibold">Proveedor</label>
              <select class="form-select" id="proveedor" required>
                <option value="" selected disabled>Seleccionar</option>
                <option>Ferremax</option>
                <option>Herramientas SRL</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="fechaFactura" class="form-label fw-semibold">Fecha</label>
              <input type="date" class="form-control" id="fechaFactura" required>
            </div>
            <div class="col-md-4">
              <label for="tipoPago" class="form-label fw-semibold">Tipo de Pago</label>
              <select class="form-select" id="tipoPago" required>
                <option value="" selected disabled>Seleccionar</option>
                <option>Contado</option>
                <option>Transferencia</option>
                <option>Cheque</option>
                <option>Crédito</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="remito" class="form-label fw-semibold">Nº de Remito</label>
              <input type="text" class="form-control" id="remito">
            </div>
            <div class="col-12">
              <label for="observaciones" class="form-label fw-semibold">Observaciones</label>
              <textarea class="form-control" id="observaciones" rows="2"></textarea>
            </div>
          </div>

          <!-- Agregar productos -->
          <h6 class="fw-bold">Productos de la Factura</h6>
          <div class="row g-2 align-items-end mb-3">
            <div class="col-md-5">
              <label class="form-label">Producto</label>
              <input type="text" class="form-control" id="productoNombre">
            </div>
            <div class="col-md-2">
              <label class="form-label">Cantidad</label>
              <input type="number" class="form-control" id="productoCantidad" min="1">
            </div>
            <div class="col-md-3">
              <label class="form-label">Precio Unitario</label>
              <input type="number" class="form-control" id="productoPrecio" min="0" step="0.01">
            </div>
            <div class="col-md-2 text-end">
              <button type="button" class="btn btn-outline-primary w-100" id="btn-agregar-producto">+ Agregar</button>
            </div>
          </div>

          <div class="table-responsive mb-3">
            <table class="table table-sm table-bordered align-middle text-center" id="tabla-productos-agregados">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Precio Unitario</th>
                  <th>Subtotal</th>
                  <th>Eliminar</th>
                </tr>
              </thead>
              <tbody>
                <!-- Productos añadidos dinámicamente -->
              </tbody>
              <tfoot class="table-light">
                <tr>
                  <th colspan="4" class="text-end">Total:</th>
                  <th colspan="2" id="totalFactura">$0.00</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </form>
      </div>

      <div class="modal-footer bg-light">
        <button type="submit" class="btn btn-success" form="form-agregar-factura">Guardar Factura</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


</div>
