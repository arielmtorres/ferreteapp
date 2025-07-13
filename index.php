<?php
  // Sólo aquí definimos FERRETEAPP
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  define('FERRETEAPP', true);

  // Incluimos configuración y la cabecera
  include __DIR__ . '/includes/config.php';
  include __DIR__ . '/includes/header.php';
?>

<main id="principal">
  <div id="principalHeader"></div>
  <div id="principalBody"></div>
</main>

<?php
  include __DIR__ . '/includes/footer.php';
?>
