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

    if (!$egresos) {
        echo "<tr><td colspan='8'>No hay egresos registrados</td></tr>";
        exit;
    }

    foreach ($egresos as $eg) {
        $facturaBtn = $eg['nro_factura'] 
            ? "<button class='btn btn-sm btn-outline-primary'>Ver Factura</button>" 
            : "—";

        echo "
            <tr>
                <td>{$eg['fecha']}</td>
                <td>{$eg['categoria']}</td>
                <td>{$eg['descripcion']}</td>
                <td>$ {$eg['monto']}</td>
                <td>{$eg['responsable']}</td>
                <td>{$facturaBtn}</td>
                <td>{$eg['metodo_pago']}</td>
                <td>
                    <button class='btn btn-sm btn-warning' onclick='editarEgreso({$eg['id_egreso']})'>Editar</button>
                    <button class='btn btn-sm btn-danger' onclick='borrarEgreso({$eg['id_egreso']})'>Borrar</button>
                </td>
            </tr>
        ";
    }

} catch (PDOException $e) {
    echo "<tr><td colspan='8'>Error: ".$e->getMessage()."</td></tr>";
}
?>
