<?php
session_start();
require __DIR__ . '../../../../../db/db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM categorias_ingresos WHERE id_categoria_ingreso = ?");
        $stmt->execute([$id]);

        $_SESSION['success'] = 'delete-categoria-ingreso';
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error al eliminar la categoría: " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = "ID inválido.";
}

// Redirigir de vuelta a la página de ingresos/egresos
header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
exit;
