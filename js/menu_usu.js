// ==========================
// Desplegar menú de usuario
// ==========================

// Elementos del avatar, username y dropdown
const avatar = document.getElementById('avatar');
const username = document.querySelector('.username');
const dropdown = document.getElementById('user-dropdown');

// Función para alternar el dropdown
function toggleDropdown(event) {
  event.stopPropagation(); // Evita que el click se propague
  dropdown.classList.toggle('hidden');
}

// Mostrar/Ocultar menú al hacer clic en el avatar o username
avatar.addEventListener('click', toggleDropdown);
username.addEventListener('click', toggleDropdown);

// Cerrar menú si haces clic fuera del menú
document.addEventListener('click', (e) => {
  if (!dropdown.contains(e.target)) {
    dropdown.classList.add('hidden');
  }
});
