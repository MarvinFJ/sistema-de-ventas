<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 12/2/2023
 * Time: 18:45
 */

$sql_ventas = "SELECT * FROM tb_ventas";
$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->execute();
$ventas_datos = $query_ventas->fetchAll(PDO::FETCH_ASSOC);