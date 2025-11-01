<?php
session_start();
require __DIR__ . '../../../../../db/db.php';


try {
    $id_egreso = $_POST['id_egreso'] ?? null;
    $id_categoria_egreso = $_POST['id_categoria_egreso'];
    $descripcion = $_POST['descripcion'];
    $monto = $_POST['monto'];
    $id_usuario = $_POST['id_usuario'];
    $nro_factura = $_POST['nro_factura'] ?? null;
    $metodo_pago = $_POST['metodo_pago'] ?? null;
    $fecha = date('Y-m-d');

    if ($id_egreso) {
        // Actualizar
        $stmt = $pdo->prepare("UPDATE egresos 
            SET id_categoria_egreso=?, descripcion=?, monto=?, id_usuario=?, nro_factura=?, metodo_pago=?, fecha=? 
            WHERE id_egreso=?");
        $stmt->execute([$id_categoria_egreso, $descripcion, $monto, $id_usuario, $nro_factura, $metodo_pago, $fecha, $id_egreso]);
        $_SESSION['success'] = "update-egreso";
    } else {
        // Insertar
        $stmt = $pdo->prepare("INSERT INTO egresos 
            (id_categoria_egreso, descripcion, monto, id_usuario, nro_factura, metodo_pago, fecha)
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id_categoria_egreso, $descripcion, $monto, $id_usuario, $nro_factura, $metodo_pago, $fecha]);
        $_SESSION['success'] = "insert-egreso";
    }

    header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
    exit;

} catch (Exception $e) {
    $_SESSION['error'] = "Error al guardar el egreso: " . $e->getMessage();
    header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
    exit;
}
