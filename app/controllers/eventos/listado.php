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

        // 👇 ESTO ES LO QUE TE FALTABA
        'cliente' => $row['cliente'],
        'producto' => $row['producto'],
        'cantidad' => $row['cantidad'],
        'descripcion' => $row['descripcion']
    ];
}

echo json_encode($eventos);
