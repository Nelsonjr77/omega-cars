<?php
include('includes/auth.php');
include('includes/db.php');
require('includes/fpdf.php');

// Obtener productos para el desplegable
$productos = $conn->query("SELECT * FROM productos ORDER BY marca");

// Registrar venta
if (isset($_POST['vender'])) {
  $cliente_nombre = $_POST['cliente_nombre'];
  $cliente_email = $_POST['cliente_email'];
  $cliente_telefono = $_POST['cliente_telefono'];
  $producto_id = $_POST['producto_id'];
  $cantidad = $_POST['cantidad'];

  $producto = $conn->query("SELECT * FROM productos WHERE id = $producto_id")->fetch_assoc();
  $total = $producto['precio'] * $cantidad;

  $sql = "INSERT INTO ventas (cliente_nombre, cliente_email, cliente_telefono, producto_id, cantidad, total)
          VALUES ('$cliente_nombre', '$cliente_email', '$cliente_telefono', $producto_id, $cantidad, $total)";
  $conn->query($sql);

  // Generar PDF
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(0,10,'Omega Cars Boutique',0,1,'C');
  $pdf->SetFont('Arial','',12);
  $pdf->Ln(5);
  $pdf->Cell(0,10,"Cliente: $cliente_nombre",0,1);
  $pdf->Cell(0,10,"Email: $cliente_email",0,1);
  $pdf->Cell(0,10,"Teléfono: $cliente_telefono",0,1);
  $pdf->Ln(5);
  $pdf->Cell(0,10,"Producto: " . $producto['marca'] . " - " . $producto['descripcion'],0,1);
  $pdf->Cell(0,10,"Cantidad: $cantidad",0,1);
  $pdf->Cell(0,10,"Total: $" . number_format($total, 2),0,1);
  $pdf->Cell(0,10,"Fecha: " . date("d/m/Y H:i"),0,1);
  $archivo = "comprobante_" . time() . ".pdf";
  $pdf->Output("F", "comprobantes/$archivo");
  $pdf->Output("D", $archivo);
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar venta</title>
  <link rel="stylesheet" href="assets/css/sales.css">
</head>
<body>
  <div class="container">
    <h2>Registrar nueva venta</h2>
    <form method="POST">
      <input type="text" name="cliente_nombre" placeholder="Nombre del cliente" required><br>
      <input type="email" name="cliente_email" placeholder="Correo del cliente" required><br>
      <input type="text" name="cliente_telefono" placeholder="Teléfono del cliente" required><br>

      <select name="producto_id" required>
        <option value="">Seleccionar producto</option>
        <?php while ($p = $productos->fetch_assoc()): ?>
          <option value="<?php echo $p['id']; ?>">
            <?php echo $p['marca'] . " - $" . $p['precio']; ?>
          </option>
        <?php endwhile; ?>
      </select><br>

      <input type="number" name="cantidad" placeholder="Cantidad" required><br>
      <button type="submit" name="vender">Confirmar venta y generar PDF</button>
    </form>
  </div>
</body>
</html>
