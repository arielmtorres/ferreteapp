import { loadComponent } from '../../../js/incidenapp.js';

export function initBorrarProveedor() {
    console.log('Vista borrar proveedor cargada');

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
