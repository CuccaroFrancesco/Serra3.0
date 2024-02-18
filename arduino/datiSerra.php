<?php
    include('../app/config.php');
    include('../login/classeUtente.php');
    $sql = "SELECT * FROM tabDati ORDER BY data DESC LIMIT 1";
    $result = $connessione->query($sql);
    $riga = $result->fetch_assoc();
    echo json_encode($riga);
    header('Content-Type: application/json');
?>
