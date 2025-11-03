// components/ventas/assets/nueva.js

window.initVentasNueva = function () {
  console.log("✅ initVentasNueva (ticket) activo");

  const inputBuscarProducto = document.getElementById('inputBuscarProducto');
  const listaResultados = document.getElementById('listaResultadosProductos');
  const inputCantidad = document.getElementById('inputCantidad');
  const tablaBody = document.querySelector('#tablaDetalleVenta tbody');
  const labelTotalVenta = document.getElementById('labelTotalVenta');
  const inputVendedor = document.getElementById('inputVendedor');
  const btnAgregarProducto = document.getElementById('btnAgregarProducto');
  const btnGuardarImprimir = document.getElementById('btnGuardarImprimir');
  const btnCancelarVenta = document.getElementById('btnCancelarVenta');

  let productosCache = {};
  let detalle = [];

  // 1. vendedores
  fetch('components/ventas/api/get_vendedores.php')
    .then(r => r.json())
    .then(data => {
      inputVendedor.innerHTML = '<option value="">Seleccionar vendedor</option>' +
        data.map(v => `<option value="${v.id_usuario}">${v.user}</option>`).join('');
    });

  // 2. búsqueda de productos
  let timer = null;
  inputBuscarProducto.addEventListener('input', () => {
    const term = inputBuscarProducto.value.trim();
    if (timer) clearTimeout(timer);
    if (term.length < 2) {
      listaResultados.classList.add('d-none');
      return;
    }
    timer = setTimeout(() => {
      fetch('components/ventas/api/buscar_productos.php?q=' + encodeURIComponent(term))
        .then(r => r.json())
        .then(data => {
          if (!Array.isArray(data) || data.length === 0) {
            listaResultados.innerHTML = '<div class="list-group-item">Sin resultados</div>';
            listaResultados.classList.remove('d-none');
            return;
          }
          listaResultados.innerHTML = data.map(p => `
            <button type="button" class="list-group-item list-group-item-action" data-id="${p.id_producto}">
              ${p.nombre} - $${Number(p.precio).toLocaleString('es-AR')}
            </button>
          `).join('');
          listaResultados.classList.remove('d-none');

          data.forEach(p => { productosCache[p.id_producto] = p; });
        });
    }, 400);
  });

  listaResultados.addEventListener('click', e => {
    const btn = e.target.closest('button[data-id]');
    if (!btn) return;
    const id = btn.dataset.id;
    const prod = productosCache[id];
    if (prod) {
      agregarProductoAFila(prod);
      listaResultados.classList.add('d-none');
      inputBuscarProducto.value = '';
    }
  });

  btnAgregarProducto.addEventListener('click', () => {
    const term = inputBuscarProducto.value.trim();
    if (!term) return;

    fetch('components/ventas/api/buscar_productos.php?q=' + encodeURIComponent(term))
      .then(r => r.json())
      .then(data => {
        if (Array.isArray(data) && data.length > 0) {
          agregarProductoAFila(data[0]);
          inputBuscarProducto.value = '';
          listaResultados.classList.add('d-none');
        }
      });
  });

  function agregarProductoAFila(prod) {
    const cant = Number(inputCantidad.value || 1);
    const unit = Number(prod.precio);
    const subtotal = cant * unit;

    detalle.push({
      id_producto: prod.id_producto,
      nombre: prod.nombre,
      cantidad: cant,
      unitario: unit,
      subtotal: subtotal,
      ubicacion: '-' // si después sumamos ubicaciones
    });
    renderTabla();
  }

  function renderTabla() {
    tablaBody.innerHTML = '';
    let total = 0;
    detalle.forEach((item, idx) => {
      total += item.subtotal;
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${item.nombre}</td>
        <td>${item.ubicacion}</td>
        <td>
          <input type="number" class="form-control form-control-sm cant-detalle" data-idx="${idx}" value="${item.cantidad}" min="1">
        </td>
        <td>$${item.unitario.toLocaleString('es-AR')}</td>
        <td>$${item.subtotal.toLocaleString('es-AR')}</td>
        <td><button class="btn btn-sm btn-danger btnQuitar" data-idx="${idx}">X</button></td>
      `;
      tablaBody.appendChild(tr);
    });
    labelTotalVenta.textContent = '$' + total.toLocaleString('es-AR');

    tablaBody.querySelectorAll('.btnQuitar').forEach(btn => {
      btn.addEventListener('click', () => {
        const i = Number(btn.dataset.idx);
        detalle.splice(i, 1);
        renderTabla();
      });
    });

    tablaBody.querySelectorAll('.cant-detalle').forEach(inp => {
      inp.addEventListener('change', () => {
        const i = Number(inp.dataset.idx);
        const nuevaCant = Number(inp.value || 1);
        detalle[i].cantidad = nuevaCant;
        detalle[i].subtotal = nuevaCant * detalle[i].unitario;
        renderTabla();
      });
    });
  }

  // guardar
  btnGuardarImprimir.addEventListener('click', () => {
    const payload = {
      nro_ticket: document.getElementById('inputNroTicket').value,
      fecha: document.getElementById('inputFecha').value,
      cliente: document.getElementById('inputCliente').value,
      vendedor: document.getElementById('inputVendedor').value,
      observaciones: document.getElementById('inputObservaciones').value,
      detalle: detalle
    };

    if (!payload.vendedor) {
      alert('Seleccioná un vendedor');
      return;
    }
    if (payload.detalle.length === 0) {
      alert('Agregá al menos un producto');
      return;
    }

    fetch('components/ventas/api/guardar_venta.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    })
      .then(r => r.json())
      .then(res => {
        if (res.ok) {
          alert('Venta guardada. ID: ' + res.id_factura);
        } else {
          alert('Error: ' + res.msg);
        }
      })
      .catch(err => {
        console.error(err);
        alert('Error guardando la venta');
      });
  });

  btnCancelarVenta.addEventListener('click', () => {
    cargarVistaDirecta('components/ventas/ventas.php');
  });
};
