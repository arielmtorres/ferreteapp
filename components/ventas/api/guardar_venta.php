<?php
// components/ventas/api/guardar_venta.php
require_once __DIR__ . '/../../db/db.php';
header('Content-Type: application/json; charset=utf-8');

if (!isset($pdo)) {
    echo json_encode(['ok' => false, 'msg' => 'Sin conexión PDO']);
    exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
if (!$data) {
    echo json_encode(['ok' => false, 'msg' => 'JSON inválido']);
    exit;
}

$fecha   = $data['fecha'] ?? date('Y-m-d');
$vendedor = isset($data['vendedor']) ? (int)$data['vendedor'] : 0;
$detalle  = $data['detalle'] ?? [];
$obs      = $data['observaciones'] ?? '';

if ($vendedor <= 0) {
    echo json_encode(['ok' => false, 'msg' => 'Vendedor requerido']);
    exit;
}
if (empty($detalle)) {
    echo json_encode(['ok' => false, 'msg' => 'Detalle vacío']);
    exit;
}

// calcular total
$total = 0;
foreach ($detalle as $item) {
    $total += (float)$item['subtotal'];
}

try {
    // arrancamos transacción
    $pdo->beginTransaction();

    // insertar factura
    $sqlFactura = "
        INSERT INTO facturas (tipo, fecha, cuit, numero_cliente, monto_total, metodo_pago, id_usuario)
        VALUES ('A', :fecha, NULL, NULL, :total, 'Efectivo', :vendedor)
    ";
    $stmt = $pdo->prepare($sqlFactura);
    $stmt->execute([
        ':fecha'    => $fecha,
        ':total'    => $total,
        ':vendedor' => $vendedor
    ]);

    $idFactura = $pdo->lastInsertId();

    // insertar items
    $sqlItem = "
        INSERT INTO items_factura (id_factura, id_producto, cantidad, precio_unitario, total)
        VALUES (:id_factura, :id_producto, :cantidad, :precio_unitario, :total)
    ";
    $stmtItem = $pdo->prepare($sqlItem);

    foreach ($detalle as $item) {
        $stmtItem->execute([
            ':id_factura'     => $idFactura,
            ':id_producto'    => (int)$item['id_producto'],
            ':cantidad'       => (int)$item['cantidad'],
            ':precio_unitario'=> (float)$item['unitario'],
            ':total'          => (float)$item['subtotal'],
        ]);
    }

    $pdo->commit();

    echo json_encode(['ok' => true, 'id_factura' => $idFactura]);
} catch (PDOException $e) {
    $pdo->rollBack();
    echo json_encode(['ok' => false, 'msg' => $e->getMessage()]);
}
