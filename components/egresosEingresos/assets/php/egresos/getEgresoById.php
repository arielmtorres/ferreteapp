<?php
require __DIR__ . '../../../../../db/db.php';

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'ID no proporcionado']);
    exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM egresos WHERE id_egreso = ?");
$stmt->execute([$id]);
$egreso = $stmt->fetch(PDO::FETCH_ASSOC);

if ($egreso) {
    echo json_encode($egreso);
} else {
    echo json_encode(['error' => 'Egreso no encontrado']);
}
?>
