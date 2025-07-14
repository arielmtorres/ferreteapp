<link rel="stylesheet" href="components/ventas/assets/nueva.css">

<section id="nueva-venta" class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="m-0">🧾 PRO FORMA</h4>
    <div class="d-flex gap-2">
      <button id="btnImprimir" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTicket">Imprimir ticket</button>
      <button id="btnCancelarVenta" class="btn btn-secondary">Cancelar</button>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-md-6">
      <label for="busquedaProducto" class="form-label">Buscar producto (manual o QR)</label>
      <input type="text" id="busquedaProducto" class="form-control" placeholder="Ej: Tornillo">
    </div>
    <div class="col-md-3">
      <label for="selectCant" class="form-label">Cantidad</label>
      <select id="selectCant" class="form-select"></select>
    </div>
    <div class="col-md-3">
      <label for="inputCosto" class="form-label">Costo unitario</label>
      <input type="number" id="inputCosto" class="form-control" min="0" placeholder="Precio $">
    </div>
    <div class="col-12 text-end">
      <!-- Botón que abre el modal de búsqueda QR/URL -->
      <button id="btnBuscarProd" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalScanOrSearchQR">🔍 Buscar / QR</button>
      <button id="btnAdjuntar" class="btn btn-secondary">+ Adjuntar</button>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <label class="form-label">Producto</label>
      <input type="text" id="detProducto" class="form-control" readonly>
    </div>
    <div class="col-md-4">
      <label class="form-label">Ubicación</label>
      <input type="text" id="detUbicacion" class="form-control" readonly>
    </div>
    <div class="col-md-2">
      <label class="form-label">Cantidad</label>
      <input type="text" id="detCantidad" class="form-control" readonly>
    </div>
    <div class="col-md-2">
      <label class="form-label">Costo</label>
      <input type="text" id="detCosto" class="form-control" readonly>
    </div>
  </div>

  <div class="table-responsive mb-4">
    <table class="table table-bordered" id="tablaVenta">
      <thead class="table-light">
        <tr>
          <th>Producto</th>
          <th>Ubicación</th>
          <th>Cantidad</th>
          <th>Costo</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <div class="text-end fs-4 fw-bold">
    Total: <span id="proformaTotal">$0</span>
  </div>

  <!-- Modal ticket -->
  <div class="modal fade" id="modalTicket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">🧾 Ticket Pro Forma</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p><strong>Cliente:</strong> Juan Pérez</p>
          <p><strong>Fecha:</strong> <?= date("d/m/Y") ?></p>
          <p><strong>Total:</strong> <span id="totalModalTicket">$0</span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="window.print()">Confirmar imprimir</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de selección Buscar QR/Leer QR -->
  <div class="modal fade" id="modalScanOrSearchQR" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title">Buscar o Leer QR</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <div class="d-grid gap-2 mb-3">
            <button id="btnLeerQR" class="btn btn-primary btn-lg">Leer QR (con cámara)</button>
          </div>
          <div id="qr-reader" style="width: 100%; max-width: 340px; margin: 0 auto; display:none"></div>
          <div id="qrJsonDisplay" class="mt-3" style="display: none;">
            <h6>Datos leídos del QR:</h6>
            <textarea id="jsonContentArea" class="form-control" rows="8" readonly></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" id="btnAceptarQRData" class="btn btn-success" style="display: none;">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Bootstrap JS y QR -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="components/ventas/assets/html5-qrcode.min.js"></script>

<script src="components/ventas/assets/nueva.js"></script>
