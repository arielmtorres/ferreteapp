// ✅ app.js (modularizado como initIncidencias)

export function initIncidencias() {
  let datosIncidencias = [];

  const tbody = document.querySelector(".resumen tbody");
  const modal = document.getElementById("modalIncidencia");
  const closeBtn = document.querySelector(".close");
  const form = document.getElementById("formIncidencia");
  const tituloModal = document.getElementById("modalTitulo");

  const btnNueva = document.getElementById("btnNueva");
  const btnModificar = document.getElementById("btnModificar");
  const btnEliminar = document.getElementById("btnEliminar");

  let modo = "nueva";
  let indiceSeleccionado = null;

  function cargarTabla() {
    tbody.innerHTML = "";
    datosIncidencias.forEach((item, index) => {
      const fila = document.createElement("tr");
      fila.innerHTML = `
        <td>${item.id}</td>
        <td>${item.nivel}</td>
        <td>${item.escuela}</td>
        <td>${item.seccion}</td>
        <td>${item.subgrupo}</td>
        <td>${item.area}</td>
        <td>${item.fecha}</td>
        <td>${item.proveedor}</td>
        <td>${item.cuit}</td>
        <td>${item.estado}</td>
        <td>
          <button onclick="seleccionar(${index})">Seleccionar</button>
        </td>
      `;
      tbody.appendChild(fila);
    });
  }

  window.seleccionar = function (index) {
    indiceSeleccionado = index;
    const dato = datosIncidencias[index];
    const inputs = form.elements;

    inputs.indice.value = index;
    inputs.id.value = dato.id;
    inputs.nivel.value = dato.nivel;
    inputs.escuela.value = dato.escuela;
    inputs.seccion.value = dato.seccion;
    inputs.subgrupo.value = dato.subgrupo;
    inputs.area.value = dato.area;
    inputs.fecha.value = dato.fecha;
    inputs.proveedor.value = dato.proveedor;
    inputs.cuit.value = dato.cuit;
    inputs.estado.value = dato.estado;
  };

  btnNueva.onclick = () => {
    modo = "nueva";
    tituloModal.textContent = "Nueva Incidencia";
    form.reset();
    modal.style.display = "block";
  };

  btnModificar.onclick = () => {
    if (indiceSeleccionado === null) {
      alert("Seleccioná una incidencia primero.");
      return;
    }
    modo = "modificar";
    tituloModal.textContent = "Modificar Incidencia";
    modal.style.display = "block";
  };

  btnEliminar.onclick = () => {
    if (indiceSeleccionado === null) {
      alert("Seleccioná una incidencia para eliminar.");
      return;
    }
    const confirmacion = confirm("¿Deseás eliminar esta incidencia?");
    if (confirmacion) {
      datosIncidencias.splice(indiceSeleccionado, 1);
      indiceSeleccionado = null;
      cargarTabla();
    }
  };

  closeBtn.onclick = () => {
    modal.style.display = "none";
  };

  window.onclick = (e) => {
    if (e.target == modal) {
      modal.style.display = "none";
    }
  };

  form.onsubmit = (e) => {
    e.preventDefault();
    const data = Object.fromEntries(new FormData(form));

    if (modo === "nueva") {
      datosIncidencias.push(data);
    } else if (modo === "modificar" && indiceSeleccionado !== null) {
      datosIncidencias[indiceSeleccionado] = data;
    }

    cargarTabla();
    modal.style.display = "none";
    form.reset();
    indiceSeleccionado = null;
  };

  fetch("components/incidencias/json/datos.json")
    .then((response) => {
      if (!response.ok) throw new Error("No se pudo cargar datos.json");
      return response.json();
    })
    .then((data) => {
      datosIncidencias = data;
      cargarTabla();
    })
    .catch((error) => {
      console.error("❌ Error al cargar datos:", error);
    });
}
