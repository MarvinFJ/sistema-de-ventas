<?php

$sql = "SELECT * FROM eventos";
$query = $pdo->prepare($sql);
$query->execute();

$eventos_datos = $query->fetchAll(PDO::FETCH_ASSOC);