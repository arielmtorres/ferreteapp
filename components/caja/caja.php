<div id="caja-section" class="container py-4">

  <!-- Título principal -->
  <h2 class="mb-4">Gestión de Caja</h2>

  <!-- Sección: Tabla de Cierres -->
  <section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="mb-0">💰 Cierres de Caja</h3>
      <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-cierre-caja">+ Registrar Cierre</button>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="tabla-cierre-caja">
        <thead class="table-light">
          <tr>
            <th>Fecha</th>
            <th>Ingresos</th>
            <th>Egresos</th>
            <th>Total Final</th>
            <th>Responsable</th>
            <th>Observaciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2025-07-12</td>
            <td>$12,000</td>
            <td>$3,200</td>
            <td>$8,800</td>
            <td>Juan Pérez</td>
            <td>Venta del día, reposición de stock</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

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


  <!-- Modal: Confirmar Cierre de Caja -->
  <div class="modal fade" id="modal-cierre-caja" tabindex="-1" aria-labelledby="modalCierreCajaLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="modalCierreCajaLabel">🧾 Confirmar Cierre de Caja</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <div class="modal-body">
          <p>¿Estás seguro de que querés cerrar la caja actual?</p>
          <p class="text-muted mb-1">Este cierre registrará los ingresos y egresos actuales con el usuario responsable.</p>
          <div class="mb-3">
            <label for="responsableCierre" class="form-label fw-semibold">Responsable</label>
            <input type="text" class="form-control" id="responsableCierre" placeholder="Nombre del responsable" required>
          </div>
          <div class="mb-2">
            <label for="observacionesCierre" class="form-label fw-semibold">Observaciones</label>
            <textarea class="form-control" id="observacionesCierre" rows="2"></textarea>
          </div>
        </div>

        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-success">Confirmar Cierre</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>
