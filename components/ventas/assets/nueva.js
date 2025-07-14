// components/ventas/assets/nueva.js

window.initVentasNueva = function () {
  const selectCant = document.getElementById('selectCant');
  if (!selectCant) return;

  const btnBuscar = document.getElementById('btnBuscarProd');
  const btnLeerQR = document.getElementById('btnLeerQR');
  const qrJsonDisplay = document.getElementById('qrJsonDisplay');
  const jsonContentArea = document.getElementById('jsonContentArea');
  const btnAceptarQRData = document.getElementById('btnAceptarQRData');
  const btnAdj = document.getElementById('btnAdjuntar');
  const tablaBody = document.querySelector('#tablaVenta tbody');
  const proformaTotal = document.getElementById('proformaTotal');
  const inputCosto = document.getElementById('inputCosto');
  const btnCancelar = document.getElementById('btnCancelarVenta');
  const busqInput = document.getElementById('busquedaProducto');

  let productoSeleccionado = null;
  let totalGlobal = 0;
  let qrScanner = null;

  // Inicializar cantidades
  selectCant.innerHTML = '';
  for (let i = 1; i <= 99; i++) {
    selectCant.innerHTML += `<option value="${i}">${i}</option>`;
  }

  btnBuscar.addEventListener("click", () => {
    document.getElementById('qr-reader').style.display = 'none';
    qrJsonDisplay.style.display = 'none';
    btnAceptarQRData.style.display = 'none';
    jsonContentArea.value = '';
  });

  btnLeerQR.addEventListener("click", () => {
    const qrReaderDiv = document.getElementById('qr-reader');
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
        let json = null;
        try {
          json = typeof qrCodeMessage === 'string' ? JSON.parse(qrCodeMessage) : qrCodeMessage;
        } catch (e) {
          jsonContentArea.value = 'El QR leído no es un JSON válido.';
          qrJsonDisplay.style.display = 'block';
          return;
        }
        qrJsonDisplay.style.display = 'block';
        jsonContentArea.value = JSON.stringify(json, null, 2);
        btnAceptarQRData.style.display = 'inline-block';

        qrScanner.stop().then(() => {
          qrReaderDiv.style.display = 'none';
        });
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
    const qrReaderDiv = document.getElementById('qr-reader');
    qrReaderDiv.style.display = 'none';
  });

  btnAceptarQRData.addEventListener("click", () => {
    let jsonDatos = null;
    try {
      jsonDatos = JSON.parse(jsonContentArea.value);
      mostrarProductoEnPantalla(jsonDatos);
      bootstrap.Modal.getInstance(document.getElementById("modalScanOrSearchQR")).hide();
    } catch (e) {
      jsonContentArea.value = "Error: JSON inválido. Revisá el formato.";
      btnAceptarQRData.style.display = 'none';
    }
  });

  function mostrarProductoEnPantalla(data) {
    productoSeleccionado = data;
    document.getElementById("detProducto").value = data.producto || '';
    document.getElementById("detUbicacion").value = data.ubicacion || '';
    document.getElementById("detCantidad").value = data.cantidad || 1;
    document.getElementById("detCosto").value = data.precio || 0;
    inputCosto.value = data.precio || 0;
    actualizarTotalVista();
  }

  function actualizarTotalVista() {
    if (!productoSeleccionado) return;
    const cant = +selectCant.value;
    const costo = +inputCosto.value;
    const tot = cant * costo;
    proformaTotal.textContent = "$" + tot.toLocaleString();
  }
  selectCant.addEventListener("change", actualizarTotalVista);
  inputCosto.addEventListener("input", actualizarTotalVista);

  btnAdj.addEventListener("click", () => {
    console.log('btnAdj click');
    if (!productoSeleccionado) {
      alert("Selecciona un producto primero");
      return;
    }
    const cant = +selectCant.value;
    const costo = +inputCosto.value;
    const subtotal = cant * costo;
    totalGlobal += subtotal;
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${productoSeleccionado.producto || ''}</td>
      <td>${productoSeleccionado.ubicacion || ''}</td>
      <td>${cant}</td>
      <td>$${costo.toLocaleString()}</td>
      <td>$${subtotal.toLocaleString()}</td>`;
    tablaBody.appendChild(tr);
    proformaTotal.textContent = "$" + totalGlobal.toLocaleString();

    // Debug AJAX
    console.log("Enviando a guardar_producto.php", {
      producto: productoSeleccionado.producto,
      ubicacion: productoSeleccionado.ubicacion,
      precio: costo,
      cantidad: cant
    });

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
    .then(r => {
      console.log('Respuesta cruda:', r);
      return r.json();
    })
    .then(res => {
      console.log("Respuesta AJAX:", res);
      if(res.success){
        // alert('Producto guardado en base de datos');
      } else {
        alert("No se pudo guardar en la base: " + (res.error || "Error desconocido"));
      }
    })
    .catch(err => {
      alert("Error AJAX: " + err);
    });

    productoSeleccionado = null;
    document.getElementById("detProducto").value = '';
    document.getElementById("detUbicacion").value = '';
    document.getElementById("detCantidad").value = '';
    document.getElementById("detCosto").value = '';
    inputCosto.value = '';
    selectCant.value = 1;
    actualizarTotalVista();
  });

  btnCancelar?.addEventListener("click", () => {
    location.hash = "#/ventas";
    setTimeout(() => location.reload(), 200);
  });
};

document.addEventListener('DOMContentLoaded', function(){
  if(typeof window.initVentasNueva === 'function') window.initVentasNueva();
});
