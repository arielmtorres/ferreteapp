<?php
session_start(); 
require __DIR__ . '../../../../../db/db.php';

try {
    $id_ingreso = $_POST['id_ingreso'] ?? null;
    $id_categoria_ingreso = $_POST['id_categoria_ingreso'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;
    $monto = $_POST['monto'] ?? null;
    $id_usuario = $_POST['id_usuario'] ?? null;
    $nro_factura = $_POST['nro_factura'] ?? null;
    $metodo_pago = $_POST['metodo_pago'] ?? null;
    $fecha = date('Y-m-d');

    if (!$id_categoria_ingreso || !$descripcion || !$monto || !$id_usuario) {
        $_SESSION['error'] = "Datos incompletos";
        header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
        exit;
    }

    if ($id_ingreso) {
        // Actualizar ingreso existente
        $stmt = $pdo->prepare("UPDATE ingresos 
            SET id_categoria_ingreso=?, descripcion=?, monto=?, id_usuario=?, nro_factura=?, metodo_pago=?, fecha=? 
            WHERE id_ingreso=?");
        $stmt->execute([$id_categoria_ingreso, $descripcion, $monto, $id_usuario, $nro_factura, $metodo_pago, $fecha, $id_ingreso]);
        $_SESSION['success'] = "update-ingreso";
    } else {
        // Insertar nuevo ingreso
        $stmt = $pdo->prepare("INSERT INTO ingresos 
            (id_categoria_ingreso, descripcion, monto, id_usuario, nro_factura, metodo_pago, fecha)
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id_categoria_ingreso, $descripcion, $monto, $id_usuario, $nro_factura, $metodo_pago, $fecha]);
        $_SESSION['success'] = "insert-ingreso";
    }

    header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
    exit;

} catch (Exception $e) {
    $_SESSION['error'] = "Error al guardar el ingreso: " . $e->getMessage();
    header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
    exit;
}
