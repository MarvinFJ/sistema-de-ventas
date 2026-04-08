<?php
include('../../config.php');

if(isset($_POST['id'])){

    $id = $_POST['id'];

    $sql = "DELETE FROM eventos WHERE id=:id";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id', $id);

    if($query->execute()){
        echo "OK";
    }else{
        echo "ERROR";
    }

}else{
    echo "NO ID";
}