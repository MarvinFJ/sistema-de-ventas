<?php
include('../../config.php');


$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categoria'];
$nombre = $_POST['nombre'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];


$imagen = $_POST['imagen'];
$nombreDelArchivo = date('Y-m-d H:i:s');
$carpeta = $_SERVER['DOCUMENT_ROOT'] . "/www.sistemadeventas.com/almacen/img_productos/";
$filename = date('Y-m-d_H-i-s') . "__" . $_FILES['imagen']['name'];

move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta . $filename);



// consulta SQL
$sql = "INSERT INTO tb_almacen (codigo, nombre, descripcion, stock, stock_minimo, stock_maximo, precio_compra, precio_venta, fecha_ingreso, imagen, id_usuario, id_categoria, fyh_creacion) 
VALUES (:codigo, :nombre, :descripcion, :stock, :stock_minimo, :stock_maximo, :precio_compra, :precio_venta, :fecha_ingreso, :imagen, :id_usuario, :id_categoria,:fyh_creacion)";

// preparar consulta
$sentencia = $pdo->prepare($sql);

// ejecutar consulta
if($sentencia->execute([
     ':codigo' => $codigo,
    ':nombre' => $nombre,
    ':descripcion' => $descripcion,
    ':stock' => $stock,
    ':stock_minimo' => $stock_minimo,
    ':stock_maximo' => $stock_maximo,
    ':precio_compra' => $precio_compra,
    ':precio_venta' => $precio_venta,
    ':fecha_ingreso' => $fecha_ingreso,
    ':imagen' => $filename,
    ':id_usuario' => $id_usuario,
    ':id_categoria' => $id_categoria,
    ':fyh_creacion' => $fechaHora

])){
    session_start();
    $_SESSION['mensaje'] = "Se registro el producto Correctamente";
    $_SESSION['icono'] = "success";
    header('Location:' .$URL.'/almacen');
    exit();
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se Registro en la BD";
     $_SESSION['icono'] = "error";
    header('Location:' .$URL.'/almacen/create.php');
     exit();
}



