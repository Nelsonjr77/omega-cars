<?php
include('includes/auth.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel principal - Omega Cars</title>
  <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Bienvenido, <?php echo $_SESSION['usuario_nombre']; ?></h2>
      <p>Panel de control - Omega Cars Boutique</p>
    </div>

    <div class="menu-grid">
      <a href="products.php" class="menu-card">
        <div class="menu-icon">🚗</div>
        <h3>Gestión de Productos</h3>
        <p>Administra el catálogo de vehículos y autopartes</p>
      </a>

      <a href="sales.php" class="menu-card">
        <div class="menu-icon">💰</div>
        <h3>Registrar Ventas</h3>
        <p>Procesa nuevas ventas y genera comprobantes</p>
      </a>
    </div>

    <div class="logout-section">
      <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
    </div>
  </div>
</body>
</html>
