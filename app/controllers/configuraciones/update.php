<?php
include('../../config.php');

$nombre_empresa = $_POST['nombre_empresa'];
$color_sidebar = $_POST['color_sidebar'];
$color_navbar = $_POST['color_navbar'];

// LOGO
$logo = "";
if($_FILES['logo']['name'] != ""){
    $nombreArchivo = date('Y-m-d_H-i-s')."__".$_FILES['logo']['name'];
    $ruta = $_SERVER['DOCUMENT_ROOT']."/www.sistemadeventas.com/almacen/logo/".$nombreArchivo;

    move_uploaded_file($_FILES['logo']['tmp_name'], $ruta);

    $logo = $nombreArchivo; // 👈 ESTA ES LA SOLUCIÓN
}

// validar si ya existe configuración
$sql = "SELECT * FROM tb_configuraciones LIMIT 1";
$query = $pdo->prepare($sql);
$query->execute();
$config = $query->fetch(PDO::FETCH_ASSOC);

if($config){
    // UPDATE
    $sql = "UPDATE tb_configuraciones 
            SET nombre_empresa=:nombre_empresa,
                color_sidebar=:color_sidebar,
                color_navbar=:color_navbar,
                logo=IF(:logo='', logo, :logo),
                fyh_actualizacion=:fyh_actualizacion
            WHERE id_configuracion=:id";

    $sentencia = $pdo->prepare($sql);
    $sentencia->execute([
        ':nombre_empresa'=>$nombre_empresa,
        ':color_sidebar'=>$color_sidebar,
        ':color_navbar'=>$color_navbar,
        ':logo'=>$logo,
        ':fyh_actualizacion'=>$fechaHora,
        ':id'=>$config['id_configuracion']
    ]);
}else{
    // INSERT
    $sql = "INSERT INTO tb_configuraciones 
            (nombre_empresa, color_sidebar, color_navbar, logo, fyh_creacion)
            VALUES (:nombre_empresa,:color_sidebar,:color_navbar,:logo,:fyh_creacion)";

    $sentencia = $pdo->prepare($sql);
    $sentencia->execute([
        ':nombre_empresa'=>$nombre_empresa,
        ':color_sidebar'=>$color_sidebar,
        ':color_navbar'=>$color_navbar,
        ':logo'=>$logo,
        ':fyh_creacion'=>$fechaHora
    ]);
}

header('Location: '.$URL);
exit();