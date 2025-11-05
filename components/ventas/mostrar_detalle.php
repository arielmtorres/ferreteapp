<!-- components/ventas/mostrar_detalle.php -->
<link rel="stylesheet" href="components/ventas/assets/ventas.css">

<div class="card p-4">
  <div class="d-flex justify-content-between align-items-start mb-4">
    <div>
      <h4 class="mb-0">🧾 Detalle de venta</h4>
      <small class="text-muted">FERRETE APP</small>
    </div>
    <button id="btnVolverVentas" class="btn btn-outline-secondary btn-sm">← Volver</button>
  </div>

  <div id="infoVenta" class="mb-3"></div>

  <div class="table-responsive mb-3">
    <table class="table table-bordered" id="tablaItemsVenta">
      <thead class="table-primary">
        <tr>
          <th>#</th>
          <th>Producto</th>
          <th>Cant.</th>
          <th>Unitario</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <div class="d-flex justify-content-between align-items-center">
    <div>
      <button id="btnExportPDF" class="btn btn-outline-danger btn-sm">📄 Exportar PDF</button>
    </div>
    <div>
      <span class="fw-bold me-2">Total:</span>
      <span id="totalVentaDetalle" class="fw-bold text-success fs-5">$0</span>
    </div>
  </div>
</div>

<script src="components/ventas/assets/mostrar_detalle.js"></script>
