// =====================================
// components/ventas/assets/nueva.js
// MODO DEMO: no escribe en BD (solo muestra)
// =====================================

(function () {
  // ---------- Config ----------
  const MODO_DEMO = true; // ← importante: sin BD

  // ---------- Helpers ----------
  const $ = (id) => document.getElementById(id);
  const on = (el, ev, cb) => el && el.addEventListener(ev, cb);
  const moneyAR = (n) => '$' + Number(n || 0).toLocaleString('es-AR');

  // ---------- Estado ----------
  const state = {
    items: [], // { producto_id, nombre, ubicacion, cantidad, unitario }
    total: 0,
  };

  // ---------- Render ----------
  function renderTotal() {
    const totalSpan = $('proformaTotal');
    const totalPrev = $('totalModalTicket');
    state.total = state.items.reduce((a, it) => a + (Number(it.cantidad) * Number(it.unitario)), 0);
    if (totalSpan) totalSpan.textContent = moneyAR(state.total);
    if (totalPrev) totalPrev.textContent = moneyAR(state.total);
  }

  function renderDetalle() {
    const tbody = $('detalleProductosBody');
    if (!tbody) return;
    tbody.innerHTML = '';
    state.items.forEach((it, idx) => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${it.nombre ?? '-'}</td>
        <td>${it.ubicacion ?? '-'}</td>
        <td class="text-center">${it.cantidad}</td>
        <td class="text-end">${moneyAR(it.unitario)}</td>
        <td class="text-end">${moneyAR(it.cantidad * it.unitario)}</td>
        <td class="text-center">
          <button class="btn btn-sm btn-outline-danger" data-idx="${idx}">✕</button>
        </td>
      `;
      tbody.appendChild(tr);
    });
    // quitar item
    tbody.querySelectorAll('button[data-idx]').forEach(btn => {
      on(btn, 'click', () => {
        const i = Number(btn.getAttribute('data-idx'));
        state.items.splice(i, 1);
        renderDetalle(); renderTicket(); renderTotal();
      });
    });
  }

  function renderTicket() {
    const tb = $('tablaVentaTicket');
    if (!tb) return;
    tb.innerHTML = '';
    state.items.forEach(it => {
      const tr = document.createElement('tr');
      tr.className = 'small';
      tr.innerHTML = `
        <td>${it.nombre ?? '-'}</td>
        <td class="text-center">${it.ubicacion ?? '-'}</td>
        <td class="text-center">${it.cantidad}</td>
        <td class="text-end">${moneyAR(it.unitario)}</td>
        <td class="text-end">${moneyAR(it.cantidad * it.unitario)}</td>
      `;
      tb.appendChild(tr);
    });
  }

  function syncPreview() {
    const numeroPrev = $('facturaNumero');
    const fechaPrev  = $('ticketFechaPreview');
    const clientePrev= $('ticketClientePreview');
    const vendPrev   = $('ticketVendedorPreview');
    const obsPrev    = $('ticketObsPreview');

    if (numeroPrev)  numeroPrev.textContent   = ($('facturaNumeroInput')?.value || '0001-00001234');
    if (fechaPrev)   fechaPrev.textContent    = ($('ticketFecha')?.value || '');
    if (clientePrev) clientePrev.textContent  = ($('ticketCliente')?.value || '');
    if (vendPrev)    vendPrev.textContent     = ($('ticketVendedor')?.value || '');
    if (obsPrev)     obsPrev.textContent      = ($('ticketObservaciones')?.value || '');
  }

  // ---------- Data ----------
  async function cargarVendedores() {
    try {
      const res = await fetch('components/ventas/api/get_vendedores.php');
      if (!res.ok) throw new Error('HTTP ' + res.status);
      const data = await res.json();
      const sel = $('ticketVendedor');
      if (!Array.isArray(data) || !sel) throw new Error('respuesta inválida');
      sel.innerHTML = '<option value="">Seleccionar vendedor</option>' +
        data.map(v => `<option>${v}</option>`).join('');
    } catch (e) {
      // Fallback en DEMO
      const sel = $('ticketVendedor');
      if (sel) {
        const fallback = ['Ariel','Lara','Teo'];
        sel.innerHTML = '<option value="">Seleccionar vendedor</option>' +
          fallback.map(v => `<option>${v}</option>`).join('');
      }
      console.warn('Vendedores en modo demo:', e.message);
    }
  }

  function agregarItemDesdeProducto(p, cantidad, unitario) {
    const item = {
      producto_id: p.id_producto ?? p.id ?? 0,
      nombre: p.nombre ?? p.producto ?? 'Producto',
      ubicacion: p.ubicacion ?? '-',
      cantidad: Number(cantidad || 1),
      unitario: Number(unitario ?? p.precio ?? 0)
    };
    state.items.push(item);
    renderDetalle(); renderTicket(); renderTotal();
  }

  // DEMO: si viene solo un código, crea un item genérico
  function agregarItemGenericoDesdeCodigo(code) {
    const cant = Number($('selectCant')?.value || 1);
    const unit = Number($('inputCosto')?.value || 0);
    agregarItemDesdeProducto({ producto: `Código ${code}`, precio: unit, ubicacion: '-' }, cant, unit);
  }

  // ---------- Guardar (DEMO) ----------
  async function guardarVentaDemo() {
    // No llama al backend; solo abre el modal ticket
    const modalEl = $('modalTicket');
    if (modalEl) {
      const m = new bootstrap.Modal(modalEl);
      m.show();
    }
    return 1; // id ficticio
  }

  // ---------- QR / Cámara ----------
  let qrInstance = null;
  let qrRunning  = false;
  function startQR() {
    if (!window.Html5Qrcode) {
      alert('No se pudo cargar el lector QR. Verifica html5-qrcode.min.js');
      return;
    }
    const qrReader = $('qr-reader');
    if (!qrReader) return;
    qrReader.style.display = 'block';
    if (!qrInstance) qrInstance = new Html5Qrcode('qr-reader');

    const config = { fps: 10, qrbox: 250 };
    const camera = { facingMode: 'environment' };
    qrInstance.start(camera, config, onQrSuccess, onQrError)
      .then(() => { qrRunning = true; })
      .catch(err => {
        console.error('No se pudo iniciar la cámara:', err);
        alert('No se pudo iniciar la cámara.\nPermití el acceso a la cámara.');
      });
  }
  function stopQR() {
    if (qrInstance && qrRunning) {
      qrInstance.stop().then(() => { qrRunning = false; qrInstance.clear(); }).catch(() => {});
    }
  }
  function onQrSuccess(decodedText) {
    console.log('QR leído:', decodedText);
    const txt = decodedText.trim();
    const pareceJSON = txt.startsWith('{') || txt.startsWith('[');
    const jsonArea = $('jsonContentArea');
    const qrJsonDisplay = $('qrJsonDisplay');
    const btnAceptarQR = $('btnAceptarQRData');
    const modal = $('modalScanOrSearchQR');

    if (pareceJSON) {
      if (jsonArea) jsonArea.value = txt;
      if (qrJsonDisplay) qrJsonDisplay.style.display = 'block';
      if (btnAceptarQR)  btnAceptarQR.style.display  = 'inline-block';
    } else {
      // DEMO: agregar item por código y cerrar
      agregarItemGenericoDesdeCodigo(txt);
      const m = modal ? bootstrap.Modal.getInstance(modal) : null;
      if (m) m.hide();
    }
    stopQR();
  }
  function onQrError() {}

  // ---------- Init pública ----------
  window.initVentasNueva = function () {
    console.log('🧾 initVentasNueva (ticket) activo — MODO DEMO');

    // Cantidades 1..20
    const selectCant = $('selectCant');
    if (selectCant && selectCant.options.length === 0) {
      const frag = document.createDocumentFragment();
      for (let i = 1; i <= 20; i++) {
        const opt = document.createElement('option');
        opt.value = i; opt.textContent = i;
        frag.appendChild(opt);
      }
      selectCant.appendChild(frag);
    }

    // Preview
    on($('facturaNumeroInput'), 'input', syncPreview);
    on($('ticketFecha'), 'input', syncPreview);
    on($('ticketCliente'), 'input', syncPreview);
    on($('ticketVendedor'), 'change', syncPreview);
    on($('ticketObservaciones'), 'input', syncPreview);
    syncPreview();

    // Botón del modal QR
    on($('btnLeerQR'), 'click', startQR);

    // Cerrar modal → detener cámara y limpiar
    const modal = $('modalScanOrSearchQR');
    if (modal) {
      modal.addEventListener('hidden.bs.modal', () => {
        stopQR();
        const qrReader = $('qr-reader');
        const qrJsonDisplay = $('qrJsonDisplay');
        const btnAceptarQR = $('btnAceptarQRData');
        if (qrReader) qrReader.style.display = 'none';
        if (qrJsonDisplay) qrJsonDisplay.style.display = 'none';
        if (btnAceptarQR)  btnAceptarQR.style.display  = 'none';
      });
    }

    // Aceptar JSON del QR → DEMO: agregar al ticket y cerrar
    on($('btnAceptarQRData'), 'click', () => {
      try {
        const txt = $('jsonContentArea')?.value || '{}';
        const obj = JSON.parse(txt);
        const cant = $('selectCant')?.value || 1;
        const unit = $('inputCosto')?.value || obj.precio || 0;
        agregarItemDesdeProducto(obj, cant, unit);

        const modalEl = $('modalScanOrSearchQR');
        const m = modalEl ? bootstrap.Modal.getInstance(modalEl) : null;
        if (m) m.hide();
        stopQR();
      } catch (e) {
        alert('El JSON del QR no es válido.');
        console.error(e);
      }
    });

    // Guardar / Imprimir → DEMO (no BD)
    on($('btnImprimir'), 'click', async () => {
      await guardarVentaDemo();
    });

    // Cancelar
    on($('btnCancelarVenta'), 'click', () => {
      state.items = [];
      renderDetalle(); renderTicket(); renderTotal();
    });

    // Carga inicial
    cargarVendedores();
    renderDetalle(); renderTicket(); renderTotal();
  };
})();
