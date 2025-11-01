<?php
session_start(); 


require __DIR__ . '../../../../../db/db.php';


$id = $_POST['id_egreso'] ?? null;
$categoria = $_POST['id_categoria_egreso'] ?? null;
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
        // Actualizar egreso existente
        $stmt = $pdo->prepare("
            UPDATE egresos SET
                id_categoria_egreso = :categoria,
                descripcion = :descripcion,
                monto = :monto,
                id_usuario = :responsable,
                metodo_pago = :metodo,
                nro_factura = :factura
            WHERE id_egreso = :id
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
        echo "update-egreso";
    } else {
        // Insertar nuevo egreso
        $stmt = $pdo->prepare("
            INSERT INTO egresos 
            (id_categoria_egreso, descripcion, monto, id_usuario, metodo_pago, nro_factura, fecha)
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
        echo "insert-egreso";
    }

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
