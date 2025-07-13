import { loadComponent } from '../../../js/incidenapp.js';

export function initProveedores() {
    console.log("Gestión de Proveedores cargada correctamente");

    const filtro = document.getElementById('filtroProveedores');
    const tabla = document.querySelector('table.resumen tbody');

    if (filtro && tabla) {
        filtro.addEventListener('change', () => {
            const idSeleccionado = filtro.value.toLowerCase();
            const filas = tabla.querySelectorAll('tr');

            filas.forEach(fila => {
                const id = fila.cells[0].textContent.toLowerCase();
                if (idSeleccionado === "" || id === idSeleccionado.replace('id ', '')) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });
        });
    }

    const filas = tabla?.querySelectorAll('tr') || [];

    filas.forEach(fila => {
        fila.addEventListener('click', () => {
            filas.forEach(f => f.classList.remove('selected'));
            fila.classList.add('selected');
        });
    });

    const btnNuevo = document.getElementById('btnNuevoProveedor');
    const btnEditar = document.getElementById('btnEditarProveedor');
    const btnBorrar = document.getElementById('btnBorrarProveedor');

    btnNuevo?.addEventListener('click', () => {
        loadComponent(
            'components/proveedores/html/nuevo.html',
            'components/proveedores/css/formulario.css'
        );
    });

    btnEditar?.addEventListener('click', () => {
        const seleccionado = document.querySelector('tr.selected');
        if (seleccionado) {
            loadComponent(
                'components/proveedores/html/editar.html',
                'components/proveedores/css/formulario.css'
            );
        } else {
            alert('Seleccioná un proveedor para editar');
        }
    });

    btnBorrar?.addEventListener('click', () => {
        const seleccionado = document.querySelector('tr.selected');
        if (seleccionado) {
            loadComponent(
                'components/proveedores/html/borrar.html',
                'components/proveedores/css/formulario.css'
            );
        } else {
            alert('Seleccioná un proveedor para borrar');
        }
    });

    // ✅ Botones dentro de borrar.html
    const btnCancelar = document.getElementById('btn-cancelar-borrar');
    const btnConfirmar = document.getElementById('confirmar-borrar');

    btnCancelar?.addEventListener('click', () => {
        loadComponent(
            'components/proveedores/html/index.html',
            'components/proveedores/css/proveedores.css'
        );
    });

    btnConfirmar?.addEventListener('click', () => {
        alert('Proveedor eliminado correctamente (simulado)');
        loadComponent(
            'components/proveedores/html/index.html',
            'components/proveedores/css/proveedores.css'
        );
    });
}
