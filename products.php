<?php
include('includes/auth.php');
include('includes/db.php');

// Guardar nuevo producto
if (isset($_POST['guardar'])) {
  $marca = $_POST['marca'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];
  $categoria = $_POST['categoria'];
  $stock = $_POST['stock'];

  $sql = "INSERT INTO productos (marca, descripcion, precio, categoria, stock)
          VALUES ('$marca', '$descripcion', '$precio', '$categoria', '$stock')";
  $conn->query($sql);
}

// Obtener productos
$productos = $conn->query("SELECT * FROM productos ORDER BY marca, precio ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de productos - Omega Cars</title>
  <link rel="stylesheet" href="assets/css/products.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Gestión de Productos</h2>
      <a href="dashboard.php" class="back-link">← Volver al Dashboard</a>
    </div>

    <div class="form-section">
      <h2>Agregar Nuevo Producto</h2>
      <form method="POST">
        <input type="text" name="marca" placeholder="Marca" required>
        <input type="text" name="descripcion" placeholder="Descripción" required>
        <input type="number" step="0.01" name="precio" placeholder="Precio" required>
        <input type="text" name="categoria" placeholder="Categoría (opcional)">
        <input type="number" name="stock" placeholder="Stock (opcional)">
        <button type="submit" name="guardar">Guardar Producto</button>
      </form>
    </div>

    <div class="catalogo-section">
      <h2>Catálogo de Productos</h2>
      <div class="catalogo">
        <?php if ($productos->num_rows > 0): ?>
          <?php while ($p = $productos->fetch_assoc()): ?>
            <div class="tarjeta">
              <h3><?php echo htmlspecialchars($p['marca']); ?></h3>
              <p><?php echo htmlspecialchars($p['descripcion']); ?></p>
              <p class="precio">$<?php echo number_format($p['precio'], 2); ?></p>
              <?php if ($p['categoria']): ?>
                <p><strong>Categoría:</strong> <?php echo htmlspecialchars($p['categoria']); ?></p>
              <?php endif; ?>
              <?php if ($p['stock'] !== null): ?>
                <p><strong>Stock:</strong> <?php echo $p['stock']; ?> unidades</p>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <div class="empty-state">
            No hay productos registrados aún. ¡Agrega tu primer producto!
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>
