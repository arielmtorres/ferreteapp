<?php
// includes/header.php
if (!defined('FERRETEAPP')) exit;
?><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FerreteApp - Gestión de Stock</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>




  <link rel="stylesheet" href="./css/style.css" />
</head>
<body>
  <header>
    <div class="header-left">
      <img src="img/headerlogo.png" alt="Logo" class="logo-header" />
    </div>

    <button class="menu-toggle" aria-label="Abrir menú">
      ☰
    </button>

    <div class="user-menu" id="userMenu">
      <?php include __DIR__.'/nav.php'; ?>
    </div>
  </header>

  <div class="container">
