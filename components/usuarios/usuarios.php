<section id="usuarios">
    <h2>Usuarios</h2>

    <!-- Tabla de usuarios -->
    <table id="tablaUsuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        
        <tbody>
            <!-- Se llena dinámicamente -->
        </tbody>
    </table>

    <!-- Formulario -->
    <form id="formularioUsuario">
        <h2 id="formTitulo">Crear nuevo usuario</h2>
        <input type="hidden" id="usuarioId">
        <label>Nombre:</label>
        <input type="text" id="nombre" required>
        <label>Email:</label>
        <input type="email" id="email" required>
        <label>Rol:</label>
        <select id="rol" required>
            <option value="Administrador">Administrador</option>
            <option value="Empleado">Empleado</option>
        </select>
        <button type="submit">Guardar</button>
    </form>

    <script>
        let usuarios = [
            { id: 1, nombre: "Juan Pérez", email: "juan@mail.com", rol: "Administrador" },
            { id: 2, nombre: "Lucía Gómez", email: "lucia@mail.com", rol: "Empleado" }
        ];

        const tabla = document.querySelector("#tablaUsuarios tbody");
        const form = document.getElementById("formularioUsuario");
        const inputId = document.getElementById("usuarioId");
        const inputNombre = document.getElementById("nombre");
        const inputEmail = document.getElementById("email");
        const inputRol = document.getElementById("rol");
        const formTitulo = document.getElementById("formTitulo");

        function renderTabla() {
            tabla.innerHTML = "";
            usuarios.forEach((u) => {
            tabla.innerHTML += `
                <tr>
                <td>${u.id}</td>
                <td>${u.nombre}</td>
                <td>${u.email}</td>
                <td>${u.rol}</td>
                <td>
                    <button onclick="editarUsuario(${u.id})">Editar</button>
                    <button onclick="eliminarUsuario(${u.id})">Eliminar</button>
                </td>
                </tr>
                `;
            });
        }

        function resetFormulario() {
            form.reset();
            inputId.value = "";
            formTitulo.textContent = "Crear nuevo usuario";
        }

        form.addEventListener("submit", (e) => {
            e.preventDefault();
            const id = inputId.value;
            const nombre = inputNombre.value;
            const email = inputEmail.value;
            const rol = inputRol.value;

            if (id) {
                // Editar
                const usuario = usuarios.find(u => u.id == id);
                usuario.nombre = nombre;
                usuario.email = email;
                usuario.rol = rol;
            } else {
                // Crear
                const nuevoUsuario = {
                id: Date.now(),
                nombre,
                email,
                rol
            };
            usuarios.push(nuevoUsuario);
            }

            renderTabla();
            resetFormulario();
        });

        function editarUsuario(id) {
            const usuario = usuarios.find(u => u.id === id);
            inputId.value = usuario.id;
            inputNombre.value = usuario.nombre;
            inputEmail.value = usuario.email;
            inputRol.value = usuario.rol;
            formTitulo.textContent = "Editar usuario";
        }

        function eliminarUsuario(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
                usuarios = usuarios.filter(u => u.id !== id);
                renderTabla();
            }
        }

        // Inicial
        renderTabla();
    </script>
</section>