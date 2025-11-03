<?php
// components/ventas/api/guardar_venta.php
require_once __DIR__ . '/../../db/db.php';
header('Content-Type: application/json; charset=utf-8');

$input = json_decode(file_get_contents('php://input'), true) ?? [];
$venta = $input['venta'] ?? null;
$items = $input['items'] ?? [];

if (!$venta || !is_array($items) || count($items) === 0) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Datos incompletos'], JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    // Detectar columnas disponibles en tablas
    $colsFact = $pdo->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
                             WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'facturas'")
                    ->fetchAll(PDO::FETCH_COLUMN);

    $colsItems = $pdo->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
                              WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'items_factura'")
                     ->fetchAll(PDO::FETCH_COLUMN);

    $hasMovs = (bool)$pdo->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES 
                                  WHERE TABLE_SCHEMA = DATABASE() 
                                  AND TABLE_NAME = 'stock_movimientos'")
                         ->fetchColumn();

    // Mapear vendedor → id_usuario (si existe columna en usuarios)
    $idUsuario = null;
    if (!empty($venta['vendedor'])) {
        // Detecto campo de nombre en usuarios
        $colCandidates = ['usuario', 'username', 'nombre_usuario', 'nombre', 'email'];
        $sqlCols = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
                    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'usuarios'";
        $uCols = $pdo->query($sqlCols)->fetchAll(PDO::FETCH_COLUMN);
        $nameCol = null; foreach ($colCandidates as $c) if (in_array($c, $uCols, true)) { $nameCol = $c; break; }
        if ($nameCol) {
            $stU = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE `$nameCol` = :u LIMIT 1");
            $stU->execute([':u' => $venta['vendedor']]);
            $idUsuario = $stU->fetchColumn() ?: null;
        }
    }

    $pdo->beginTransaction();

    // --- Insert en FACTURAS (solo columnas que existan) ---
    $campos = [];
    $params = [];
    $data = [];

    // Columnas comunes que podríamos tener:
    // fecha, total, id_usuario, observaciones, cliente, numero
    if (in_array('fecha', $colsFact, true))         { $campos[]='fecha';         $params[]=':fecha';         $data[':fecha'] = $venta['fecha'] ?? date('Y-m-d'); }
    if (in_array('total', $colsFact, true))         { $campos[]='total';         $params[]=':total';         $data[':total'] = $venta['total'] ?? 0; }
    if (in_array('id_usuario', $colsFact, true))    { $campos[]='id_usuario';    $params[]=':id_usuario';    $data[':id_usuario'] = $idUsuario; }
    if (in_array('observaciones', $colsFact, true)) { $campos[]='observaciones'; $params[]=':obs';           $data[':obs'] = $venta['observaciones'] ?? null; }
    if (in_array('cliente', $colsFact, true))       { $campos[]='cliente';       $params[]=':cliente';       $data[':cliente'] = $venta['cliente'] ?? null; }
    if (in_array('numero', $colsFact, true))        { $campos[]='numero';        $params[]=':numero';        $data[':numero'] = $venta['numero'] ?? null; }

    if (empty($campos)) {
        throw new Exception("La tabla 'facturas' no tiene columnas compatibles para insertar.");
    }

    $sqlF = "INSERT INTO facturas (".implode(',', $campos).") VALUES (".implode(',', $params).")";
    $stF = $pdo->prepare($sqlF);
    $stF->execute($data);
    $idFactura = (int)$pdo->lastInsertId();

    // --- Insert en ITEMS_FACTURA ---
    // Detectar nombres esperados en items_factura
    // (usamos alias por si las columnas se llaman distinto: id_factura, id_producto, cantidad, precio_unitario)
    $colIdFactura = in_array('id_factura',   $colsItems, true) ? 'id_factura'   : null;
    $colIdProd    = in_array('id_producto',  $colsItems, true) ? 'id_producto'  : null;
    $colCant      = in_array('cantidad',     $colsItems, true) ? 'cantidad'     : null;
    $colPrecio    = in_array('precio_unitario', $colsItems, true) ? 'precio_unitario' : null;

    if (!$colIdFactura || !$colIdProd || !$colCant || !$colPrecio) {
        throw new Exception("La tabla 'items_factura' no tiene las columnas esperadas.");
    }

    $sqlI = "INSERT INTO items_factura ($colIdFactura, $colIdProd, $colCant, $colPrecio)
             VALUES (:idf, :idp, :cant, :precio)";
    $stI = $pdo->prepare($sqlI);

    // Update stock (si existe columna 'stock' en productos)
    $prodCols = $pdo->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
                             WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'productos'")
                    ->fetchAll(PDO::FETCH_COLUMN);
    $hasStockCol = in_array('stock', $prodCols, true);

    $sqlStock = $hasStockCol
        ? "UPDATE productos SET stock = GREATEST(stock - :cant, 0) WHERE id_producto = :idp"
        : null;
    $stStock = $sqlStock ? $pdo->prepare($sqlStock) : null;

    $stMov = null;
    if ($hasMovs) {
        // detecto columnas en movimientos para no fallar
        $movCols = $pdo->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
                                WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'stock_movimientos'")
                        ->fetchAll(PDO::FETCH_COLUMN);
        $hasCreatedAt = in_array('created_at', $movCols, true);
        $sqlMov = "INSERT INTO stock_movimientos (id_producto, tipo, cantidad, ref"
                . ($hasCreatedAt ? ", created_at" : "")
                . ") VALUES (:idp, 'SALIDA', :cant, :ref"
                . ($hasCreatedAt ? ", NOW()" : "")
                . ")";
        $stMov = $pdo->prepare($sqlMov);
    }

    foreach ($items as $it) {
        $idp   = (int)($it['producto_id'] ?? 0);
        $cant  = (int)($it['cantidad'] ?? 0);
        $precio= (float)($it['precio_unit'] ?? 0);
        if ($idp <= 0 || $cant <= 0) continue;

        $stI->execute([
            ':idf' => $idFactura,
            ':idp' => $idp,
            ':cant'=> $cant,
            ':precio' => $precio
        ]);

        if ($stStock) $stStock->execute([':cant'=>$cant, ':idp'=>$idp]);
        if ($stMov)   $stMov->execute([':idp'=>$idp, ':cant'=>$cant, ':ref'=>'FACTURA#'.$idFactura]);
    }

    $pdo->commit();
    echo json_encode(['ok' => true, 'id_factura' => $idFactura], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (Throwable $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => $e->getMessage()], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
