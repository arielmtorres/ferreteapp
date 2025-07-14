<?php
// components/ventas/ventas.php
// Si más adelante quieres proteger la carga desde index.php:
//if (!defined('FERRETEAPP')) exit;
?>
<section id="ventas">
  <!-- Botón Nueva Venta -->
  <div class="d-flex justify-content-start mb-3">
    <button id="btnNuevaVenta" class="btn btn-primary">+ Nueva venta</button>
  </div>

  <!-- Historial de ventas -->
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
        <tbody id="ventasTableBody">
          <!-- Se rellenará con JS -->
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- Lógica específica de Ventas -->
<script src="../../components/ventas/ventas.js"></script>
