<?php

require_once(__DIR__ . '/../../config.php');

$id_proveedor = $_GET['id_proveedor'];

// 🔥 CAMBIAMOS DELETE POR UPDATE
$sentencia = $pdo->prepare("UPDATE tb_proveedores SET activo = 0 WHERE id_proveedor = :id_proveedor");

$sentencia->bindParam(':id_proveedor', $id_proveedor);

if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Proveedor desactivado correctamente";
    $_SESSION['icono'] = "success";
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al desactivar proveedor";
    $_SESSION['icono'] = "error";
}
?>

<script>
    location.href = "<?php echo $URL;?>/proveedores";
</script>