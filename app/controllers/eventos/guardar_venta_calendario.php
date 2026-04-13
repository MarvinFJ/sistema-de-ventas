<?php
include('../../config.php');

$cliente = $_POST['cliente'];
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$total = $_POST['total'];

$sql = "INSERT INTO tb_ventas 
(cliente, producto, cantidad, precio, total) 
VALUES 
('$cliente','$producto','$cantidad','$precio','$total')";

$query = $pdo->prepare($sql);
$query->execute();