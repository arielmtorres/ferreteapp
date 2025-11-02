document.addEventListener("DOMContentLoaded", () => {

document.getElementById('form-usuario').addEventListener('submit', function(e) {
    e.preventDefault();

    const nombre = document.getElementById('nombreUsuario').value;
    const email = document.getElementById('emailUsuario').value;
    const rol = document.getElementById('rolUsuario').value;
    const id = document.getElementById('idUsuario').value; // <- agregado

    const formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('email', email);
    formData.append('rol', rol);
    if (id) formData.append('idUsuario', id); // <- si existe, enviar para update

    fetch('assets/php/saveUsuario.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.msg);
        if (data.success) {
            const modalEl = document.getElementById('modal-agregar-usuario');
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();

            this.reset();
            document.getElementById('idUsuario').value = ''; // limpiar id
            location.reload();
        }
    })
    .catch(err => {
        console.error(err);
        alert('Ocurrió un error al guardar el usuario');
    });
});



const modalEl = document.getElementById('modal-agregar-usuario');
modalEl.addEventListener('hidden.bs.modal', () => {
    document.getElementById('form-usuario').reset();
    document.getElementById('idUsuario').value = '';
    document.getElementById('modalAgregarUsuarioLabel').textContent = '➕ Agregar Usuario';
    document.querySelector('#form-usuario button[type="submit"]').textContent = 'Guardar Usuario';
});






});



function borrarUsuario(id) {
    if (!confirm("¿Estás seguro de que quieres eliminar este usuario?")) return;

    $.post('/ferreteApp/components/usuarios/assets/php/deleteUsuario.php', { id_usuario: id }, function(res) {
        if (res.success) {
            alert(res.msg);
            // Eliminar fila de la tabla
            const fila = document.querySelector(`#tabla-usuarios tr td:first-child[textContent='${id}']`)?.parentElement;
            if (fila) fila.remove();
            // O simplemente recargar la tabla con getUsuarios
            location.reload();
        } else {
            alert(res.msg);
        }
    }, 'json');
}


function editarUsuario(id) {
    const filas = document.querySelectorAll('#tabla-usuarios tbody tr');
    let fila;

    filas.forEach(f => {
        if (f.children[0].textContent == id) fila = f;
    });

    if (!fila) return;

    const nombre = fila.children[1].textContent;
    const email = fila.children[2].textContent;
    const rol = fila.children[3].textContent;

    // Llenar modal
    $('#nombreUsuario').val(nombre);
    $('#emailUsuario').val(email);
    $('#rolUsuario').val(rol === 'Administrador' ? 'Administrador' : 'Empleado');
    $('#idUsuario').val(id);

    // Cambiar título y botón del modal
    const modalTitle = document.getElementById('modalAgregarUsuarioLabel');
    modalTitle.textContent = '✏️ Editar Usuario';
    const submitBtn = document.querySelector('#form-usuario button[type="submit"]');
    submitBtn.textContent = 'Actualizar Usuario';

    // Abrir modal
    const modal = new bootstrap.Modal(document.getElementById('modal-agregar-usuario'));
    modal.show();
}
