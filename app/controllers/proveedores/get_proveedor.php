<?php
include('../../config.php');

$id_proveedor = $_GET['id_proveedor'];

$sentencia = $pdo->prepare("SELECT * FROM tb_proveedores WHERE id_proveedor = :id_proveedor");
$sentencia->bindParam('id_proveedor', $id_proveedor);
$sentencia->execute();

$proveedor = $sentencia->fetch(PDO::FETCH_ASSOC);

echo json_encode($proveedor);