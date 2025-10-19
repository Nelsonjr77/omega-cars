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
  <title>Gestión de productos</title>
  <link rel="stylesheet" href="assets/css/products.css">
</head>
<body>
  <div class="container">
    <h2>Agregar nuevo producto</h2>
    <form method="POST">
      <input type="text" name="marca" placeholder="Marca" required><br>
      <input type="text" name="descripcion" placeholder="Descripción" required><br>
      <input type="number" step="0.01" name="precio" placeholder="Precio" required><br>
      <input type="text" name="categoria" placeholder="Categoría (opcional)"><br>
      <input type="number" name="stock" placeholder="Stock (opcional)"><br>
      <button type="submit" name="guardar">Guardar producto</button>
    </form>

    <h2>Catálogo de productos</h2>
    <div class="catalogo">
      <?php while ($p = $productos->fetch_assoc()): ?>
        <div class="tarjeta">
          <h3><?php echo $p['marca']; ?></h3>
          <p><?php echo $p['descripcion']; ?></p>
          <p><strong>Precio:</strong> $<?php echo $p['precio']; ?></p>
          <?php if ($p['categoria']): ?>
            <p><strong>Categoría:</strong> <?php echo $p['categoria']; ?></p>
          <?php endif; ?>
          <?php if ($p['stock'] !== null): ?>
            <p><strong>Stock:</strong> <?php echo $p['stock']; ?></p>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</body>
</html>
