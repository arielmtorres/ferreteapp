<?php
// components/ventas/api/listar_ventas.php
require_once __DIR__ . '/../../db/db.php';
header('Content-Type: application/json; charset=utf-8');

if (!isset($pdo)) {
    echo json_encode([]);
    exit;
}

/*
  En tu BD ahora mismo solo hay 3 facturas (41,42,43).
  Esto te va a devolver 3 filas. Eso es lo correcto.
*/
$sql = "
  SELECT 
    f.id_factura,
    f.fecha,
    u.user AS vendedor,
    GROUP_CONCAT(p.nombre SEPARATOR ', ') AS productos,
    SUM(it.total) AS total
  FROM facturas f
  INNER JOIN usuarios u ON u.id_usuario = f.id_usuario
  INNER JOIN items_factura it ON it.id_factura = f.id_factura
  INNER JOIN productos p ON p.id_producto = it.id_producto
  GROUP BY f.id_factura, f.fecha, u.user
  ORDER BY f.fecha DESC, f.id_factura DESC
";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();

echo json_encode($rows);
