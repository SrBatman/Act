<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id_usuario, email, passU FROM users WHERE id_usuario = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Art Station</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Bienvenid@. <?= $user['email']; ?>
      <br>Haz iniciado sesion de manera satisfactoria.
      <a href="logout.php">
        Cerrar Sesion
      </a>
    <?php else: ?>
      <h1>Iniciar sesion o registrarse</h1>

      <a href="login.php">Iniciar sesion</a> or
      <a href="signup.php">Registrarse</a>
    <?php endif; ?>
  </body>
</html>
