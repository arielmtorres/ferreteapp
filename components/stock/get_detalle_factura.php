<?php
include(__DIR__ . "/../db/db.php");

if (!isset($_GET['id'])) {
  http_response_code(400);
  echo json_encode(["error" => "Falta el parámetro id"]);
  exit;
}

$id_factura = intval($_GET['id']);

try {
  // Obtenemos los datos generales de la factura
  $stmtFactura = $pdo->prepare("
    SELECT f.*, u.user AS usuario
    FROM facturas f
    LEFT JOIN usuarios u ON f.id_usuario = u.id_usuario
    WHERE f.id_factura = ?
  ");
  $stmtFactura->execute([$id_factura]);
  $factura = $stmtFactura->fetch();

  if (!$factura) {
    echo json_encode(["error" => "Factura no encontrada"]);
    exit;
  }

  // Obtenemos los productos de esa factura
  $stmtItems = $pdo->prepare("
    SELECT i.id_item, p.nombre AS producto, i.cantidad, i.precio_unitario, i.total
    FROM items_factura i
    INNER JOIN productos p ON i.id_producto = p.id_producto
    WHERE i.id_factura = ?
  ");
  $stmtItems->execute([$id_factura]);
  $items = $stmtItems->fetchAll();

  echo json_encode([
    "factura" => $factura,
    "items" => $items
  ]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(["error" => $e->getMessage()]);
}
?>
