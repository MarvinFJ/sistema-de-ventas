<?php 

require_once(__DIR__ . '/../../config.php');

$id_producto = $_POST['id_producto'];

$sentencia = $pdo->prepare("UPDATE tb_almacen SET activo = 0 WHERE id_producto = :id_producto");

$sentencia->bindParam(':id_producto', $id_producto);

if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Producto desactivado correctamente";
    $_SESSION['icono'] = "success";
    header('Location: '.$URL.'/almacen/');
}else{
    session_start();
    $_SESSION['mensaje'] = "Error al desactivar el producto";
    $_SESSION['icono'] = "error";
    header('Location: '.$URL.'/almacen/');
}