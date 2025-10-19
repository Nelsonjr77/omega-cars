<?php
include('includes/auth.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel principal</title>
  <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
  <div class="container">
    <h2>Bienvenido, <?php echo $_SESSION['usuario_nombre']; ?> 👋</h2>
    <p>Este es tu panel principal. Desde aquí puedes acceder a:</p>
    <ul>
      <li><a href="products.php">Gestión de productos</a></li>
      <li><a href="sales.php">Registrar ventas</a></li>
      <li><a href="logout.php">Cerrar sesión</a></li>
    </ul>
  </div>
</body>
</html>
