<?php
require __DIR__ . '../../../../../db/db.php';

try {
    $stmt = $pdo->prepare("
        SELECT id_categoria_egreso, nombre, descripcion
        FROM categorias_egresos
        ORDER BY id_categoria_egreso ASC
    ");
    $stmt->execute();
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($categorias) {
        foreach ($categorias as $cat) {
            echo "
                <tr>
                    <td>{$cat['id_categoria_egreso']}</td>
                    <td>{$cat['nombre']}</td>
                    <td>{$cat['descripcion']}</td>
                    <td>
                        <button class='btn btn-warning btn-sm' onclick='editarCategoriaEgreso({$cat['id_categoria_egreso']})'>Editar</button>
                        <button class='btn btn-danger btn-sm' onclick='borrarCategoriaEgreso({$cat['id_categoria_egreso']})'>Borrar</button>
                    </td>
                </tr>
            ";
        }
    } else {
        echo "<tr><td colspan='4'>No hay categorías registradas</td></tr>";
    }

} catch (PDOException $e) {
    echo "<tr><td colspan='4'>Error: ".$e->getMessage()."</td></tr>";
}
