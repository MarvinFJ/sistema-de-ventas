<?php
include('../../config.php');

// VALIDAR SI LLEGAN DATOS
if (isset($_POST['titulo'])) {
    $titulo = $_POST['titulo'] ?? '';
    $fecha_inicio = $_POST['fecha_inicio'] ?? '';
    $fecha_fin = $_POST['fecha_fin'] ?? '';
    $color = $_POST['color'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $producto_id = $_POST['producto_id'];
    $cliente = $_POST['cliente'] ?? '';
    $producto = $_POST['producto'] ?? '';
    $cantidad = $_POST['cantidad'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';

    $sql = "INSERT INTO eventos 
        (titulo, fecha_inicio, fecha_fin, color, producto_id, precio, cliente, producto, cantidad, descripcion) 
            VALUES (:titulo, :fecha_inicio, :fecha_fin, :color, :producto_id, :precio, :cliente, :producto, :cantidad, :descripcion)";

    $query = $pdo->prepare($sql);

    $query->bindParam(':titulo', $titulo);
    $query->bindParam(':fecha_inicio', $fecha_inicio);
    $query->bindParam(':fecha_fin', $fecha_fin);
    $query->bindParam(':color', $color);
    $query->bindParam(':producto_id', $producto_id);
    $query->bindParam(':precio', $precio);
    $query->bindParam(':cliente', $cliente);
    $query->bindParam(':producto', $producto);
    $query->bindParam(':cantidad', $cantidad);
    $query->bindParam(':descripcion', $descripcion);

    if ($query->execute()) {
        echo "OK";
    } else {
        echo "ERROR AL INSERTAR";
    }
} else {
    //echo "NO LLEGAN DATOS";
    print_r($query->errorInfo()); // 👈 TE DICE EL ERROR REAL
}
