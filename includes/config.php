<?php
// Evita accesos directos
if (!defined('FERRETEAPP')) {
    die('Acceso no permitido');
}

// ---------------------------
// Selecciona la fuente de datos
// ---------------------------
// true = usas JSON falsos; false = MySQL real
define('USE_JSON', true);

// ---------------------------
// Conexión a MySQL (solo si USE_JSON === false)
// ---------------------------
if (!USE_JSON) {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'ferreteapp');

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($mysqli->connect_error) {
        die('Error de conexión (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
    }
    $mysqli->set_charset('utf8');
}

// ---------------------------
// Helpers para JSON
// ---------------------------
if (USE_JSON) {
    /**
     * Carga y decodifica un archivo JSON en /json/{name}.json
     * @param string $name  Nombre del archivo sin extensión
     * @return array        Datos decodificados o [] si falla
     */
    function getData(string $name): array
    {
        $path = __DIR__ . "/../json/{$name}.json";
        if (!file_exists($path)) {
            error_log("Mock JSON no encontrado: $path");
            return [];
        }
        $json = file_get_contents($path);
        return json_decode($json, true) ?: [];
    }
}
