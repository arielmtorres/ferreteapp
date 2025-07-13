async function login(event) {
  event.preventDefault();

  const emailInput = document.getElementById('user').value.trim().toLowerCase();
  const passwordInput = document.getElementById('password').value.trim().toLowerCase(); // case-insensitive

  // Validar formato email del dominio abc.gob.ar
  const regex = /^[a-z0-9._%+-]+@abc\.gob\.ar$/;
  if (!regex.test(emailInput)) {
    alert("El correo debe ser del dominio @abc.gob.ar");
    return;
  }

  try {
    const response = await fetch('/json/login.json'); // Asegurate que esté en esa ruta
    const usuarios = await response.json();

    const usuario = usuarios.find(
      u => u.email.toLowerCase() === emailInput && u.contraseña.toLowerCase() === passwordInput
    );

    if (usuario) {
      alert(`Bienvenido ${usuario.rol} - Usuario: ${usuario.email}`);
      window.location.href = 'index.html';
    } else {
      alert('Usuario o contraseña incorrectos.');
    }

  } catch (error) {
    console.error('Error al cargar usuarios:', error);
    alert('No se pudo acceder al sistema. Intente más tarde.');
  }
}

function togglePasswordVisibility() {
  const passwordInput = document.getElementById('password');
  passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
}

