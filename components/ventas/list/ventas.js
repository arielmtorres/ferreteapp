// components/ventas/ventas.js

(function(){
  // 1) Al hacer click en "+ Nueva venta"
  document.getElementById('btnNuevaVenta').addEventListener('click', function(){
    // Por ejemplo, cambiamos el hash para abrir el formulario de nueva venta
    location.hash = '#/ventas/nueva';
  });

  // 2) Cargamos el historial desde JSON
  fetch('../../json/ventas.json')
    .then(res => res.json())
    .then(data => {
      const tbody = document.getElementById('ventasTableBody');
      tbody.innerHTML = ''; // limpia filas previas

      data.forEach(item => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${item.vendedor}</td>
          <td>${item.productos.join(', ')}</td>
          <td>$${item.total.toLocaleString()}</td>
          <td>
            <button class="btn btn-sm btn-outline-primary btnDetalle" data-id="${item.id}">
              🔍
            </button>
          </td>
        `;
        tbody.appendChild(tr);
      });

      // 3) Escucha los botones de detalle
      tbody.querySelectorAll('.btnDetalle').forEach(btn => {
        btn.addEventListener('click', () => {
          const id = btn.dataset.id;
          alert('Ver detalle de venta ' + id);
          // Aquí podrías abrir un modal o navegar a "#/ventas/detalle/" + id
        });
      });
    })
    .catch(err => {
      console.error('Error cargando ventas.json:', err);
    });
})();
