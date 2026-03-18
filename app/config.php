<?php

define('SERVIDOR','localhost');
define('USUARIO','root');
define('PASSWORD','');
define('BD','sistemadeventas');

$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;

try {
$pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    //echo "La conexion a la base de datos fue con exito";
}catch (PDOException $e){
    //print_r($e);
    echo "Erro al conectar a la base de Datos";
}

$URL= "http://localhost/www.sistemadeventas.com";

date_default_timezone_set("America/Mexico_City");
$fechaHora = date('Y-m-d-H:i:s');

?>