<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: http://localhost/pagina/form/index.php');
    exit;
  }
  require './database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id_usuario, email, passU FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    
    
    if ($results !== false && password_verify($_POST['password'], $results['passU'])) {
      $_SESSION['user_id'] = $results['id_usuario'];
      header("Location: http://localhost/pagina/form/index.php");
      exit;
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Iniciar sesion</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">Registarse</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Introduce tu email">
      <input name="password" type="password" placeholder="Introduce tu contraseña">
      <input type="submit" value="Submit">
    </form>
  </body>
</html>
