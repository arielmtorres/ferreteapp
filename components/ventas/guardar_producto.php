<?php
header("Content-Type: application/json; charset=utf-8");

// Conexión
$mysqli = new mysqli("localhost", "root", "", "ferreteapp");
if ($mysqli->connect_errno) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Error de conexión: ' . $mysqli->connect_error]);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    echo json_encode(['success' => false, 'error' => 'Sin datos JSON']);
    exit;
}

$producto = $input['producto'] ?? '';
$ubicacion = $input['ubicacion'] ?? '';
$precio = $input['precio'] ?? 0;
$cantidad = $input['cantidad'] ?? 0;

if ($producto === '' || $ubicacion === '' || $cantidad <= 0) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit;
}

$stmt = $mysqli->prepare("INSERT INTO ventas_qr (producto, ubicacion, precio, cantidad) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssdi", $producto, $ubicacion, $precio, $cantidad);
$exito = $stmt->execute();

if (!$exito) {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
} else {
    echo json_encode(['success' => true, 'id' => $stmt->insert_id]);
}
$stmt->close();
$mysqli->close();
