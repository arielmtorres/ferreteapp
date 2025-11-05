<?php
// components/ventas/api/buscar_productos.php
require_once __DIR__ . '/../../db/db.php';
header('Content-Type: application/json; charset=utf-8');

if (!isset($pdo)) {
    echo json_encode(['error' => 'Sin conexión PDO']);
    exit;
}

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($q === '') {
    echo json_encode([]);
    exit;
}

$sql = "
    SELECT id_producto, nombre, descripcion, precio, id_categoria
    FROM productos
    WHERE nombre LIKE :term
       OR id_producto = :idprod
    ORDER BY nombre
    LIMIT 20
";
$stmt = $pdo->prepare($sql);
$like = "%{$q}%";
$idprod = (int)$q;
$stmt->bindValue(':term', $like, PDO::PARAM_STR);
$stmt->bindValue(':idprod', $idprod, PDO::PARAM_INT);
$stmt->execute();

$rows = $stmt->fetchAll();
echo json_encode($rows);
