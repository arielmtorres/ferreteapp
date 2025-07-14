<section id="estadisticas" class="my-5">
  <h2 class="mb-4">📊 Estadísticas</h2>
  <div class="row g-4">


    <!-- Total productos -->
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title">📦 Productos en Stock</h5>
          <p class="fs-3 fw-bold text-primary">362</p>
        </div>
      </div>
    </div>

    <!-- Compras del mes -->
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title">🚚 Compras del Mes</h5>
          <p class="fs-3 fw-bold text-success">$48,700</p>
        </div>
      </div>
    </div>

    <!-- Total en facturas -->
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title">💰 Total Facturado</h5>
          <p class="fs-3 fw-bold text-danger">$192,000</p>
        </div>
      </div>
    </div>

    <!-- Producto más comprado -->
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title">🔩 Producto Más Comprado</h5>
          <p class="fs-5 fw-semibold text-dark">Cinta Métrica 5m</p>
          <p class="text-muted">Vendidas: 122 unidades</p>
        </div>
      </div>
    </div>

    <!-- Facturas del mes -->
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title">🧾 Facturas Ingresadas</h5>
          <p class="fs-3 fw-bold">14</p>
          <p class="text-muted">Últimos 30 días</p>
        </div>
      </div>
    </div>

    <!-- Proveedores activos -->
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title">🏭 Proveedores Activos</h5>
          <p class="fs-3 fw-bold">5</p>
        </div>
      </div>
    </div>

    <!-- Bajo stock -->
    <div class="col-md-12">
      <div class="card border-warning shadow-sm">
        <div class="card-body">
          <h5 class="card-title text-warning">⚠️ Productos con Bajo Stock</h5>
          <ul class="mb-0">
            <li>Destornillador plano – 3 unidades</li>
            <li>Disco de corte 4½" – 5 unidades</li>
            <li>Llave francesa – 2 unidades</li>
          </ul>
        </div>
      </div>
    </div>

  </div>

  <!-- Gráficos -->
<div class="row mt-5">
  <!-- Productos más comprados -->
  <div class="col-md-6 mb-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title">📊 Top 5 Productos Más Comprados</h5>
        <canvas id="graficoProductosMasComprados"></canvas>
      </div>
    </div>
  </div>

  <!-- Stock por categoría -->
  <div class="col-md-6 mb-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title">📦 Stock por Categoría</h5>
        <canvas id="graficoStockCategorias"></canvas>
      </div>
    </div>
  </div>

  <!-- Gastos por proveedor -->
  <div class="col-12 mb-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title">💸 Gastos por Proveedor (últimos 30 días)</h5>
        <canvas id="graficoGastosProveedor"></canvas>
      </div>
    </div>
  </div>
</div>



</section>




