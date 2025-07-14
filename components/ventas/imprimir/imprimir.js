window.initVentasImprimir = function() {
  // Ejemplo básico para simular carga
  const detalleVenta = document.getElementById('detalleVenta');
  const totalVenta = document.getElementById('totalVenta');

  // Simulación de datos (normalmente se pasarían por localStorage, fetch o backend)
  const datos = [
    { producto: "Tuerca M4", cantidad: 5, costo: 100 },
    { producto: "Tornillo M5", cantidad: 2, costo: 200 }
  ];

  let total = 0;
  detalleVenta.innerHTML = '';

  datos.forEach(item => {
    const subtotal = item.cantidad * item.costo;
    total += subtotal;

    detalleVenta.innerHTML += `
      <tr>
        <td>${item.producto}</td>
        <td>${item.cantidad}</td>
        <td>$${item.costo}</td>
        <td>$${subtotal}</td>
      </tr>`;
  });

  totalVenta.textContent = `$${total.toLocaleString()}`;

  document.getElementById('btnImprimirFinal').addEventListener('click', () => {
    window.print();
  });

  document.getElementById('btnVolver').addEventListener('click', () => {
    location.hash = '#/ventas';
  });
}
