
<?php
include('../../config.php');

$hoy = date('Y-m-d');
$limite = date('Y-m-d', strtotime('+7 days'));

$sql = "SELECT * FROM eventos 
        WHERE fecha_inicio BETWEEN :hoy AND :limite
        ORDER BY fecha_inicio ASC";

$query = $pdo->prepare($sql);
$query->bindParam(':hoy', $hoy);
$query->bindParam(':limite', $limite);
$query->execute();

$eventos = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($eventos);