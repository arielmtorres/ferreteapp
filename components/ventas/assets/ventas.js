window.initVentas = function () {
  console.log("✅ initVentas activo");

  function setupVentas() {
    const btnNuevaVenta = document.getElementById('btnNuevaVenta');
    const ventasTableBody = document.getElementById('ventasTableBody');

    if (!ventasTableBody) {
      setTimeout(setupVentas, 100);
      return;
    }

    if (btnNuevaVenta) {
      btnNuevaVenta.onclick = () => {
        cargarVistaDirecta('components/ventas/nueva.php');
      };
    }

    fetch('components/ventas/assets/ventas.json')
      .then(res => {
        if (!res.ok) throw new Error(`No se encontró ventas.json (${res.status})`);
        return res.json();
      })
      .then(data => {
        if (!Array.isArray(data)) {
          console.error('⚠️ ventas.json no contiene un array válido:', data);
          return;
        }

        ventasTableBody.innerHTML = '';

        data.forEach(item => {
          // PROTECCIÓN ANTI-BLOQUEO: Siempre convierte a array seguro
          const productosList = Array.isArray(item.productos) ? item.productos : (item.productos ? [item.productos] : []);
          const productosTxt = productosList.join(', ');

          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td>${item.vendedor || '-'}</td>
            <td>${productosTxt}</td>
            <td>$${(item.total ?? 0).toLocaleString()}</td>
            <td>
              <button class="btn btn-sm btn-outline-primary btnDetalle" data-id="${item.id || ''}">
                🔍
              </button>
            </td>
          `;
          ventasTableBody.appendChild(tr);
        });

        ventasTableBody.querySelectorAll('.btnDetalle').forEach(btn => {
          btn.onclick = () => {
            cargarVistaDirecta('components/ventas/imprimir.php');
          };
        });
      })
      .catch(err => {
        console.error('❌ Error cargando ventas.json:', err);
      });
  }

  setupVentas();
};

function cargarVistaDirecta(ruta) {
  console.log("➡️ Cargando vista directa:", ruta);

  const container = document.getElementById('principalBody');
  if (!container) {
    console.error("⚠️ No se encontró el contenedor #principalBody.");
    return;
  }

  fetch(ruta)
    .then(res => {
      if (!res.ok) throw new Error(`No existe ${ruta}`);
      return res.text();
    })
    .then(html => {
      container.innerHTML = html;
      const nombreInit = obtenerNombreInitDesdeRuta(ruta);
      if (typeof window[nombreInit] === 'function') {
        setTimeout(() => { window[nombreInit](); }, 10);
      }
    })
    .catch(err => {
      console.error('❌ Error cargando vista:', err);
      container.innerHTML = `<p class="text-danger">Vista no disponible.</p>`;
    });
}

function obtenerNombreInitDesdeRuta(ruta) {
  if (ruta.includes('nueva.php')) return 'initVentasNueva';
  if (ruta.includes('imprimir.php')) return 'initImprimir';
  if (ruta.includes('ventas.php')) return 'initVentas';
  return null;
}
