<?php
require __DIR__ . '../../../../../db/db.php';

try {
    $stmt = $pdo->prepare("
        SELECT c.id_categoria_ingreso, c.nombre, c.descripcion, u.user AS responsable
        FROM categorias_ingresos c
        LEFT JOIN usuarios u ON c.id_usuario = u.id_usuario
        ORDER BY c.id_categoria_ingreso ASC
    ");
    $stmt->execute();
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<tr><td colspan='5'>Error: ".$e->getMessage()."</td></tr>";
}
?>
