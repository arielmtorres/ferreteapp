// components/ventas/ventas-nueva.js
(function(){
  const busqInput  = document.getElementById('busquedaProducto');
  const btnBuscar  = document.getElementById('btnBuscarProd');
  const selectCant = document.getElementById('selectCant');
  const inputCosto = document.getElementById('inputCosto');
  const btnAdj     = document.getElementById('btnAdjuntar');
  const tablaBody  = document.querySelector('#tablaVenta tbody');
  const proformaTotal = document.getElementById('proformaTotal');

  let productoSeleccionado = null;

  // 1) Buscar producto en stock.json
  btnBuscar.addEventListener('click', () => {
    const term = busqInput.value.trim().toLowerCase();
    if (!term) return alert('Ingresa nombre de producto');
    fetch('../../json/stock.json')
      .then(r=>r.json())
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

  // 2) Recalcula total al cambiar cantidad o costo
  selectCant.addEventListener('change', () => {
    document.getElementById('detCantidad').value = selectCant.value;
    calcularTotal();
  });

  function calcularTotal() {
    if (!productoSeleccionado) return;
    const cant = +selectCant.value;
    const costo = +inputCosto.value || productoSeleccionado.precio;
    const tot = cant * costo;
    document.getElementById('proformaTotal').textContent = '$' + tot.toLocaleString();
  }

  // 3) Adjuntar fila a la tabla
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
      <td>$${(cant*costo).toLocaleString()}</td>
    `;
    tablaBody.appendChild(tr);
    // opcional: actualizar un gran total al final...
  });

  // 4) Imprimir ticket
  document.getElementById('btnImprimir').addEventListener('click', () => {
    window.print();
  });
})();
