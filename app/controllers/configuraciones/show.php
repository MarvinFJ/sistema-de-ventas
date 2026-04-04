<?php
$sql = "SELECT * FROM tb_configuraciones LIMIT 1";
$query = $pdo->prepare($sql);
$query->execute();
$config = $query->fetch(PDO::FETCH_ASSOC);