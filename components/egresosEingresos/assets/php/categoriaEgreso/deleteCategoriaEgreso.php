<?php
session_start();
require __DIR__ . '../../../../../db/db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        // Eliminar categoría de egreso
        $stmt = $pdo->prepare("DELETE FROM categorias_egresos WHERE id_categoria_egreso = ?");
        $stmt->execute([$id]);

        $_SESSION['success'] = 'delete-categoria-egreso';
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error al eliminar la categoría de egreso: " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = "ID inválido.";
}

// Redirigir de vuelta a la página de ingresos/egresos
header("Location: /ferreteApp/components/egresosEingresos/egresosEingresos.php");
exit;
