// components/inicio/inicio.js
(function(){
  // Fecha de hoy (si lo necesitas)
  // document.getElementById('fecha-hoy').textContent = new Date().toLocaleDateString();

  // Botones de navegación
  document.getElementById('btnNuevaVenta').onclick    = () => location.hash = '#/ventas';
  document.getElementById('btnIngresarStock').onclick = () => location.hash = '#/stock';

  // Búsqueda
  document.getElementById('btnBuscar').onclick = filtrarTabla;
  document.getElementById('btnQrScanner').onclick = () =>
    alert('Lanzar escáner QR (pendiente)');

  // Carga y render de la tabla
  fetch('json/stock.json')
    .then(res => res.json())
    .then(data => {
      const tbody = document.getElementById('stockTableBody');
      tbody.innerHTML = '';
      data.forEach(item => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${item.nombre}</td>
          <td>${item.ubicacion}</td>
          <td>${item.cantidad}</td>
          <td>$${item.precio}</td>
        `;
        tbody.appendChild(tr);
      });
    })
    .catch(err => console.error('Error cargando stock.json:', err));

  function filtrarTabla() {
    const term = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('#stockTableBody tr').forEach(tr => {
      tr.style.display = tr.cells[0].textContent.toLowerCase().includes(term) ? '' : 'none';
    });
  }
})();
