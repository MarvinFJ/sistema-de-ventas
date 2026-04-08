<?php
include('../app/config.php');

$sql = "SELECT v.*, c.nombre_cliente 
        FROM tb_ventas v
        INNER JOIN tb_clientes c ON v.id_cliente = c.id_cliente
        ORDER BY v.id_venta DESC";

$query = $pdo->prepare($sql);
$query->execute();
$ventas_datos = $query->fetchAll(PDO::FETCH_ASSOC);
