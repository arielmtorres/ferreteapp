/*	Gráfico (Chart.js)*/

export function cargarGraficoIncidentes(datos = { resueltos: 0, en_proceso: 0, alerta: 0, no_resueltos: 0 }) {
  const ctx = document.getElementById('graficoIncidentes');

  if (!ctx) {
    console.error("No se encontró el canvas con id 'graficoIncidentes'");
    return;
  }

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Resuelto', 'En proceso', 'Alerta', 'No resuelto'],
      datasets: [{
        data: [
          datos.resueltos,
          datos.en_proceso,
          datos.alerta,
          datos.no_resueltos
        ],
        backgroundColor: [
          '#00a86b',
          '#0078bf',
          '#ffa500',
          '#e74c3c'
        ],
        borderColor: '#fff',
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' },
        title: {
          display: true,
          text: 'Estado de las Incidencias'
        }
      }
    }
  });
}
