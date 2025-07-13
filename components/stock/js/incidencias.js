import { loadComponent } from '../../../js/incidenapp.js';

export function initIncidencias() {
    console.log('Gestión de Incidencias cargada correctamente');

    // -----------------------------
    // FILTRAR POR ESTADO
    // -----------------------------
    const filtroEstado = document.getElementById('filtroEstado');
    const tabla = document.querySelector('table.resumen tbody');

    if (filtroEstado && tabla) {
        filtroEstado.addEventListener('change', () => {
            const estadoSeleccionado = filtroEstado.value.toLowerCase();
            const filas = tabla.querySelectorAll('tr');

            filas.forEach(fila => {
                const estado = fila.cells[9]?.textContent.toLowerCase();
                if (estadoSeleccionado === "" || estado === estadoSeleccionado) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });
        });
    }

    // -----------------------------
    // SELECCIONAR FILA DE LA TABLA
    // -----------------------------
    const filas = document.querySelectorAll('table.resumen tbody tr');
    filas.forEach((fila) => {
        fila.addEventListener('click', function () {
            filas.forEach(f => f.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // -----------------------------
    // GESTIÓN DE MODAL (ASIGNAR PROVEEDOR)
    // -----------------------------
    const btnAbrirModal = document.getElementById('btn-asignar');
    const modal = document.getElementById('modal-proveedor');
    const btnCerrarModal = document.getElementById('btn-cerrar-modal');

    btnAbrirModal?.addEventListener('click', () => {
        modal.style.display = 'flex';
    });

    btnCerrarModal?.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // -----------------------------
    // GESTIÓN DE BOTONES (NUEVA, MODIFICAR, ELIMINAR)
    // -----------------------------
    const btnNueva = document.getElementById('btnNueva');
    const btnModificar = document.getElementById('btnModificar');
    const btnEliminar = document.getElementById('btnEliminar');

    btnNueva?.addEventListener('click', () => {
        loadComponent(
            'components/incidencias/html/inciNuev.html',
            'components/incidencias/css/formulario.css',
            'components/incidencias/js/inciNuev.js'
        );
    });

    btnModificar?.addEventListener('click', () => {
        const filaSeleccionada = document.querySelector('tr.selected');
        if (filaSeleccionada) {
            loadComponent(
                'components/incidencias/html/inciModi.html',
                'components/incidencias/css/formulario.css',
                'components/incidencias/js/inciModi.js'
            );
        } else {
            alert('Seleccioná una incidencia para modificar.');
        }
    });

    btnEliminar?.addEventListener('click', () => {
        const filaSeleccionada = document.querySelector('tr.selected');
        if (filaSeleccionada) {
            const id = filaSeleccionada.cells[0].textContent;
            const confirmacion = confirm(`¿Seguro que querés eliminar la incidencia ID ${id}?`);
            if (confirmacion) {
                loadComponent(
                    'components/incidencias/html/inciElim.html',
                    'components/incidencias/css/formulario.css',
                    'components/incidencias/js/inciElim.js'
                );
            }
        } else {
            alert('Seleccioná una incidencia para eliminar.');
        }
    });
}
