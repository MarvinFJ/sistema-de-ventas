<?php
include('../../config.php');


$nombres = $_POST['nombres'];
$email = $_POST['email'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];
$id_usuario = $_POST['id_usuario'];

if($password_user == $password_repeat){
    $password_user = password_hash($password_user, algo: PASSWORD_DEFAULT);

// consulta SQL
$sql = ("UPDATE tb_usuarios 
SET nombres=:nombres,
email=:email,
password_user =:password_user,
fyh_actualizacion=:fyh_actualizacion 
WHERE id_usuario=:id_usuario");

// preparar consulta
$sentencia = $pdo->prepare($sql);

// ejecutar consulta
$sentencia->execute([
    ':nombres' => $nombres,
    ':email' => $email,
    ':password_user' => $password_user,
    ':fyh_actualizacion' => $fechaHora,
    ':id_usuario' => $id_usuario
]);
 session_start();
    $_SESSION['mensaje'] = "Se actualizo Correctamente";
    $_SESSION['icono'] = 'Success';
    header('Location:' .$URL.'/usuarios');
}else{
    //echo "Error las contrasenas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error las contrasenas no son iguales";
    $_SESSION['icono'] = "error";
    header('Location:' .$URL.'/usuarios/update.php?id='.$id_usuario);
}
