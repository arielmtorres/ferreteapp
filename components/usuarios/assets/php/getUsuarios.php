<?php
// Iniciar sesión y conectar a la DB
session_start();
require __DIR__ . '../../../../db/db.php';

// Traer todos los usuarios
try {
    $stmt = $pdo->query("SELECT id_usuario, user, email, rol FROM usuarios ORDER BY user ASC");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $errorMsg = "Error al traer usuarios: " . $e->getMessage();
    $usuarios = [];
}
?>
