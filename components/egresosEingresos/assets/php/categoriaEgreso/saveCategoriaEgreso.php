<?php
session_start();
require __DIR__ . '../../../../../db/db.php';

try {
    $id_categoria_egreso = $_POST['id_categoria_egreso'] ?? null;
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'] ?? null;
    $id_usuario = $_POST['id_usuario'] ?? null; // Responsable
    $fecha_creacion = date('Y-m-d');

    if ($id_categoria_egreso) {
        // Actualizar categoría de egreso
        $stmt = $pdo->prepare("
            UPDATE categorias_egresos
            SET nombre = ?, descripcion = ?, id_usuario = ?, fecha_creacion = ?
            WHERE id_categoria_egreso = ?
        ");
        $stmt->execute([$nombre, $descripcion, $id_usuario, $fecha_creacion, $id_categoria_egreso]);
        $_SESSION['success'] = "update-categoria-egreso";
    } else {
        // Insertar nueva categoría de egreso
        $stmt = $pdo->prepare("
            INSERT INTO categorias_egresos (nombre, descripcion, id_usuario, fecha_creacion)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$nombre, $descripcion, $id_usuario, $fecha_creacion]);
        $_SESSION['success'] = "insert-categoria-egreso";
    }

    header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
    exit;

} catch (Exception $e) {
    $_SESSION['error'] = "Error al guardar la categoría de egreso: " . $e->getMessage();
    header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
    exit;
}
