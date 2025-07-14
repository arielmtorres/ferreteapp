<?php
// login.php
session_start();

// Si ya estás logueado, redirige al index
if (!empty($_SESSION['user'])) {
  header('Location: index.php');
  exit;
}

// Procesa envío de formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user = $_POST['user']   ?? '';
  $pass = $_POST['pass']   ?? '';

  // Aquí validas contra JSON o BD; ejemplo básico:
  $users = json_decode(file_get_contents('json/usuarios.json'), true);
  foreach ($users as $u) {
    if ($u['user'] === $user && $u['pass'] === $pass) {
      $_SESSION['user'] = $user;
      header('Location: index.php');
      exit;
    }
  }
  $error = 'Credenciales inválidas';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login – FerreteApp</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
  <form method="POST" class="p-4 bg-white rounded shadow" style="width: 300px;">
    <h3 class="mb-3 text-center">FerreteApp</h3>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?=htmlspecialchars($error)?></div>
    <?php endif; ?>

    <div class="mb-3">
      <label class="form-label">Usuario</label>
      <input name="user" type="text" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Contraseña</label>
      <input name="pass" type="password" class="form-control" required>
    </div>

    <button class="btn btn-primary w-100">Ingresar</button>
  </form>
</body>
</html>
