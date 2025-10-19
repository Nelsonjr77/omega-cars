<?php
session_start();
include('includes/db.php');

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $contraseña = $_POST['contraseña'];

  $sql = "SELECT * FROM usuarios WHERE email = '$email'";
  $resultado = $conn->query($sql);

  if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    if (password_verify($contraseña, $usuario['contraseña'])) {
      $_SESSION['usuario_id'] = $usuario['id'];
      $_SESSION['usuario_nombre'] = $usuario['nombre'];
      header("Location: dashboard.php");
      exit();
    } else {
      $error = "Contraseña incorrecta.";
    }
  } else {
    $error = "Correo no registrado.";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <div class="container">
    <h2>Iniciar sesión</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="">
      <input type="email" name="email" placeholder="Correo electrónico" required><br>
      <input type="password" name="contraseña" placeholder="Contraseña" required><br>
      <button type="submit" name="login">Entrar</button>
    </form>
    <p><a href="recover.php">¿Olvidaste tu contraseña?</a></p>
  </div>
</body>
</html>
