<?php
session_start();
if (isset($_SESSION['sesion_email'])) {
  //echo "Si existe sesion de" . $_SESSION['sesion_email'];
  $email_sesion = $_SESSION['sesion_email'];
  $sql = "SELECT * FROM tb_usuarios WHERE email='$email_sesion'";
  $query = $pdo->prepare($sql);
  $query->execute();
  $usuarios = $query->fetchAll(fetch_style: PDO::FETCH_ASSOC);
  foreach ($usuarios as $usuario) {
    $nombres_sesion = $usuario['nombres'];
  }
} else {
  echo "no existe sesion";
  header('Location: '. $URL .'/login');
}