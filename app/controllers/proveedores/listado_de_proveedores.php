<?php

$sql_proveedores = "SELECT * FROM tb_proveedores WHERE activo = 1";
$query_proveedores = $pdo->prepare($sql_proveedores);
$query_proveedores->execute();
$proveedores_datos = $query_proveedores->fetchAll(PDO::FETCH_ASSOC);