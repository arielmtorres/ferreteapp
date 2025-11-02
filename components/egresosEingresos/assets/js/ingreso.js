
document.addEventListener("DOMContentLoaded", () => {
  



$(document).on('click', '.btn-editar-ingreso', function () {
    const id = $(this).data('id');

    $.ajax({
        url: '/ferreteApp/components/egresosEingresos/assets/php/ingresos/getById.php',
        type: 'POST',
        data: { id_ingreso: id },
        dataType: 'json',
        success: function (data) {
            if (data) {
                // Rellenar los campos
                $('#id_ingreso').val(data.id_ingreso);
                $('#id_categoria_ingreso').val(data.id_categoria_ingreso);
                $('#descripcion').val(data.descripcion);
                $('#monto').val(data.monto);
                $('#id_usuario').val(data.id_usuario);
                $('#metodo_pago').val(data.metodo_pago);
                $('#nro_factura').val(data.nro_factura);

                // Cambiar título y acción del formulario
                $('#tituloModal').text('Editar Ingreso');
                $('#formIngreso').attr('action', '/ferreteApp/components/egresosEingresos/assets/php/ingresos/saveIngreso.php');

                // Mostrar modal con Bootstrap 5
                const modal = new bootstrap.Modal(document.getElementById('modalIngreso'));
                modal.show();
            } else {
                alert('No se encontraron datos del ingreso.');
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
            alert('Error al cargar los datos del ingreso.');
        }
        
    });
});

// Cuando se cierra el modal, limpiar todo
document.getElementById('modalIngreso').addEventListener('hidden.bs.modal', function () {
  const form = document.getElementById('formIngreso');
  form.reset(); // Limpia los campos
  document.getElementById('id_ingreso').value = ''; // Limpia el hidden ID
  document.getElementById('tituloModal').textContent = 'Agregar Ingreso';
  document.getElementById('btnGuardar').textContent = 'Guardar';
});





document.querySelectorAll(".btn-editar-egreso").forEach(btn => {
  btn.addEventListener("click", async function () {
    const id = this.getAttribute("data-id");

    try {
      const response = await fetch(`/ferreteApp/components/egresosEingresos/assets/php/egresos/getEgresoById.php?id=${id}`);
      const data = await response.json();

      if (data.error) {
        alert(data.error);
        return;
      }

      // Cargar datos en el modal
      document.getElementById("id_egreso").value = data.id_egreso;
      document.getElementById("id_categoria_egreso").value = data.id_categoria_egreso;
      document.getElementById("descripcion_egreso").value = data.descripcion;
      document.getElementById("monto_egreso").value = data.monto;
      document.getElementById("id_usuario_egreso").value = data.id_usuario || "";
      document.getElementById("metodo_pago_egreso").value = data.metodo_pago || "";
      document.getElementById("nro_factura_egreso").value = data.nro_factura || "";

      // Cambiar título y botón
      document.getElementById("tituloModalEgreso").innerText = "Editar Egreso";
      document.getElementById("btnGuardarEgreso").innerText = "Actualizar";

      // Abrir modal
      const modal = new bootstrap.Modal(document.getElementById("modalEgreso"));
      modal.show();

    } catch (err) {
      console.error(err);
      alert("Error al cargar el egreso.");
    }
  });
});


  // Cuando se cierra el modal, limpiar formulario
  const modalEgreso = document.getElementById("modalEgreso");
  modalEgreso.addEventListener("hidden.bs.modal", () => {
    document.getElementById("formEgreso").reset();
    document.getElementById("id_egreso").value = "";
    document.getElementById("tituloModalEgreso").innerText = "Agregar Egreso";
    document.getElementById("btnGuardarEgreso").innerText = "Guardar";
  });





  /*------------------------------------------------ CATEGORIAS ------------------------------------------ */

  document.getElementById('btnAgregarCategoriaIngreso').addEventListener('click', () => {
    // Limpiar formulario
    document.getElementById('formCategoriaIngreso').reset();
    document.getElementById('id_categoria_ingreso').value = '';
    document.getElementById('tituloModalCategoriaIngreso').textContent = 'Agregar Categoría';
    document.getElementById('btnGuardarCategoria').textContent = 'Guardar';

    // Mostrar modal
    const modal = new bootstrap.Modal(document.getElementById('modalCategoriaIngreso'));
    modal.show();
});



// Botón para abrir modal Categoría Egreso
  document.getElementById('btnAgregarCategoriaEgreso')?.addEventListener('click', function() {
    // Limpiar los campos del modal
    document.getElementById('id_categoria_egreso_modal').value = '';
    document.getElementById('nombre_categoria_egreso').value = '';
    document.getElementById('descripcion_categoria_egreso').value = '';
    document.getElementById('id_usuario_categoria_egreso').value = '';

    // Cambiar título
    document.getElementById('tituloModalCategoriaEgreso').textContent = 'Agregar Categoría';

    // Abrir modal
    var modal = new bootstrap.Modal(document.getElementById('modalCategoriaEgreso'));
    modal.show();
  });

 



});



function editarCategoria(id) {
    // Buscar los datos de la fila directamente en la tabla
    const fila = document.querySelector(`#tabla-categorias-ingresos tr td:first-child[textContent='${id}']`)?.parentElement;

    // Otra opción más sencilla: pasar los datos desde PHP usando dataset
    const btn = event.currentTarget;
    const tr = btn.closest('tr');
    const nombre = tr.children[1].textContent.trim();
    const descripcion = tr.children[2].textContent.trim();
    const responsable = tr.children[3].getAttribute('data-usuario-id'); // si lo tenés en un atributo

    // Rellenar el modal
    document.getElementById('id_categoria_ingreso').value = id;
    document.getElementById('nombre_categoria').value = nombre;
    document.getElementById('descripcion_categoria').value = descripcion;

    // Seleccionar responsable en el select
    const select = document.getElementById('id_usuario_categoria');
    for (let i=0; i < select.options.length; i++) {
        if (select.options[i].text === responsable || select.options[i].value == responsable) {
            select.selectedIndex = i;
            break;
        }
    }

    // Cambiar título del modal
    document.getElementById('tituloModalCategoriaIngreso').textContent = 'Editar Categoría';

    // Abrir modal usando Bootstrap 5
    const modal = new bootstrap.Modal(document.getElementById('modalCategoriaIngreso'));
    modal.show();
}


 // Función para editar categoría de egreso
  function editarCategoriaEgreso(id) {
    // Buscar la fila por data-id
    const fila = document.querySelector(`#tabla-categorias-egresos tr[data-id='${id}']`);
    if (!fila) return;

    document.getElementById('id_categoria_egreso_modal').value = id;
    document.getElementById('nombre_categoria_egreso').value = fila.children[1].textContent;
    document.getElementById('descripcion_categoria_egreso').value = fila.children[2].textContent;
    document.getElementById('id_usuario_categoria_egreso').value = fila.children[3].textContent;

    document.getElementById('tituloModalCategoriaEgreso').textContent = 'Editar Categoría';

    const modal = new bootstrap.Modal(document.getElementById('modalCategoriaEgreso'));
    modal.show();
}


  function borrarCategoriaEgreso(id) {
    if (confirm('¿Seguro que deseas eliminar esta categoría?')) {
      window.location.href = `/ferreteApp/components/egresosEingresos/assets/php/categoriaEgreso/deleteCategoriaEgreso.php?id=${id}`;
    }
  }