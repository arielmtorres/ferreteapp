

// ⛔ Guard Clauses para no romper otras vistas
(function () {
  // Si el formulario o el contenedor principal de ingreso NO está en el DOM, no ejecuto nada.
  const formIngreso = document.getElementById('formIngreso');
  const contIngreso = document.getElementById('vistaIngreso');
  if (!formIngreso && !contIngreso) return;

  // --- tu código actual de ingreso.js debajo ---
})();


// =====================================
// components/ventas/assets/ventas.js
// =====================================

window.initVentas = function () {
  console.log("✅ initVentas (listado) activo");

  const btnNuevaVenta = document.getElementById('btnNuevaVenta');
  const ventasTableBody = document.getElementById('ventasTableBody');
  const filtroVendedor = document.getElementById('filtroVendedor');

  let ventasData = [];
  let filtroActual = '';
  let paginaActual = 1;
  const ventasPorPagina = 8;

  // ==========================
  // Renderizado de vendedores
  // ==========================
  function renderVendedores(data) {
    const vendedores = [...new Set(data.map(v => v.vendedor))].filter(Boolean);
    filtroVendedor.innerHTML =
      '<option value="">Todos los vendedores</option>' +
      vendedores.map(v => `<option value="${v}">${v}</option>`).join('');
  }

  // ==========================
  // Renderizado de tabla
  // ==========================
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

  // ==========================
  // Paginación
  // ==========================
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

  // ==========================
  // Filtro de vendedor
  // ==========================
  filtroVendedor.addEventListener('change', () => {
    filtroActual = filtroVendedor.value;
    paginaActual = 1;
    renderTabla();
  });

  // ==========================
  // Nueva venta → abrir nueva.php
  // ==========================
  if (btnNuevaVenta) {
    btnNuevaVenta.addEventListener('click', () => {
      cargarVistaDirecta('components/ventas/nueva.php');
    });
  }

  // ==========================
  // Cargar datos desde la base
  // ==========================
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


// =====================================================
// Loader SPA: carga vistas + sus JS y CSS dinámicamente
// =====================================================

const VIEW_MANIFEST = {
  'components/ventas/nueva.php': {
    css: [
      'components/ventas/assets/nueva.css'
    ],
    js: [
      'components/ventas/assets/html5-qrcode.min.js',
      'components/ventas/assets/nueva.js'
    ],
    init: 'initVentasNueva'
  },
  'components/ventas/mostrar_detalle.php': {
    css: [],
    js: ['components/ventas/assets/mostrar_detalle.js'],
    init: 'initMostrarDetalle'
  },
  'components/ventas/imprimir.php': {
    css: ['components/ventas/assets/imprimir.css'],
    js: ['components/ventas/assets/imprimir.js'],
    init: 'initImprimir'
  }
};


// ==========================
// Función para cargar vistas
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
    .then(async html => {
      container.innerHTML = html;

      const conf = VIEW_MANIFEST[ruta] || null;
      if (conf?.css) for (const href of conf.css) await loadCSSOnce(href);
      if (conf?.js) for (const src of conf.js) await loadJSOnce(src);

      const initName = conf?.init || obtenerNombreInitDesdeRuta(ruta);
      if (initName && typeof window[initName] === 'function') {
        window[initName]();
      } else {
        console.warn('ℹ️ Sin init para', ruta, '→', initName);
      }
    })
    .catch(err => {
      console.error('❌ Error cargando vista:', err);
      container.innerHTML = `<p class="text-danger">Vista no disponible. Error: ${err.message}</p>`;
    });
}


// ==========================
// Cargadores auxiliares
// ==========================
function loadCSSOnce(href) {
  return new Promise((res, rej) => {
    if (document.querySelector(`link[data-href="${href}"]`)) return res();
    const el = document.createElement('link');
    el.rel = 'stylesheet';
    el.href = href;
    el.dataset.href = href;
    el.onload = res;
    el.onerror = () => rej(new Error('No se pudo cargar CSS ' + href));
    document.head.appendChild(el);
  });
}

function loadJSOnce(src) {
  return new Promise((res, rej) => {
    if (document.querySelector(`script[data-src="${src}"]`)) return res();
    const s = document.createElement('script');
    s.src = src;
    s.defer = true;
    s.dataset.src = src;
    s.onload = res;
    s.onerror = () => rej(new Error('No se pudo cargar JS ' + src));
    document.body.appendChild(s);
  });
}

function obtenerNombreInitDesdeRuta(ruta) {
  if (ruta.includes('nueva.php')) return 'initVentasNueva';
  if (ruta.includes('mostrar_detalle.php')) return 'initMostrarDetalle';
  if (ruta.includes('imprimir.php')) return 'initImprimir';
  return null;
}
