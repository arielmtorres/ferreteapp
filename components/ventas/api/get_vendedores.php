<?php
// components/ventas/api/get_vendedores.php
require_once __DIR__ . '/../../db/db.php';
header('Content-Type: application/json; charset=utf-8');

try {
    // Descubro cómo se llama la columna de usuario
    $colCandidates = ['usuario', 'username', 'nombre_usuario', 'nombre', 'email'];
    $colName = null;

    $sqlCols = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
                WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'usuarios'";
    $cols = $pdo->query($sqlCols)->fetchAll(PDO::FETCH_COLUMN);

    foreach ($colCandidates as $c) {
        if (in_array($c, $cols, true)) { $colName = $c; break; }
    }
    if (!$colName) { throw new Exception("No se encontró una columna de nombre de usuario en 'usuarios'"); }

    $stmt = $pdo->query("SELECT `$colName` AS vendedor FROM usuarios ORDER BY `$colName`");
    $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
    // Filtrar nulos/vacíos
    $out = array_values(array_filter(array_unique($rows), fn($v) => $v !== null && $v !== ''));

    echo json_encode($out, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
