<?php
include('../../config.php');


$nombres = $_POST['nombres'];
$email = $_POST['email'];
$rol = $_POST['rol'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];

if($password_user == $password_repeat){
    $password_user = password_hash($password_user, PASSWORD_DEFAULT);

// consulta SQL
$sql = "INSERT INTO tb_usuarios (nombres, email, id_rol, password_user, fyh_creacion) 
VALUES (:nombres, :email, :id_rol, :password_user, :fyh_creacion)";

// preparar consulta
$sentencia = $pdo->prepare($sql);

// ejecutar consulta
$sentencia->execute([
    ':nombres' => $nombres,
    ':email' => $email,
    ':id_rol' => $rol,
    ':password_user' => $password_user,
    ':fyh_creacion' => $fechaHora
]);
 session_start();
    $_SESSION['mensaje'] = "Se registro Correctamente";
    $_SESSION['icono'] = "success";
    header('Location:' .$URL.'/usuarios');
}else{
    //echo "Error las contrasenas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error las contrasenas no son iguales";
    header('Location:' .$URL.'/usuarios/create.php');
}
