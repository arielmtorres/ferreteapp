window.initReportes = function () {
    // Asegúrate de que los <canvas> ya están en el DOM
    const ctxProductos = document.getElementById('graficoProductosMasComprados');
    const ctxStock = document.getElementById('graficoStockCategorias');
    const ctxGastos = document.getElementById('graficoGastosProveedor');
  
    if (!ctxProductos || !ctxStock || !ctxGastos) {
      console.warn('⛔ Elementos canvas no encontrados, abortando carga de gráficos.');
      return;
    }
  
    // Productos más comprados
    new Chart(ctxProductos, {
      type: 'bar',
      data: {
        labels: ['Cinta métrica', 'Martillo', 'Taladro', 'Llave Allen', 'Disco corte'],
        datasets: [{
          label: 'Unidades',
          data: [122, 95, 81, 64, 58],
          backgroundColor: '#0d6efd'
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
      }
    });
  
    // Stock por categoría
    new Chart(ctxStock, {
      type: 'doughnut',
      data: {
        labels: ['Herramientas', 'Eléctrico', 'Tornillería', 'Pinturas', 'Otros'],
        datasets: [{
          data: [120, 80, 95, 30, 37],
          backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6c757d']
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } }
      }
    });
  
    // Gastos por proveedor
    new Chart(ctxGastos, {
      type: 'bar',
      data: {
        labels: ['Ferremax', 'Herramientas SRL', 'InduPro', 'MaxiTool', 'ConstruMarket'],
        datasets: [{
          label: 'Gasto ($)',
          data: [18000, 12500, 9200, 7600, 5400],
          backgroundColor: '#198754'
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { x: { beginAtZero: true } }
      }
    });
  };
  