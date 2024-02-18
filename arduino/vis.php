<?php
include('../app/config.php');
include('../login/classeUtente.php');

$sql = "SELECT * FROM tabDati ORDER BY data DESC LIMIT 5";
$result = $connessione->query($sql);
$dati = array();

while ($riga = $result->fetch_assoc()) 
{
    $dati[] = $riga;
}

header('Content-Type: application/json');
echo json_encode($dati);
?>
