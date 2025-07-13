export function loadComponent(url, contenedorId, callback) {
  fetch(url)
    .then(response => response.text())
    .then(html => {
      document.getElementById(contenedorId).innerHTML = html;
      if (callback) callback();
    })
    .catch(error => console.error('Error al cargar componente:', error));
}
