<?php
// === CONEXIÓN PDO ===
include(__DIR__ . "/../db/db.php");
?>

<div id="stock-section" class="container py-4">

  <!-- Título principal -->
  <h2 class="mb-4">Gestión de Stock</h2>

  <!-- Sección: Stock Actual -->
  <section id="stock-actual" class="mb-5">
    <h3 class="mb-3">📦 Stock Actual</h3>

    <div class="input-group mb-3">
      <input type="text" id="search-stock" class="form-control" placeholder="Buscar producto...">
      <button class="btn btn-outline-primary" id="btn-buscar-stock">Buscar</button>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="tabla-stock-actual">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Nombre del Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Ubicación</th>
          </tr>
        </thead>
        <tbody>
          <?php
          try {
            $stmt = $pdo->query("
              SELECT 
                p.id_producto,
                p.nombre,
                p.precio,
                COALESCE(SUM(cr.cantidad_comprada),0) -
                COALESCE((SELECT SUM(it.cantidad) FROM items_factura it WHERE it.id_producto = p.id_producto),0) AS stock_actual
              FROM productos p
              LEFT JOIN compras_renovacion cr ON p.id_producto = cr.id_producto
              GROUP BY p.id_producto, p.nombre, p.precio
              ORDER BY p.nombre ASC
            ");
            $productos = $stmt->fetchAll();

            if ($productos) {
              foreach ($productos as $p) {
                $color = ($p['stock_actual'] <= 5) ? "text-danger fw-bold" : (($p['stock_actual'] <= 15) ? "text-warning" : "text-success");
                echo "
                <tr>
                  <td>{$p['id_producto']}</td>
                  <td>{$p['nombre']}</td>
                  <td class='{$color}'>{$p['stock_actual']}</td>
                  <td>$" . number_format($p['precio'], 2) . "</td>
                  <td>Depósito</td>
                </tr>";
              }
            } else {
              echo "<tr><td colspan='5' class='text-center'>No hay productos registrados</td></tr>";
            }
          } catch (PDOException $e) {
            echo "<tr><td colspan='5' class='text-danger'>Error al cargar productos: {$e->getMessage()}</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </section>


  <!-- Sección: Facturas de Ingreso -->
  <section id="facturas-section" class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">🧾 Facturas de Ingreso</h3>
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-agregar-factura">+ Agregar Factura</button>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="tabla-facturas">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          try {
            $stmt = $pdo->query("SELECT id_factura, tipo, fecha, monto_total FROM facturas ORDER BY fecha DESC");
            $facturas = $stmt->fetchAll();

            if ($facturas) {
              foreach ($facturas as $f) {
                echo "
                <tr>
                  <td>F-{$f['id_factura']}</td>
                  <td>{$f['tipo']}</td>
                  <td>{$f['fecha']}</td>
                  <td>$" . number_format($f['monto_total'], 2) . "</td>
                  <td class='text-center'>
                    <button class='btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#modal-detalle-factura' data-id='{$f['id_factura']}'>Ver Detalle</button>
                  </td>
                </tr>";
              }
            } else {
              echo "<tr><td colspan='5' class='text-center'>No hay facturas registradas</td></tr>";
            }
          } catch (PDOException $e) {
            echo "<tr><td colspan='5' class='text-danger'>Error al cargar facturas: {$e->getMessage()}</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </section>


  <!-- Sección: Proveedores -->
  <section id="proveedores-section">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="mb-0">🏭 Proveedores</h3>
      <button class="btn btn-success btn-sm">+ Agregar Proveedor</button>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="tabla-proveedores">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Fecha de Alta</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          try {
            $stmt = $pdo->query("SELECT * FROM proveedores ORDER BY nombre ASC");
            $proveedores = $stmt->fetchAll();

            if ($proveedores) {
              foreach ($proveedores as $pr) {
                echo "
                <tr>
                  <td>PR-{$pr['id_proveedor']}</td>
                  <td>{$pr['nombre']}</td>
                  <td>{$pr['descripcion']}</td>
                  <td>{$pr['fecha_creacion']}</td>
                  <td class='text-center'>
                    <button class='btn btn-sm btn-warning'>Editar</button>
                    <button class='btn btn-sm btn-danger'>Borrar</button>
                  </td>
                </tr>";
              }
            } else {
              echo "<tr><td colspan='5' class='text-center'>No hay proveedores cargados</td></tr>";
            }
          } catch (PDOException $e) {
            echo "<tr><td colspan='5' class='text-danger'>Error al cargar proveedores: {$e->getMessage()}</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </section>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const modal = new bootstrap.Modal(document.getElementById("modal-detalle-factura"));
  const tablaBody = document.getElementById("tabla-detalle-factura-body");

  document.querySelectorAll("[data-bs-target='#modal-detalle-factura']").forEach(btn => {
    btn.addEventListener("click", async () => {
      const facturaId = btn.getAttribute("data-id");
      tablaBody.innerHTML = "<tr><td colspan='5'>Cargando...</td></tr>";

      try {
        const response = await fetch(`components/stock/get_detalle_factura.php?id=${facturaId}`);
        const data = await response.json();

        if (data.error) {
          tablaBody.innerHTML = `<tr><td colspan='5' class='text-danger'>${data.error}</td></tr>`;
          return;
        }

        // Datos de cabecera
        document.querySelector("#detalleFacturaLabel").textContent = `🧾 Detalle de Factura F-${data.factura.id_factura}`;
        document.querySelector("#modal-detalle-factura .form-control-plaintext:nth-of-type(1)").textContent = "F-" + data.factura.id_factura;
        document.querySelector("#modal-detalle-factura .form-control-plaintext:nth-of-type(2)").textContent = data.factura.tipo;
        document.querySelector("#modal-detalle-factura .form-control-plaintext:nth-of-type(3)").textContent = data.factura.fecha;
        document.querySelector("#modal-detalle-factura .form-control-plaintext:nth-of-type(4)").textContent = data.factura.metodo_pago;
        document.querySelector("#modal-detalle-factura .form-control-plaintext:nth-of-type(6)").textContent = "$" + parseFloat(data.factura.monto_total).toFixed(2);

        // Tabla de productos
        tablaBody.innerHTML = "";
        let total = 0;
        data.items.forEach((item, i) => {
          total += parseFloat(item.total);
          tablaBody.innerHTML += `
            <tr>
              <td>${i + 1}</td>
              <td>${item.producto}</td>
              <td>${item.cantidad}</td>
              <td>$${parseFloat(item.precio_unitario).toFixed(2)}</td>
              <td>$${parseFloat(item.total).toFixed(2)}</td>
            </tr>`;
        });

        document.querySelector("#modal-detalle-factura tfoot th:last-child").textContent = "$" + total.toFixed(2);
      } catch (err) {
        tablaBody.innerHTML = `<tr><td colspan='5' class='text-danger'>Error al cargar detalle: ${err}</td></tr>`;
      }
    });
  });
});
</script>


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