/*	Carga dinámica de componentes*/

import { initInicio } from './_inicio.js';

loadComponent('./components/inicio/html/index.html', 'principalBody', () => {
  initInicio();
});


import { loadComponent } from './_app.js'; // ajustá ruta



