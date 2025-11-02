<br>
<center><h2>Bienvenido</h2></center>
<br>
<section id="inicio">
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
<br><br>
</section>
<br><br>
<!-- Tabla de Productos -->
 <section class="mb-5">

  <!-- Botón azul + Nueva Venta -->
  

  <!-- Barra de búsqueda y botón de escanear QR -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <input type="text" class="form-control me-2" placeholder="🔍 Buscar producto..." id="busqueda-producto" style="max-width: 80%; ">
    <button class="btn btn-outline-primary "  > Escanear QR</button>
    <button class="btn btn-primary">+ Nueva Venta</button>
  </div>

  <!-- Tabla de productos -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover" id="tabla-productos">
      <thead class="table-light text-center">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Marca</th>
          <th>Categoría</th>
          <th>Precio</th>
          <th>Ubicación</th>
          <th>QR</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <tr>
          <td>PROD-001</td>
          <td>Taladro 500W</td>
          <td>Black+Decker</td>
          <td>Herramientas eléctricas</td>
          <td>$8,500</td>
          <td>A1</td>
          <td>
            <button class="btn btn-outline-secondary btn-sm">📱 Ver QR</button>
          </td>
          <td>
            <button class="btn btn-sm btn-warning">Editar</button>
            <button class="btn btn-sm btn-danger">Borrar</button>
          </td>
        </tr>
        <tr>
          <td>PROD-002</td>
          <td>Llave francesa 10”</td>
          <td>Tramontina</td>
          <td>Herramientas manuales</td>
          <td>$2,100</td>
          <td>B2</td>
          <td>
            <button class="btn btn-outline-secondary btn-sm">📱 Ver QR</button>
          </td>
          <td>
            <button class="btn btn-sm btn-warning">Editar</button>
            <button class="btn btn-sm btn-danger">Borrar</button>
          </td>
        </tr>
        <tr>
          <td>PROD-003</td>
          <td>Cinta métrica 5m</td>
          <td>Irwin</td>
          <td>Medición</td>
          <td>$900</td>
          <td>C3</td>
          <td>
            <button class="btn btn-outline-secondary btn-sm">📱 Ver QR</button>
          </td>
          <td>
            <button class="btn btn-sm btn-warning">Editar</button>
            <button class="btn btn-sm btn-danger">Borrar</button>
          </td>
        </tr>
        <tr>
          <td>PROD-004</td>
          <td>Destornillador Philips</td>
          <td>Stanley</td>
          <td>Herramientas manuales</td>
          <td>$1,200</td>
          <td>D4</td>
          <td>
            <button class="btn btn-outline-secondary btn-sm">📱 Ver QR</button>
          </td>
          <td>
            <button class="btn btn-sm btn-warning">Editar</button>
            <button class="btn btn-sm btn-danger">Borrar</button>
          </td>
        </tr>

      </tbody>
    </table>
  </div>
</section>


</section>


<!-- Modal: Ver Código QR -->
<div class="modal fade" id="modal-ver-qr" tabindex="-1" aria-labelledby="modalVerQRLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="modalVerQRLabel">📱 Código QR del Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <!-- Contenedor donde se generará el código QR -->
        <div id="contenedor-qr" class="d-flex justify-content-center mb-3"></div>
        <p class="small text-muted">Este código QR puede ser escaneado para identificar el producto.</p>
      </div>
      <div class="modal-footer bg-light">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

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
<br><br>


<style>
  /* Fondo general */
  body {
    background-color: #e9e9e9;
    font-family: "Segoe UI", Arial, sans-serif;
    color: #333;
  }

 

 


  /* Tabla */
  .table-container {
    border-radius: 12px;
    overflow-x: auto;
  }

  .table {
    width: 100%;
    border-collapse: separate; /* permite espacio entre filas */
    border-spacing: 0 10px; /* separa las filas */
    background-color: transparent;
  }


/* Header moderno y minimalista */
.table thead th {
  background-color: #fafafa; /* fondo muy claro y limpio */
  color: #333; /* gris oscuro para contraste */
  font-weight: 600;
  font-size: 0.9rem;
  text-align: left;
  padding: 16px 18px;
  border-bottom: 1px solid #e0e0e0; /* línea fina y elegante */
  letter-spacing: 0.5px; /* un toque de separación */
}

/* Opcional: efecto sutil al pasar el mouse sobre el header */
.table thead th:hover {
  background-color: #f2f2f2;
}


  .table tbody tr {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
  }

  .table tbody tr:hover {
    background-color: #f9f9f9;
    transform: scale(1.01);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .table td {
    padding: 14px 16px;
    border: none; /* quitamos bordes entre celdas */
  }

  /* Bordes redondeados en las esquinas de cada fila */
  .table tbody tr:first-child td:first-child {
    border-top-left-radius: 10px;
  }
  .table tbody tr:first-child td:last-child {
    border-top-right-radius: 10px;
  }
  .table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 10px;
  }
  .table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 10px;
  }

  /* Botones dentro de la tabla */
  .btn {
    border-radius: 8px;
    font-size: 0.85rem;
    padding: 6px 12px;
  }

  .btn-warning {
    background-color: #ffb300;
    color: #fff;
    border: none;
  }

  .btn-warning:hover {
    background-color: #ffa000;
  }

  .btn-danger {
    background-color: #e53935;
    color: #fff;
    border: none;
  }

  .btn-danger:hover {
    background-color: #d32f2f;
  }






















  
</style>