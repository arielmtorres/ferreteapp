import { loadComponent } from '../../../js/incidenapp.js';

export function initTrazabilidad() {
    console.log('Gestión de Trazabilidad cargada correctamente');

    const tabla = document.getElementById('tablaIncidentes');
    if (!tabla) return;

    const cuerpo = tabla.querySelector('tbody');
    if (!cuerpo) return;

    const filtro = document.getElementById('filtroIncidentes');

    // 🎨 Colorear estado
    Array.from(cuerpo.rows).forEach(row => {
        const celdaEstado = row.cells[5];
        const estadoTexto = celdaEstado.textContent.trim().toLowerCase();

        switch (estadoTexto) {
            case 'resuelto':
                celdaEstado.classList.add('estado-resuelto');
                break;
            case 'en proceso':
                celdaEstado.classList.add('estado-en-proceso');
                break;
            case 'pendiente':
                celdaEstado.classList.add('estado-pendiente');
                break;
            case 'no iniciado':
                celdaEstado.classList.add('estado-no-iniciado');
                break;
        }
    });

    // 🟦 ✔️ Filtro funcional por ID
    if (filtro) {
        filtro.addEventListener('change', () => {
            const idSeleccionado = filtro.value.toLowerCase();
            const filas = cuerpo.querySelectorAll('tr');

            filas.forEach(fila => {
                const id = fila.cells[0].textContent.trim().toLowerCase();
                if (idSeleccionado === "" || id === idSeleccionado.replace('id ', '')) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });
        });
    }

    // 🔃 Ordenamiento por columnas
    let ordenAscendente = true;
    tabla.querySelectorAll('th[data-col]').forEach(th => {
        th.style.cursor = 'pointer';
        th.addEventListener('click', () => {
            const index = parseInt(th.dataset.col);
            const filas = Array.from(cuerpo.rows);

            filas.sort((a, b) => {
                let valA = a.cells[index].textContent.trim();
                let valB = b.cells[index].textContent.trim();

                if (!isNaN(valA) && !isNaN(valB)) {
                    valA = parseFloat(valA);
                    valB = parseFloat(valB);
                } else if (Date.parse(valA) && Date.parse(valB)) {
                    valA = new Date(valA);
                    valB = new Date(valB);
                }

                return ordenAscendente
                    ? valA > valB ? 1 : -1
                    : valA < valB ? 1 : -1;
            });

            filas.forEach(fila => cuerpo.appendChild(fila));
            ordenAscendente = !ordenAscendente;
        });
    });

    // 🔍 Botones Ver Detalle SPA
    const botonesDetalle = cuerpo.querySelectorAll('button');

    botonesDetalle.forEach(btn => {
        btn.addEventListener('click', () => {
            loadComponent(
                'components/trazabilidad/html/detalle.html',
                'components/trazabilidad/css/detalle.css',
                'components/trazabilidad/js/detalle.js'
            );
        });
    });
}
