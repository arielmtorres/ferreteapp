<?php
session_start();
require __DIR__ . '../../../../../db/db.php';

// Obtener el id del ingreso desde la URL
$id = $_GET['id'] ?? null;

if (!$id) {
    $_SESSION['error'] = "ID de ingreso no válido";
    header("Location: /ferreteapp/#/egresosEingresos");
    exit();
}

try {
    $stmt = $pdo->prepare("DELETE FROM ingresos WHERE id_ingreso = :id");
    $stmt->execute([':id' => $id]);

    $_SESSION['success'] = "delete-ingreso";
    header("Location: /ferreteapp/#/egresosEingresos");
    exit();

} catch (PDOException $e) {
    $_SESSION['error'] = "Error al eliminar el ingreso: " . $e->getMessage();
    header("Location: /ferreteapp/#/egresosEingresos");
    exit();
}
