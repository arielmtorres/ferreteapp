<?php
session_start();
require __DIR__ . '../../../../../db/db.php';

try {
    $id_categoria_ingreso = $_POST['id_categoria_ingreso'] ?? null;
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'] ?? null;
    $id_usuario = $_POST['id_usuario'] ?? null; // Responsable
    $fecha_creacion = date('Y-m-d');

    if ($id_categoria_ingreso) {
        // Actualizar categoría
        $stmt = $pdo->prepare("
            UPDATE categorias_ingresos
            SET nombre = ?, descripcion = ?, id_usuario = ?, fecha_creacion = ?
            WHERE id_categoria_ingreso = ?
        ");
        $stmt->execute([$nombre, $descripcion, $id_usuario, $fecha_creacion, $id_categoria_ingreso]);
        $_SESSION['success'] = "update-categoria-ingreso";
    } else {
        // Insertar nueva categoría
        $stmt = $pdo->prepare("
            INSERT INTO categorias_ingresos (nombre, descripcion, id_usuario, fecha_creacion)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$nombre, $descripcion, $id_usuario, $fecha_creacion]);
        $_SESSION['success'] = "insert-categoria-ingreso";
    }

    header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
    exit;

} catch (Exception $e) {
    $_SESSION['error'] = "Error al guardar la categoría: " . $e->getMessage();
    header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
    exit;
}
