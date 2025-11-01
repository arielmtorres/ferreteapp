<?php
require __DIR__ . '../../../../db/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = $_POST['id_usuario'] ?? null;

    if (!$idUsuario) {
        echo json_encode(['success' => false, 'msg' => 'ID de usuario no especificado']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
        $stmt->execute([':id' => $idUsuario]);

        echo json_encode(['success' => true, 'msg' => 'Usuario eliminado correctamente']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'msg' => 'Error al eliminar usuario: '.$e->getMessage()]);
    }
}
?>
