<link rel="stylesheet" href="components/ventas/assets/ventas.css">
<section class="mb-5">
   
    <div class="d-flex justify-content-between align-items-center mb-3 pt-4">
      <h3 class="mb-0">💵 Ventas</h3>
    </div>
<div class="container ventas-container">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-5">
    <div class="d-flex align-items-center gap-2">
      <button id="btnNuevaVenta" class="btn btn-success btn-sm">+ Nueva venta</button>
      <select id="filtroVendedor" class="form-select form-select-sm" style="width:auto;min-width:200px;">
        <option value="">Todos los vendedores</option>
      </select>
    </div>
    <div class="d-flex align-items-center gap-2 export-actions">
      <button id="btnExportPDF" class="btn btn-outline-danger btn-sm">PDF</button>
      <button id="btnExportExcel" class="btn btn-outline-success btn-sm">Excel</button>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Historial de ventas</h5>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped mb-0">
        <thead class="table-light">
          <tr>
            <th>Vendedor</th>
            <th>Productos</th>
            <th>Total</th>
            <th>Detalle</th>
          </tr>
        </thead>
        <tbody id="ventasTableBody"></tbody>
      </table>
      <div id="paginacionVentas" class="d-flex justify-content-center align-items-center mt-3 gap-2"></div>
    </div>
  </div>
</section>

<script src="components/ventas/assets/ventas.js"></script>
