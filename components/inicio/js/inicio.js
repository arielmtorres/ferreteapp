/*	Lógica de inicialización del dashboard*/

import { cargarGraficoIncidentes } from './grafico_incidentes.js';

export async function initInicio() {
  console.log('Inicio cargado correctamente');

  // 🗓️ Obtener la fecha actual en Buenos Aires
  const fechaSpan = document.getElementById('fecha-hoy');
  if (fechaSpan) {
    const hoy = new Date().toLocaleDateString('es-AR', {
      timeZone: 'America/Argentina/Buenos_Aires',
      day: '2-digit',
      month: '2-digit',
      year: 'numeric'
    });
    fechaSpan.textContent = hoy;
  }

  // 📊 Simular fetch desde JSON local
  try {
    const response = await fetch('/components/inicio/json/incidentes.json');
    


    const datos = await response.json();

    // Insertar valores en las tarjetas
    document.querySelector('.status-card.resolved p').textContent = datos.resueltos;
    document.querySelector('.status-card.processing p').textContent = datos.en_proceso;
    document.querySelector('.status-card.alert p').textContent = datos.alerta;

    // Pasar datos al gráfico
    cargarGraficoIncidentes(datos);
  } catch (error) {
    console.error('Error al cargar los datos de incidentes:', error);
  }
}
