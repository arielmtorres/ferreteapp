window.initProductos = function () {
    console.log('Sección Productos cargada');
  
    const modalQR = new bootstrap.Modal(document.getElementById('modal-ver-qr'));
  
    // Listener para todos los botones "Ver QR"
    document.querySelectorAll('button.btn-outline-secondary').forEach(btn => {
      btn.addEventListener('click', function () {
        const fila = this.closest('tr');
        const idProducto = fila.children[0].textContent.trim();
  
        const contenedorQR = document.getElementById('contenedor-qr');
        contenedorQR.innerHTML = ''; // Limpiar QR anterior
  
        // Generar nuevo QR
        new QRCode(contenedorQR, {
          text: idProducto,
          width: 150,
          height: 150
        });
  
        modalQR.show();
      });
    });
  
    // 🔧 FIX: Al cerrar el modal, eliminar el contenido del QR (por si queda residuo o error)
    const modalEl = document.getElementById('modal-ver-qr');
    modalEl.addEventListener('hidden.bs.modal', () => {
      document.getElementById('contenedor-qr').innerHTML = '';
    });
  };
  