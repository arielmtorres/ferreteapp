window.initVentasNueva = function () {
  const selectCant = document.getElementById('selectCant');
  if (!selectCant) return;

  const btnBuscar = document.getElementById('btnBuscarProd');
  const btnLeerQR = document.getElementById('btnLeerQR');
  const qrJsonDisplay = document.getElementById('qrJsonDisplay');
  const jsonContentArea = document.getElementById('jsonContentArea');
  const btnAceptarQRData = document.getElementById('btnAceptarQRData');
  const btnAdj = document.getElementById('btnAdjuntar');
  const detalleBody = document.getElementById('detalleProductosBody');
  const proformaTotal = document.getElementById('proformaTotal');
  const inputCosto = document.getElementById('inputCosto');
  const btnCancelar = document.getElementById('btnCancelarVenta');
  const qrReaderDiv = document.getElementById('qr-reader');
  const modalQR = document.getElementById('modalScanOrSearchQR');
  const busqInput = document.getElementById('busquedaProducto');

  let productoSeleccionado = null;
  let totalGlobal = 0;
  let productosDetalle = []; // array para los productos adjuntados
  let qrScanner = null;

  // Inicializar cantidades
  selectCant.innerHTML = '';
  for (let i = 1; i <= 99; i++) {
    selectCant.innerHTML += `<option value="${i}">${i}</option>`;
  }

  btnBuscar.addEventListener("click", () => {
    qrReaderDiv.style.display = 'none';
    qrJsonDisplay.style.display = 'none';
    btnAceptarQRData.style.display = 'none';
    jsonContentArea.value = '';
  });

  btnLeerQR.addEventListener("click", () => {
    qrReaderDiv.style.display = 'block';
    qrJsonDisplay.style.display = 'none';
    btnAceptarQRData.style.display = 'none';
    jsonContentArea.value = '';

    if (qrScanner) {
      qrScanner.clear().catch(() => {});
      qrScanner = null;
    }

    qrScanner = new Html5Qrcode("qr-reader");

    qrScanner.start(
      { facingMode: "environment" },
      { fps: 10, qrbox: 250 },
      qrCodeMessage => {
        // Solo permitimos JSON válido
        let json = null;
        try {
          json = JSON.parse(qrCodeMessage.trim());
          qrJsonDisplay.style.display = 'block';
          jsonContentArea.value = JSON.stringify(json, null, 2);
          btnAceptarQRData.style.display = 'inline-block';

          qrScanner.stop().then(() => {
            qrReaderDiv.style.display = 'none';
          });
        } catch (e) {
          jsonContentArea.value = 'El QR leído NO es JSON válido.\n\nRevisá el formato.\nDebe ser: {"producto":"Taladro","ubicacion":"A3","precio":18500.5,"cantidad":2}';
          qrJsonDisplay.style.display = 'block';
          btnAceptarQRData.style.display = 'none';
        }
      },
      errorMessage => {
        // Silencioso
      }
    ).catch(err => {
      alert("No se pudo acceder a la cámara. Dale permisos o probá en otro navegador.");
    });
  });

  document.getElementById('modalScanOrSearchQR').addEventListener('hidden.bs.modal', function () {
    if (qrScanner && qrScanner._isScanning) {
      qrScanner.stop().catch(() => {});
    }
    qrReaderDiv.style.display = 'none';
    document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
    document.body.classList.remove('modal-open');
  });

  // "Aceptar" después de leer QR
  btnAceptarQRData.addEventListener("click", () => {
    let raw = jsonContentArea.value;
    let jsonDatos = null;
    try {
      jsonDatos = JSON.parse(raw);
      mostrarProductoEnPantalla(jsonDatos);
      bootstrap.Modal.getInstance(modalQR).hide();
      setTimeout(() => {
        document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
        document.body.classList.remove('modal-open');
      }, 350);
    } catch (e) {
      jsonContentArea.value = "Error: JSON inválido. Revisá el formato.";
      btnAceptarQRData.style.display = 'none';
    }
  });

  function mostrarProductoEnPantalla(data) {
    productoSeleccionado = data;
    // Si querés los inputs visibles, podés mostrarlos acá (¡editables!)
    document.getElementById("busquedaProducto").value = data.producto || '';
    inputCosto.value = data.precio || 0;
    selectCant.value = data.cantidad || 1;
    actualizarTotalVista();
  }

  function actualizarTotalVista() {
    let total = 0;
    productosDetalle.forEach(p => {
      total += p.cantidad * p.precio;
    });
    proformaTotal.textContent = "$" + total.toLocaleString();
  }

  selectCant.addEventListener("change", actualizarTotalVista);
  inputCosto.addEventListener("input", actualizarTotalVista);

  btnAdj.addEventListener("click", () => {
    if (!productoSeleccionado) {
      alert("Selecciona un producto primero");
      return;
    }
    const cant = +selectCant.value;
    const costo = +inputCosto.value;
    const subtotal = cant * costo;

    // Agrega al array
    productosDetalle.push({
      producto: productoSeleccionado.producto,
      ubicacion: productoSeleccionado.ubicacion,
      cantidad: cant,
      precio: costo
    });
    // Actualiza tabla visual
    renderDetalleProductos();

    // Simula guardar producto vía AJAX (podés comentar esto si solo querés que se guarde al final)
    fetch('components/ventas/guardar_producto.php', {
      method: "POST",
      headers: {"Content-Type": "application/json"},
      body: JSON.stringify({
        producto: productoSeleccionado.producto,
        ubicacion: productoSeleccionado.ubicacion,
        precio: costo,
        cantidad: cant
      })
    })
    .then(r => r.json())
    .then(res => {
      if (!res.success) {
        alert("No se pudo guardar en la base: " + (res.error || "Error desconocido"));
      }
    })
    .catch(err => {
      // alert("Error AJAX: " + err);
    });

    // Limpiar campos
    productoSeleccionado = null;
    document.getElementById("busquedaProducto").value = '';
    inputCosto.value = '';
    selectCant.value = 1;
    actualizarTotalVista();
  });

  // Función para renderizar la tabla de productos adjuntados
  function renderDetalleProductos() {
    detalleBody.innerHTML = '';
    let total = 0;
    productosDetalle.forEach((prod, i) => {
      let subtotal = prod.cantidad * prod.precio;
      total += subtotal;
      let tr = document.createElement("tr");
      tr.innerHTML = `
        <td>${prod.producto || ''}</td>
        <td>${prod.ubicacion || ''}</td>
        <td>${prod.cantidad}</td>
        <td>$${prod.precio.toLocaleString()}</td>
        <td>$${subtotal.toLocaleString()}</td>
        <td><button class="btn btn-danger btn-sm btnQuitarProd" data-idx="${i}">&times;</button></td>
      `;
      detalleBody.appendChild(tr);
    });
    proformaTotal.textContent = "$" + total.toLocaleString();

    // Eventos para quitar productos
    detalleBody.querySelectorAll('.btnQuitarProd').forEach(btn => {
      btn.addEventListener('click', function () {
        const idx = parseInt(this.getAttribute('data-idx'));
        productosDetalle.splice(idx, 1);
        renderDetalleProductos();
      });
    });
  }

  btnCancelar?.addEventListener("click", () => {
    location.hash = "#/ventas";
    setTimeout(() => location.reload(), 200);
  });
};

document.addEventListener('DOMContentLoaded', function(){
  if(typeof window.initVentasNueva === 'function') window.initVentasNueva();
});
