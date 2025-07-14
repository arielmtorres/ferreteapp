window.initProductos = function () {
    console.log('Sección Productos cargada');
  
    // Listener para botón "Ver QR"
    document.querySelectorAll('button.btn-outline-secondary').forEach(btn => {
      btn.addEventListener('click', function () {
        const fila = this.closest('tr');
        const idProducto = fila.children[0].textContent.trim();
  
        const contenedorQR = document.getElementById('contenedor-qr');
        contenedorQR.innerHTML = '';
  
        new QRCode(contenedorQR, {
          text: idProducto,
          width: 150,
          height: 150
        });
  
        const modalQR = new bootstrap.Modal(document.getElementById('modal-ver-qr'));
        modalQR.show();
      });
    });
  
    // Acá podrías agregar más lógica como cargar productos desde API, etc.
  };
  