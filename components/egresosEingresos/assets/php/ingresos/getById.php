<?php
// Conexión a la base de datos
require __DIR__ . '../../../../../db/db.php';

// Obtener el ID recibido por POST
$id = isset($_POST['id_ingreso']) ? (int)$_POST['id_ingreso'] : 0;

// Si no hay ID, no hacemos nada
if ($id <= 0) {
    echo json_encode(null);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM ingresos WHERE id_ingreso = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($data);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
