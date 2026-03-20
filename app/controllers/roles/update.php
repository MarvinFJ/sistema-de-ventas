<?php
include('../../config.php');


$id_rol = $_POST['id_rol'];
$rol = $_POST['rol'];

// consulta SQL
$sql = ("UPDATE tb_roles
SET rol=:rol,
fyh_actualizacion=:fyh_actualizacion 
WHERE id_rol=:id_rol");

// preparar consulta
$sentencia = $pdo->prepare($sql);

// ejecutar consulta
if($sentencia->execute([
    ':rol' => $rol,
    ':fyh_actualizacion' => $fechaHora,
    ':id_rol' => $id_rol
])){
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el rol Correctamente";
    $_SESSION['icono'] = "success";
    header('Location:' .$URL.'/roles');
    exit();
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actulizar en la BD";
    $_SESSION['icono'] = "error";
    header('Location:' .$URL.'/roles/update.php?id='.$id_rol);
    exit();
}


    


   