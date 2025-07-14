window.initVentasNueva = function() {
  const busqInput  = document.getElementById('busquedaProducto');
  const btnBuscar  = document.getElementById('btnBuscarProd');
  const selectCant = document.getElementById('selectCant');
  const inputCosto = document.getElementById('inputCosto');
  const btnAdj     = document.getElementById('btnAdjuntar');
  const tablaBody  = document.querySelector('#tablaVenta tbody');
  const proformaTotal = document.getElementById('proformaTotal');
  const btnImprimir = document.getElementById('btnImprimir');

  let productoSeleccionado = null;

  if (!busqInput || !btnBuscar) return;

  btnBuscar.addEventListener('click', () => {
    const term = busqInput.value.trim().toLowerCase();
    if (!term) return alert('Ingresa nombre de producto');

    fetch('../../json/stock.json')
      .then(r => r.json())
      .then(data => {
        const p = data.find(x => x.producto.toLowerCase().includes(term));
        if (!p) return alert('Producto no encontrado');
        productoSeleccionado = p;
        document.getElementById('detProducto').value = p.producto;
        document.getElementById('detUbicacion').value = p.ubicacion;
        document.getElementById('detCantidad').value = selectCant.value;
        document.getElementById('detCosto').value = p.precio;
        calcularTotal();
      });
  });

  selectCant.addEventListener('change', () => {
    document.getElementById('detCantidad').value = selectCant.value;
    calcularTotal();
  });

  inputCosto.addEventListener('input', calcularTotal);

  function calcularTotal() {
    if (!productoSeleccionado) return;
    const cant = +selectCant.value;
    const costo = +inputCosto.value || productoSeleccionado.precio;
    const tot = cant * costo;
    proformaTotal.textContent = '$' + tot.toLocaleString();
  }

  btnAdj.addEventListener('click', () => {
    if (!productoSeleccionado) return alert('Selecciona un producto primero');
    const cant = +selectCant.value;
    const costo = +inputCosto.value;
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${productoSeleccionado.producto}</td>
      <td>${productoSeleccionado.ubicacion}</td>
      <td>${cant}</td>
      <td>$${costo.toLocaleString()}</td>
      <td>$${(cant * costo).toLocaleString()}</td>
    `;
    tablaBody.appendChild(tr);
  });

  if (btnImprimir) {
    btnImprimir.addEventListener('click', () => {
      location.hash = '#/ventas/imprimir';
    });
  }
};
