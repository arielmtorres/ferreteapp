<?php
session_start(); 


require __DIR__ . '../../../../../db/db.php';

$id = $_POST['id_ingreso'] ?? null;
$categoria = $_POST['id_categoria_ingreso'] ?? null;
$descripcion = $_POST['descripcion'] ?? null;
$monto = $_POST['monto'] ?? null;
$responsable = $_POST['id_usuario'] ?? null;
$metodo = $_POST['metodo_pago'] ?? null;
$factura = $_POST['nro_factura'] ?? null;

if (!$categoria || !$descripcion || !$monto || !$responsable) {
    echo "Datos incompletos";
    exit;
}


try {
    if ($id) {
        $stmt = $pdo->prepare("
            UPDATE ingresos SET
                id_categoria_ingreso = :categoria,
                descripcion = :descripcion,
                monto = :monto,
                id_usuario = :responsable,
                metodo_pago = :metodo,
                nro_factura = :factura
            WHERE id_ingreso = :id
        ");
        $stmt->execute([
            ':categoria' => $categoria,
            ':descripcion' => $descripcion,
            ':monto' => $monto,
            ':responsable' => $responsable,
            ':metodo' => $metodo,
            ':factura' => $factura,
            ':id' => $id
        ]);
        $action = "update-ingreso";
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO ingresos 
            (id_categoria_ingreso, descripcion, monto, id_usuario, metodo_pago, nro_factura, fecha)
            VALUES
            (:categoria, :descripcion, :monto, :responsable, :metodo, :factura, CURDATE())
        ");
        $stmt->execute([
            ':categoria' => $categoria,
            ':descripcion' => $descripcion,
            ':monto' => $monto,
            ':responsable' => $responsable,
            ':metodo' => $metodo,
            ':factura' => $factura
        ]);
        $action = "insert-ingreso";
    }

   $action = $id ? "update-ingreso" : "insert-ingreso";

    $_SESSION['success'] = $action; // guardo en sesión
    header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
    exit();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
