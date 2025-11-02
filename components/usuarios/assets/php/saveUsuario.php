<?php
require __DIR__ . '../../../../db/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = $_POST['id_usuario'] ?? null; // Nuevo
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $rol = $_POST['rol'] ?? '';

    if (empty($nombre) || empty($email) || empty($rol)) {
        echo json_encode(['success' => false, 'msg' => 'Todos los campos son obligatorios']);
        exit;
    }

    $rolDB = $rol === 'Administrador' ? 'ADMIN' : 'EMPLEADO';

    try {
        if ($idUsuario) {
            // UPDATE
            $stmt = $pdo->prepare("UPDATE usuarios SET user = :user, email = :email, rol = :rol WHERE id_usuario = :id");
            $stmt->execute([
                ':user' => $nombre,
                ':email' => $email,
                ':rol' => $rolDB,
                ':id' => $idUsuario
            ]);
            echo json_encode(['success' => true, 'msg' => 'Usuario actualizado correctamente']);
        } else {
            // INSERT
            $stmt = $pdo->prepare("INSERT INTO usuarios (user, email, rol) VALUES (:user, :email, :rol)");
            $stmt->execute([
                ':user' => $nombre,
                ':email' => $email,
                ':rol' => $rolDB
            ]);
            echo json_encode(['success' => true, 'msg' => 'Usuario agregado correctamente']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'msg' => 'Error al guardar usuario: '.$e->getMessage()]);
    }
}
?>
