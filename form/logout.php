<?php
  session_start();

  session_unset();

  session_destroy();

  header('Location: http://localhost/pagina/form/index.php');
  exit;
?>
