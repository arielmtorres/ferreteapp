// js/app.js

document.addEventListener('DOMContentLoaded', () => {
  // Carga la sección inicial y ataja cambios de hash
  navigate();
  window.addEventListener('hashchange', navigate);
});

function navigate() {
  // #/inicio → 'inicio', o 'inicio' si no hay hash
  const page = location.hash.replace(/^#\//, '') || 'inicio';
  const url  = `components/${page}/${page}.php`;
  const container = document.getElementById('principalBody');

  fetch(url)
    .then(res => {
      if (!res.ok) throw new Error(`No existe ${url}`);
      return res.text();
    })
    .then(html => {
      container.innerHTML = html;
      // Inicializa lógica específica si la hubiese
      if (typeof window[`init${capitalize(page)}`] === 'function') {
        window[`init${capitalize(page)}`]();
      }
    })
    .catch(err => {
      console.error(err);
      container.innerHTML = `<p class="text-danger">Sección "${page}" no disponible.</p>`;
    });
}

function capitalize(s) {
  return s.charAt(0).toUpperCase() + s.slice(1);
}

// --- Ejemplo de init para stock (si lo tienes) --- 
window.initStock = function() {
  const tbody = document.getElementById('stockTableBody');
  if (!tbody) return;
  fetch('json/stock.json')
    .then(r=>r.json())
    .then(data=>{
      tbody.innerHTML = data.map(item=>`
        <tr>
          <td>${item.nombre}</td>
          <td>${item.ubicacion}</td>
          <td>${item.cantidad}</td>
          <td>$${item.precio}</td>
        </tr>
      `).join('');
    })
    .catch(console.error);
};

// --- Y un init para inicio si lo necesitas ---
window.initInicio = function() {
  const fechaEl = document.getElementById('fecha-hoy');
  if (fechaEl) fechaEl.textContent = new Date().toLocaleDateString();
};
