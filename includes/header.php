<?php
// includes/header.php
if (!defined('FERRETEAPP')) exit;
?><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FerreteApp - Gestión de Stock</title>

  <!-- Bootstrap + estilos globales -->
 <link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"  rel="stylesheet"/>



  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
 
  <header>
    <div class="header-left">
      <img src="img/header.png" alt="Logo" class="logo" />
     
    </div>

    <div class="user-menu">
      <!-- avatar, nombre, dropdown -->
      <?php include __DIR__.'/nav.php'; ?>
    </div>

    
  </header>
  <div class="container">
