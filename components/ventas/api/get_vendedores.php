<?php
// components/ventas/api/get_vendedores.php
require_once __DIR__ . '/../../db/db.php';
header('Content-Type: application/json; charset=utf-8');

if (!isset($pdo)) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT id_usuario, user, email, rol FROM usuarios ORDER BY user";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();

echo json_encode($rows);
