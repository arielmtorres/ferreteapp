btnNueva.addEventListener('click', () => {
    loadComponent(
        'components/incidencias/html/inciNuev.html',
        'components/incidencias/css/formulario.css',
        'components/incidencias/js/inciNuev.js'
    );
});

btnModificar.addEventListener('click', () => {
    const fila = document.querySelector('tr.selected');
    if (fila) {
        const id = fila.cells[0].textContent;
        loadComponent(
            'components/incidencias/html/inciModi.html',
            'components/incidencias/css/formulario.css',
            'components/incidencias/js/inciModi.js'
        );
    } else {
        alert('Seleccioná una incidencia para modificar.');
    }
});

btnEliminar.addEventListener('click', () => {
    const fila = document.querySelector('tr.selected');
    if (fila) {
        const id = fila.cells[0].textContent;
        loadComponent(
            'components/incidencias/html/inciElim.html',
            'components/incidencias/css/formulario.css',
            'components/incidencias/js/inciElim.js'
        );
    } else {
        alert('Seleccioná una incidencia para eliminar.');
    }
});
