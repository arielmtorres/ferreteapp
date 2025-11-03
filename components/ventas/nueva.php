<link rel="stylesheet" href="components/ventas/assets/nueva.css">

<section id="nueva-venta" class="container py-3">
  <div class="ticket-factura mx-auto mb-4 p-4 shadow-sm bg-light">
    <div class="text-center mb-3">
      <h4 class="mb-1">🧾 TICKET Pro forma</h4>
      <small class="text-muted">FERRETE APP</small>
      <hr class="my-2">
    </div>

    <!-- Buscar producto y QR -->
    <div class="d-flex align-items-end mb-3 gap-2">
      <div class="flex-fill">
        <label for="busquedaProducto" class="form-label mb-1">Buscar producto</label>
        <input type="text" id="busquedaProducto" class="form-control form-control-sm" placeholder="Ej: Tornillo">
      </div>
      <button id="btnBuscarProd" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalScanOrSearchQR" title="Buscar o leer QR">
        <i class="bi bi-qr-code-scan"></i>
      </button>
      <button id="btnAdjuntar" class="btn btn-secondary btn-sm ms-1">+ Adjuntar</button>
    </div>
    <div class="row gx-1 mb-3">
      <div class="col-5">
        <label for="selectCant" class="form-label mb-1">Cantidad</label>
        <select id="selectCant" class="form-select form-select-sm"></select>
      </div>
      <div class="col-7">
        <label for="inputCosto" class="form-label mb-1">Costo unitario</label>
        <input type="number" id="inputCosto" class="form-control form-control-sm" min="0" placeholder="Precio $">
      </div>
    </div>

   

<!-- Cabecera de Factura Pro Forma -->
<div class="row g-3 mb-2">
  <div class="col-md-3">
    <label class="form-label">N° Ticket </label>
    <input type="text" id="facturaNumeroInput" class="form-control" placeholder="0001-00001234">
  </div>
  <div class="col-md-3">
    <label class="form-label">Fecha</label>
    <input type="date" id="ticketFecha" class="form-control" value="<?= date('Y-m-d') ?>">
  </div>
  <div class="col-md-3">
    <label class="form-label">Cliente</label>
    <input type="text" id="ticketCliente" class="form-control" placeholder="Nombre del cliente">
  </div>
 <div class="col-md-3">
  <label class="form-label">Vendedor</label>
  <select id="ticketVendedor" class="form-select">
    <option value="">Seleccionar vendedor</option>
    <option>Ariel</option>
    <option>Lara</option>
    <option>Teo</option>
    <option>Pablo</option>
    <option>Nicolas</option>
    <option>Romina</option>
    <option>Samantha</option>
    <option>Jonathan</option>
    <option>Federico</option>
    <option>Yanina</option>
    <option>Guillermo</option>
    <option>Jose</option>
    <option>Antonio</option>
    <option>Barbara</option>
  </select>
</div>

  <div class="col-12 mt-2">
    <label class="form-label">Observaciones</label>
    <textarea id="ticketObservaciones" class="form-control" rows="2" placeholder="Observaciones..."></textarea>
  </div>
</div>

<div class="table-responsive mb-3">
  <table class="table table-bordered table-sm" id="detalleProductosTabla">
    <thead class="table-light">
      <tr>
        <th>Producto</th>
        <th>Ubicación</th>
        <th>Cant.</th>
        <th>Unitario</th>
        <th>Subtotal</th>
        <th>Quitar</th>
      </tr>
    </thead>
    <tbody id="detalleProductosBody"></tbody>
  </table>
</div>


    <div class="d-flex justify-content-end align-items-center mb-2 mt-2 border-top pt-2">
      <span class="fw-bold">Total:&nbsp;</span>
      <span id="proformaTotal" class="fs-5 text-success">$0</span>
    </div>

    <div class="d-flex justify-content-between align-items-center gap-2 mt-3">
      <button id="btnImprimir" class="btn btn-success flex-fill" data-bs-toggle="modal" data-bs-target="#modalTicket">
        <i class="bi bi-save"></i> Guardar / <i class="bi bi-printer"></i> Imprimir
      </button>
      <button id="btnCancelarVenta" class="btn btn-secondary flex-fill">
        <i class="bi bi-x-circle"></i> Cancelar
      </button>
    </div>
  </div>

  <!-- Modal ticket -->
 <!-- MODAL TICKET PRO FORMA -->
<div class="modal fade" id="modalTicket" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content factura-modal-content">
      <div class="modal-header bg-primary text-white py-2">
        <h5 class="modal-title">🧾 Ticket Pro Forma</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="factura-imprimir mx-auto">
          <!-- ENCABEZADO FACTURA -->
          <div class="text-center mb-2">
            <h5 class="fw-bold mb-1">FERRETE APP</h5>
            <div class="mb-1 small text-muted">Ticket Pro Forma N° <span id="facturaNumero">0001-00001234</span></div>
            <div class="mb-1 small text-muted">Fecha de emisión: <span id="ticketFechaPreview"></span></div>
          </div>
          <!-- DATOS CLIENTE Y VENDEDOR -->
          <div class="mb-2 d-flex justify-content-between">
            <div><strong>Cliente:</strong> <span id="ticketClientePreview"></span></div>
            <div><strong>Vendedor:</strong> <span id="ticketVendedorPreview"></span></div>
          </div>
          <!-- OBSERVACIONES -->
          <div class="mb-2">
            <strong>Observaciones:</strong>
            <div class="border rounded px-2 py-1 small" id="ticketObsPreview" style="min-height:24px"></div>
          </div>
          <!-- DETALLE DE PRODUCTOS -->
          <div class="table-responsive mb-2">
            <table class="table table-bordered table-sm mb-0">
              <thead class="table-light">
                <tr class="small text-center">
                  <th>Producto</th>
                  <th>Ubicación</th>
                  <th>Cant.</th>
                  <th>Unitario</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody id="tablaVentaTicket"></tbody>
            </table>
          </div>
          <div class="text-end mt-2 fs-5 fw-bold">
            Total: <span id="totalModalTicket">$0</span>
          </div>
        </div>
      </div>
      <div class="modal-footer d-print-none">
        <button type="button" class="btn btn-primary" onclick="window.print()">
          <i class="bi bi-printer"></i> Imprimir
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="bi bi-x"></i> 
        </button>
      </div>
    </div>
  </div>
</div>






<!-- Modal QR -->
<div class="modal fade" id="modalScanOrSearchQR" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Buscar o Leer QR</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <div class="d-grid gap-2 mb-3">
          <button id="btnLeerQR" class="btn btn-primary btn-lg">
            <i class="bi bi-qr-code-scan"></i> Leer QR (con cámara)
          </button>
        </div>
        <div id="qr-reader" style="width: 100%; max-width: 500px; margin: 0 auto; display:none"></div>
        <div id="qrJsonDisplay" class="mt-3" style="display: none;">
          <h6>Datos leídos del QR:</h6>
          <textarea id="jsonContentArea" class="form-control" rows="12" readonly></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="btnAceptarQRData" class="btn btn-success" style="display: none;">Aceptar</button>
      </div>
    </div>
  </div>
</div>


<!-- MODAL IMAGEN TEMPORAL -->
<div class="modal fade" id="modalImagenTemporal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content border-0 bg-transparent shadow-none">
      <div class="modal-body text-center p-0">
        <img id="imgTemporal" src="components/ventas/assets/losgenios.png"
             alt="Comprobante"
             class="img-fluid rounded img-modal-temporal"
             style="max-width:1200px; width:100%;">
      </div>
    </div>
  </div>
</div>



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

