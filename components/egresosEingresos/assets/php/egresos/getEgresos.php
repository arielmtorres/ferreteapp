<?php
require __DIR__ . '../../../../../db/db.php';

try {
    $stmt = $pdo->prepare("
        SELECT 
            e.id_egreso,
            e.fecha,
            e.monto,
            e.metodo_pago,
            e.descripcion,
            e.nro_factura,
            c.nombre AS categoria,
            u.user AS responsable
        FROM egresos e
        LEFT JOIN categorias_egresos c ON e.id_categoria_egreso = c.id_categoria_egreso
        LEFT JOIN usuarios u ON e.id_usuario = u.id_usuario
        ORDER BY e.fecha DESC
    ");
    $stmt->execute();
    $egresos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $errorMsg = $e->getMessage();
}
?>