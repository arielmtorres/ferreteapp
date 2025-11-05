<?php
// components/ventas/api/listar_ventas.php
require_once __DIR__ . '/../../db/db.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $sql = "
        SELECT 
            f.id_factura,
            u.usuario AS vendedor,
            GROUP_CONCAT(p.nombre ORDER BY p.nombre SEPARATOR ', ') AS productos,
            SUM(it.cantidad * it.precio_unitario) AS total
        FROM facturas f
        LEFT JOIN usuarios u      ON u.id_usuario = f.id_usuario
        JOIN items_factura it     ON it.id_factura = f.id_factura
        JOIN productos p          ON p.id_producto = it.id_producto
        GROUP BY f.id_factura, u.usuario
        ORDER BY f.id_factura DESC
        LIMIT 300
    ";
    $st = $pdo->query($sql);
    $rows = $st->fetchAll();
    echo json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
