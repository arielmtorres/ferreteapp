
document.addEventListener("DOMContentLoaded", () => {
  



$(document).on('click', '.btn-editar', function () {
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










});
