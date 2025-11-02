<?php
require __DIR__ . '../../../../../db/db.php';

try {
    $stmt = $pdo->prepare("
        SELECT 
            i.id_ingreso,
            i.id_categoria_ingreso,
            i.fecha,
            i.monto,
            i.metodo_pago,
            i.descripcion,
            i.nro_factura,
            c.nombre AS categoria,
            u.user AS responsable,
            u.id_usuario as id_usuario
        FROM ingresos i
        LEFT JOIN categorias_ingresos c ON i.id_categoria_ingreso = c.id_categoria_ingreso
        LEFT JOIN usuarios u ON i.id_usuario = u.id_usuario
        ORDER BY i.fecha DESC
    ");
    $stmt->execute();
    $ingresos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $ingresos = [];
}