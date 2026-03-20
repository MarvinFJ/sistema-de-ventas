<?php

include('../../config.php');

$id_usuario = $_POST['id_usuario'];

// consulta SQL
$sql = ("DELETE FROM tb_usuarios WHERE id_usuario=:id_usuario");

// preparar consulta
$sentencia = $pdo->prepare($sql);

// ejecutar consulta
$sentencia->execute([
    ':id_usuario' => $id_usuario
]);

 session_start();
    $_SESSION['mensaje'] = "Se Elimino Correctamente";
    $_SESSION['icono'] = "success";
    header('Location:' .$URL.'/usuarios');
