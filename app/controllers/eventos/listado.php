<?php
include('../../config.php');

$sql = "SELECT * FROM eventos";
$query = $pdo->prepare($sql);
$query->execute();

$eventos = [];

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $eventos[] = [
        'id' => $row['id'],
        'title' => $row['titulo'],
        'start' => date('Y-m-d', strtotime($row['fecha_inicio'])),
        'end' => date('Y-m-d', strtotime($row['fecha_fin'])),
        'allDay' => true,
        'backgroundColor' => $row['color'],
        'borderColor' => $row['color'],

        'cliente' => $row['cliente'],
        'producto' => $row['producto'],
        'cantidad' => $row['cantidad'],
        'precio' => $row['precio'], // 🔥 IMPORTANTE
        'producto_id' => $row['producto_id'],
        'descripcion' => $row['descripcion']
    ];
}

echo json_encode($eventos);
