<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Consejo Escolar</title>
  <link rel="stylesheet" href="./css/login.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
</head>

<body>
  <header>
    <img src="img/logoF.png" alt="Logo ferreteapp" class="logo" />
  </header>

  <main>
    <section class="login-container">
      <h3>INICIAR SESIÓN</h3>

      <!--
      <form onsubmit="return login(event)" novalidate>
        <div class="form-group">
          <label for="role">ROL</label>
          <select id="role" name="role" required>
            <option value="">Seleccione un rol</option>
            <option value="administrador">ADMINISTRADOR</option>
            <option value="empleado">EMPLEADO</option>
          </select>
        </div>
        -->
        <div class="form-group">
          <label for="user">USUARIO</label>
          <input type="text" id="user" name="user" required />
          <!--<small class="hint">Utilizar mail de @abc.gob.ar o @gmail.com</small>-->
        </div>

        <div class="form-group">
          <label for="password">CONTRASEÑA</label>
          <input type="password" id="password" required />
          <div class="show-password">
            <!--<input type="checkbox" id="togglePassword" onclick="togglePasswordVisibility()" />
            <label for="togglePassword">Mostrar</label>-->
          </div>
        </div>

        <button type="submit"><a href="index.php">Ingresar</a></button>
      </form>
    </section>
  </main>

  
  <script src="./js/login.js"></script>
</body>
</html>
