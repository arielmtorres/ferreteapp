window.initVentas = function() {
  const btnNuevaVenta = document.getElementById('btnNuevaVenta');
  const ventasTableBody = document.getElementById('ventasTableBody');

  if (btnNuevaVenta) {
    btnNuevaVenta.addEventListener('click', () => {
      location.hash = '#/ventas/nueva/nueva.php';
    });
  }

  if (ventasTableBody) {
    fetch('./components/ventas/ventas.json')
      .then(res => res.json())
      .then(data => {
        ventasTableBody.innerHTML = '';

        data.forEach(item => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td>${item.vendedor}</td>
            <td>${item.productos.join(', ')}</td>
            <td>$${item.total.toLocaleString()}</td>
            <td>
              <button class="btn btn-sm btn-outline-primary btnDetalle" data-id="${item.id}">
                🔍
              </button>
            </td>
          `;
          ventasTableBody.appendChild(tr);
        });

        ventasTableBody.querySelectorAll('.btnDetalle').forEach(btn => {
          btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            alert('Ver detalle de venta ' + id);
          });
        });
      })
      .catch(err => {
        console.error('Error cargando components/ventas/ventas.json:', err);
      });
  }
}
