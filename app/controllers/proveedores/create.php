<?php

include('../../config.php');

$nombre_proveedor = $_GET['nombre_proveedor'];
$celular = $_GET['celular'];
$telefono = $_GET['telefono'];
$empresa = $_GET['empresa'];
$email = $_GET['email'];
$direccion = $_GET['direccion'];
$id_proveedor_nuevo = $pdo->lastInsertId();

$sentencia = $pdo->prepare("INSERT INTO tb_proveedores
       ( nombre_proveedor, celular, telefono, empresa, email, direccion, fyh_creacion) 
VALUES (:nombre_proveedor,:celular,:telefono,:empresa,:email,:direccion,:fyh_creacion)");

$sentencia->bindParam('nombre_proveedor', $nombre_proveedor);
$sentencia->bindParam('celular', $celular);
$sentencia->bindParam('telefono', $telefono);
$sentencia->bindParam('empresa', $empresa);
$sentencia->bindParam('email', $email);
$sentencia->bindParam('direccion', $direccion);
$sentencia->bindParam('fyh_creacion', $fechaHora);


if ($sentencia->execute()) {

    session_start();
    $_SESSION['mensaje'] = "Se registro al proveedor de la manera correcta";
    $_SESSION['icono'] = "success";

    $origen = $_GET['origen'] ?? '';

    if ($origen == 'compras') {
        echo "<script>
        $('#modal-create').modal('hide');
        location.reload();
    </script>";
    } else {
?>
        <script>
            location.href = "<?php echo $URL; ?>/proveedores";
        </script>
    <?php
    }
} else {

    session_start();
    $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";

    ?>
    <script>
        location.href = "<?php echo $URL; ?>/proveedores";
    </script>
<?php
}
