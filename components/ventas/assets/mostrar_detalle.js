// components/ventas/assets/mostrar_detalle.js

window.initMostrarDetalle = function () {
  console.log('✅ initMostrarDetalle activo');

  const params = new URLSearchParams(window.location.search);
  const id = params.get('id');

  const infoVenta = document.getElementById('infoVenta');
  const tbody = document.querySelector('#tablaItemsVenta tbody');
  const totalLabel = document.getElementById('totalVentaDetalle');
  const btnVolver = document.getElementById('btnVolverVentas');
  const btnExportPDF = document.getElementById('btnExportPDF');

  if (!id) {
    infoVenta.innerHTML = '<p class="text-danger mb-0">No se indicó venta.</p>';
    return;
  }

  // Obtener datos de la venta
  fetch('components/ventas/api/get_venta.php?id=' + encodeURIComponent(id))
    .then(res => res.json())
    .then(data => {
      if (!data || !data.factura) {
        infoVenta.innerHTML = '<p class="text-danger mb-0">Venta no encontrada.</p>';
        return;
      }

      const f = data.factura;
      infoVenta.innerHTML = `
        <div class="row g-3">
          <div class="col-md-3"><strong>N° Factura:</strong><br>${f.id_factura}</div>
          <div class="col-md-3"><strong>Fecha:</strong><br>${f.fecha}</div>
          <div class="col-md-3"><strong>Vendedor:</strong><br>${f.vendedor}</div>
          <div class="col-md-3"><strong>Método pago:</strong><br>${f.metodo_pago ?? '-'}</div>
        </div>
      `;

      tbody.innerHTML = '';
      let total = 0;
      (data.items || []).forEach((item, idx) => {
        total += Number(item.total);
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${idx + 1}</td>
          <td>${item.producto}</td>
          <td>${item.cantidad}</td>
          <td>$${Number(item.precio_unitario).toLocaleString('es-AR')}</td>
          <td>$${Number(item.total).toLocaleString('es-AR')}</td>
        `;
        tbody.appendChild(tr);
      });

      totalLabel.textContent = '$' + total.toLocaleString('es-AR');
    })
    .catch(err => {
      console.error('❌ Error cargando venta:', err);
      infoVenta.innerHTML = '<p class="text-danger mb-0">Error al cargar la venta.</p>';
    });

  // volver al listado
  if (btnVolver) {
    btnVolver.addEventListener('click', () => {
      cargarVistaDirecta('components/ventas/ventas.php');
    });
  }

  // exportar PDF (placeholder)
  if (btnExportPDF) {
    btnExportPDF.addEventListener('click', () => {
      alert('Exportar a PDF aún no implementado');
    });
  }
};
