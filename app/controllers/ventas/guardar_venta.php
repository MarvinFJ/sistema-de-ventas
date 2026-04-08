<?php
require_once(__DIR__ . '/../../config.php');

$nro_venta = $_POST['nro_venta'];
$metodo_pago = $_POST['metodo_pago'];
$id_cliente = $_POST['id_cliente'];
$monto_recibido = $_POST['monto_recibido'];
$fecha = $fechaHora;

// 🔹 OBTENER CARRITO
$sql_carrito = "SELECT * FROM tb_carrito WHERE nro_venta=?";
$query = $pdo->prepare($sql_carrito);
$query->execute([$nro_venta]);
$carrito = $query->fetchAll(PDO::FETCH_ASSOC);

// VALIDAR
if (empty($id_cliente)) {
    die("Debe seleccionar un cliente");
}

if (empty($carrito)) {
    die("No hay productos en el carrito");
}

// 🔹 CALCULAR TOTAL (AQUÍ SE CREA $total ✅)
$total = 0;

foreach ($carrito as $item) {

    $sql_producto = "SELECT precio_venta, stock FROM tb_almacen WHERE id_producto=?";
    $query_producto = $pdo->prepare($sql_producto);
    $query_producto->execute([$item['id_producto']]);
    $producto = $query_producto->fetch(PDO::FETCH_ASSOC);

    $total += $item['cantidad'] * $producto['precio_venta'];
}

$cambio = $monto_recibido - $total;

// 🔥 TRANSACCIÓN
$pdo->beginTransaction();

try {

    // ✅ INSERT CORRECTO (MISMO # DE CAMPOS Y VALORES)

    $sentencia = $pdo->prepare("INSERT INTO tb_ventas 
        (nro_venta, id_cliente, total, metodo_pago, monto_recibido, cambio, fyh_creacion)
            VALUES (:nro_venta, :id_cliente, :total, :metodo_pago, :monto_recibido, :cambio, :fyh)");

    $sentencia->execute([
        ':nro_venta' => $nro_venta,
        ':id_cliente' => $id_cliente,
        ':total' => $total,
        ':metodo_pago' => $metodo_pago,
        ':monto_recibido' => $monto_recibido,
        ':cambio' => $cambio,
        ':fyh' => $fecha
    ]);

    // 🔹 DETALLE + STOCK
    foreach ($carrito as $item) {

        $id_producto = $item['id_producto'];
        $cantidad = $item['cantidad'];

        $sql_producto = "SELECT precio_venta, stock FROM tb_almacen WHERE id_producto=?";
        $query_producto = $pdo->prepare($sql_producto);
        $query_producto->execute([$id_producto]);
        $producto = $query_producto->fetch(PDO::FETCH_ASSOC);

        $precio = $producto['precio_venta'];
        $stock_actual = $producto['stock'];

        // VALIDAR STOCK
        if ($cantidad > $stock_actual) {
            throw new Exception("Stock insuficiente del producto ID: $id_producto");
        }

        $subtotal = $cantidad * $precio;

        // INSERT DETALLE
        $detalle = $pdo->prepare("
        INSERT INTO tb_detalle_venta 
        (nro_venta, id_producto, cantidad, precio, subtotal)
        VALUES (?, ?, ?, ?, ?)
        ");

        $detalle->execute([
            $nro_venta,
            $id_producto,
            $cantidad,
            $precio,
            $subtotal
        ]);

        // UPDATE STOCK
        $nuevo_stock = $stock_actual - $cantidad;

        $update = $pdo->prepare("UPDATE tb_almacen SET stock=? WHERE id_producto=?");
        $update->execute([$nuevo_stock, $id_producto]);
    }

    // LIMPIAR CARRITO
    $delete = $pdo->prepare("DELETE FROM tb_carrito WHERE nro_venta=?");
    $delete->execute([$nro_venta]);

    $pdo->commit();

    header('Location: ' . $URL . '/ventas/create.php?success=1');
    exit();
} catch (Exception $e) {

    $pdo->rollBack();
    die("Error en la venta: " . $e->getMessage());
}
