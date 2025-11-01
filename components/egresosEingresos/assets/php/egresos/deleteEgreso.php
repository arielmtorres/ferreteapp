<?php
session_start();
require __DIR__ . '../../../../../db/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    $_SESSION['error'] = "ID no proporcionado.";
    header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
    exit();
}

try {
    $stmt = $pdo->prepare("DELETE FROM egresos WHERE id_egreso = :id");
    $stmt->execute([':id' => $id]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['success'] = "delete-egreso";
    } else {
        $_SESSION['error'] = "No se encontró el egreso.";
    }

    header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
    exit();
} catch (PDOException $e) {
    $_SESSION['error'] = "Error al eliminar el egreso: " . $e->getMessage();
    header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
    exit();
}
