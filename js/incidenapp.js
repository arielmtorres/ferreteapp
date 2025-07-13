// ============================
// Archivo: incidenapp.js
// SPA modular para cargar vistas
// ============================

// ✅ Importar los inicializadores de cada componente
import { initInicio } from '../components/inicio/js/inicio.js';
import { initIncidencias } from '../components/incidencias/js/incidencias.js';
import { initProveedores } from '../components/proveedores/js/proveedores.js';
import { initTrazabilidad } from '../components/trazabilidad/js/trazabilidad.js';

// ============================
// Cargar eventos al iniciar la página
// ============================

document.addEventListener('DOMContentLoaded', () => {
  document.getElementById("opcInicio")?.addEventListener("click", cargarInicio);
  document.getElementById("opcIncidencias")?.addEventListener("click", cargarIncidencias);
  document.getElementById("opcProveedores")?.addEventListener("click", cargarProveedores);
  document.getElementById("opcTrazabilidad")?.addEventListener("click", cargarTrazabilidad);
});

// ============================
// Funciones para cargar vistas
// ============================

// ✔️ Inicio
async function cargarInicio() {
  principalHeader.innerText = "";
  await loadComponent(
    "components/inicio/html/index.html",
    "components/inicio/css/inicio.css"
  );
  initInicio();
}

// ✔️ Incidencias
async function cargarIncidencias() {
  principalHeader.innerText = "";
  await loadComponent(
    "components/incidencias/html/index.html",
    "components/incidencias/css/incidencias.css"
  );
  initIncidencias();
}

// ✔️ Proveedores
async function cargarProveedores() {
  principalHeader.innerText = "";
  await loadComponent(
    "components/proveedores/html/index.html",
    "components/proveedores/css/proveedores.css"
  );
  initProveedores();
}


// ✔️ Trazabilidad
async function cargarTrazabilidad() {
  principalHeader.innerText = "";
  await loadComponent(
    "components/trazabilidad/html/index.html",
    "components/trazabilidad/css/trazabilidad.css"
  );
  initTrazabilidad();
}

// ============================
// Función reutilizable para cargar cualquier componente
// ============================

export async function loadComponent(htmlPath, cssPath) {
  try {
    const response = await fetch(htmlPath);
    if (!response.ok) throw new Error("Error cargando componente");

    // ✔️ Inserta HTML en el contenedor principal
    principalBody.innerHTML = await response.text();

    // ✔️ Carga CSS si no está ya cargado
    if (cssPath && !document.querySelector(`link[href="${cssPath}"]`)) {
      const link = document.createElement("link");
      link.rel = "stylesheet";
      link.href = cssPath;
      document.head.appendChild(link);
    }

  } catch (error) {
    console.error("Error al cargar el componente:", error);
    principalBody.innerHTML = "<p style='color:red;'>Error al cargar el componente.</p>";
  }
}
