// components/ventas/assets/ventas.js

window.initVentas = function () {
  console.log("✅ initVentas (listado) activo");

  const btnNuevaVenta = document.getElementById('btnNuevaVenta');
  const ventasTableBody = document.getElementById('ventasTableBody');
  const filtroVendedor = document.getElementById('filtroVendedor');

  let ventasData = [];
  let filtroActual = '';
  let paginaActual = 1;
  const ventasPorPagina = 8;

  // Renderiza el select de vendedores
  function renderVendedores(data) {
    const vendedores = [...new Set(data.map(v => v.vendedor))].filter(Boolean);
    filtroVendedor.innerHTML = '<option value="">Todos los vendedores</option>' +
      vendedores.map(v => `<option value="${v}">${v}</option>`).join('');
  }

  // Renderiza la tabla según filtro y página
  function renderTabla() {
    let dataFiltrada = filtroActual
      ? ventasData.filter(item => item.vendedor === filtroActual)
      : ventasData;

    const totalPaginas = Math.max(1, Math.ceil(dataFiltrada.length / ventasPorPagina));
    if (paginaActual > totalPaginas) paginaActual = totalPaginas;

    const inicio = (paginaActual - 1) * ventasPorPagina;
    const paginados = dataFiltrada.slice(inicio, inicio + ventasPorPagina);

    ventasTableBody.innerHTML = '';
    paginados.forEach(item => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${item.vendedor ?? '-'}</td>
        <td>${item.productos ?? '-'}</td>
        <td>$${Number(item.total || 0).toLocaleString('es-AR')}</td>
        <td>
          <button class="btn btn-sm btn-outline-primary btnDetalle" data-id="${item.id_factura}">
            🔍
          </button>
        </td>
      `;
      ventasTableBody.appendChild(tr);
    });

    renderPaginacion(totalPaginas);

    // Evento de la lupa → mostrar detalle
    ventasTableBody.querySelectorAll('.btnDetalle').forEach(btn => {
      btn.addEventListener('click', () => {
        cargarVistaDirecta('components/ventas/mostrar_detalle.php?id=' + btn.dataset.id);
      });
    });
  }

  // Renderiza la barra de paginación
  function renderPaginacion(totalPaginas) {
    const paginacion = document.getElementById('paginacionVentas');
    if (!paginacion) return;
    paginacion.innerHTML = `
      <button class="btn btn-outline-secondary btn-sm" ${paginaActual === 1 ? 'disabled' : ''} id="pagAnt">&lt;</button>
      <span>Página ${paginaActual} de ${totalPaginas}</span>
      <button class="btn btn-outline-secondary btn-sm" ${paginaActual === totalPaginas ? 'disabled' : ''} id="pagSig">&gt;</button>
    `;
    document.getElementById('pagAnt').onclick = () => {
      if (paginaActual > 1) {
        paginaActual--;
        renderTabla();
      }
    };
    document.getElementById('pagSig').onclick = () => {
      if (paginaActual < totalPaginas) {
        paginaActual++;
        renderTabla();
      }
    };
  }

  // Filtro por vendedor
  filtroVendedor.addEventListener('change', () => {
    filtroActual = filtroVendedor.value;
    paginaActual = 1;
    renderTabla();
  });

  // Nueva venta
  if (btnNuevaVenta) {
    btnNuevaVenta.addEventListener('click', () => {
      cargarVistaDirecta('components/ventas/nueva.php');
    });
  }

  // Cargar datos desde la base de datos
  fetch('components/ventas/api/listar_ventas.php')
    .then(res => res.json())
    .then(data => {
      if (!Array.isArray(data)) {
        console.error('⚠️ Backend no devolvió array:', data);
        return;
      }
      ventasData = data;
      renderVendedores(data);
      renderTabla();
    })
    .catch(err => console.error('❌ Error cargando ventas desde BD:', err));
};


// ==========================
// Funciones SPA globales
// ==========================

function cargarVistaDirecta(ruta) {
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
        window[nombreInit]();
      }
    })
    .catch(err => {
      console.error('❌ Error cargando vista:', err);
      container.innerHTML = `<p class="text-danger">Vista no disponible.</p>`;
    });
}

function obtenerNombreInitDesdeRuta(ruta) {
  if (ruta.includes('nueva.php')) return 'initVentasNueva';
  if (ruta.includes('mostrar_detalle.php')) return 'initMostrarDetalle'; // 👈 nombre nuevo
  if (ruta.includes('imprimir.php')) return 'initImprimir'; // por si usás el remito/pro forma
  return null;
}
