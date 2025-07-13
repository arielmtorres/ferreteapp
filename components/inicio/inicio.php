

<section id="inicio">
  <div class="d-flex gap-2 my-3">
    <button id="btnNuevaVenta"    class="btn btn-primary">+ Nueva venta</button>
    <button id="btnIngresarStock" class="btn btn-secondary">+ Ingresar stock</button>
  </div>

  <div class="input-group mb-3">
    <input type="text" id="searchInput" class="form-control" placeholder="Buscar producto…">
    <button id="btnBuscar"     class="btn btn-outline-secondary">🔍</button>
    <button id="btnQrScanner" class="btn btn-outline-secondary">📷</button>
  </div>

  <table class="table table-bordered">
    <thead class="table-light">
      <tr>
        <th>Nombre</th><th>Ubicación</th><th>Cantidad</th><th>Precio</th>
      </tr>
    </thead>
    <tbody id="stockTableBody">
      <!-- Se llenará vía JS -->
    </tbody>
  </table>
</section>
