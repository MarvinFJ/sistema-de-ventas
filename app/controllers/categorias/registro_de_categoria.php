<?php

include('../../config.php');

$nombre_categoria = $_GET['nombre_categoria'];

// consulta SQL
$sql = "INSERT INTO tb_categorias (nombre_categoria, fyh_creacion) 
VALUES (:nombre_categoria, :fyh_creacion)";


// preparar consulta
$sentencia = $pdo->prepare($sql);

// ejecutar consulta
if($sentencia->execute([
     ':nombre_categoria' => $nombre_categoria,
    ':fyh_creacion' => $fechaHora
])){
    session_start();
    $_SESSION['mensaje'] = "Se registro la categoria Correctamente";
    $_SESSION['icono'] = "success";
    //header('Location:' .$URL.'/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>
    <?php
    exit();
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se Registro en la BD";
     $_SESSION['icono'] = "error";
    //header('Location:' .$URL.'/categorias');
     exit();
}
