/*	Carga dinámica de componentes*/

import { initInicio } from './inicio.js';

loadComponent('./components/inicio/html/index.html', 'principalBody', () => {
  initInicio();
});


import { loadComponent } from './app.js'; // ajustá ruta



