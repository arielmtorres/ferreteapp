<?php
require __DIR__ . '../../../../../db/db.php';



try {
    $stmt = $pdo->prepare("
        SELECT id_categoria_ingreso, nombre, descripcion
        FROM categorias_ingresos
        ORDER BY id_categoria_ingreso ASC
    ");
    $stmt->execute();
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($categorias) {
        foreach ($categorias as $cat) {
            echo "
                <tr>
                    <td>{$cat['id_categoria_ingreso']}</td>
                    <td>{$cat['nombre']}</td>
                    <td>{$cat['descripcion']}</td>
                    <td>
                        <button class='btn btn-warning btn-sm' onclick='editarCategoria({$cat['id_categoria_ingreso']})'>Editar</button>
                        <button class='btn btn-danger btn-sm' onclick='borrarCategoria({$cat['id_categoria_ingreso']})'>Borrar</button>
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
?>
