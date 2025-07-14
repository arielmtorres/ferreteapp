<link rel="stylesheet" href="components/ventas/nueva/ventas-nueva.css">

<section id="nueva-venta" class="mb-5">
  <!-- 1) Cabecera Pro forma -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="m-0">PRO FORMA</h4>
    <button id="btnImprimir" class="btn btn-success">Imprimir ticket</button>
  </div>

  <!-- 2) Cliente y fecha -->
  <div class="row g-3 mb-4">
    <div class="col-md-6">
      <label for="cliente" class="form-label">Cliente</label>
      <input type="text" id="cliente" class="form-control" placeholder="Nombre del cliente">
    </div>
    <div class="col-md-6">
      <label for="fecha" class="form-label">Fecha</label>
      <input type="date" id="fecha" class="form-control">
    </div>
  </div>

  <!-- 3) Búsqueda, cantidad, costo y botón Adjuntar -->
  <div class="input-group mb-4">
    <input type="text" id="busquedaProducto" class="form-control" placeholder="Buscar producto…">
    <button class="btn btn-outline-secondary" type="button" id="btnBuscarProd">🔍</button>
    <select id="selectCant" class="form-select" style="max-width: 80px;">
      <?php for($i=1;$i<=20;$i++): ?>
        <option value="<?= $i ?>"><?= $i ?></option>
      <?php endfor; ?>
    </select>
    <span class="input-group-text">$</span>
    <input type="text" id="inputCosto" class="form-control" placeholder="Costo unit.">
    <button class="btn btn-primary" type="button" id="btnAdjuntar">Adjuntar</button>
  </div>

  <!-- 4) Detalle del artículo seleccionado -->
  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <label class="form-label">Producto</label>
      <input type="text" id="detProducto" class="form-control" readonly>
    </div>
    <div class="col-md-2">
      <label class="form-label">Ubicación</label>
      <input type="text" id="detUbicacion" class="form-control" readonly>
    </div>
    <div class="col-md-2">
      <label class="form-label">Cant.</label>
      <input type="text" id="detCantidad" class="form-control" readonly>
    </div>
    <div class="col-md-2">
      <label class="form-label">Costo</label>
      <input type="text" id="detCosto" class="form-control" readonly>
    </div>
    <div class="col-md-2 d-flex align-items-end">
      <div>
        <label class="form-label d-block">Total</label>
        <h5 id="proformaTotal" class="m-0">$0</h5>
      </div>
    </div>
  </div>

  <!-- 5) Tabla final de la venta -->
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
      <tbody>
        <!-- Filas que agregará JS -->
      </tbody>
    </table>
  </div>
</section>

<!-- Lógica JS específica -->
<script src="../../components/ventas/ventas-nueva.js"></script>
