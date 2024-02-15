<?php
    include('../app/config.php');
    include('../login/classeUtente.php');
    $sql = "SELECT * FROM tabDati ORDER BY data DESC LIMIT 2";
    $result = $connessione->query($sql);
    $i='primo';
    while($row = $result->fetch_assoc())
    {
        $array[$i]=$row;
        $i='secondo';
    }
    echo json_encode($array);
    header('Content-Type: application/json');
?>
