<?php
include('../../config.php');


$rol = $_POST['rol'];


// consulta SQL
$sql = "INSERT INTO tb_roles (rol, fyh_creacion) 
VALUES (:rol, :fyh_creacion)";

// preparar consulta
$sentencia = $pdo->prepare($sql);

// ejecutar consulta
if($sentencia->execute([
     ':rol' => $rol,
    ':fyh_creacion' => $fechaHora
])){
    session_start();
    $_SESSION['mensaje'] = "Se registro el rol Correctamente";
    $_SESSION['icono'] = "success";
    header('Location:' .$URL.'/roles');
    exit();
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se Registro en la BD";
     $_SESSION['icono'] = "error";
    header('Location:' .$URL.'/roles/create.php');
     exit();
}



