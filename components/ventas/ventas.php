<link rel="stylesheet" href="components/ventas/assets/ventas.css">

<section id="ventas">
  




<div class="d-flex justify-content-start mb-3">
    <button id="btnNuevaVenta" class="btn btn-primary">+ Nueva venta</button>
  </div>
    <select id="filtroVendedor" class="form-select form-select-sm">
      <option value="">Todos los vendedores</option>
    </select>
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
    </div>
  </div>
</section>

<script src="components/ventas/assets/ventas.js"></script>
