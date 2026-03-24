<?php
include('../../config.php');


$nombre_categoria = $_GET['nombre_categoria'];
$id_categoria = $_GET['id_categoria'];

// consulta SQL
$sql = ("UPDATE tb_categorias
SET nombre_categoria=:nombre_categoria,
fyh_actualizacion=:fyh_actualizacion 
WHERE id_categoria=:id_categoria");

// preparar consulta
$sentencia = $pdo->prepare($sql);

// ejecutar consulta
if($sentencia->execute([
    ':nombre_categoria' => $nombre_categoria,
    ':fyh_actualizacion' => $fechaHora,
    ':id_categoria' => $id_categoria
])){
    session_start();
    $_SESSION['mensaje'] = "Se actualizo la categoria Correctamente";
    $_SESSION['icono'] = "success";
    //header('Location:' .$URL.'/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias"
    </script>
    <?php
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actulizar en la BD";
    $_SESSION['icono'] = "error";
    //header('Location:' .$URL.'/roles/update.php?id='.$id_rol);
     ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias"
    </script>
    <?php
}


    


   