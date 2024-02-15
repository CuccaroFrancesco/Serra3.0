<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizzazione Dati</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<div id="dati-container"></div>

<script>
    function stampaDati() 
    {
        $.ajax({
            url: 'datiSerra.php',
            dataType: 'json',
            success: function (data) 
            {
                var tableHtml = '<table><tr><th>ID</th><th>Temp</th><th>Umidita</th><th>Data</th></tr><tr><td>' + data.idDato + '</td><td>' + data.temp + '</td><td>' + data.umidita + '</td><td>' + data.data + '</td></tr></table>';
                $('#dati-container').html(tableHtml);
            },
            error: function () {
                console.error('Errore durante il recupero dei dati.');
            }
        });
    }

    stampaDati();
    setInterval(stampaDati, 1000);
</script>

<?php
include('../app/config.php');
include('../login/classeUtente.php');
$sql = "SELECT * FROM tabDati ORDER BY data DESC LIMIT 5";
$result = $connessione->query($sql);
echo "<table><tr><th>ID</th><th>Temp</th><th>Umidita</th><th>Data</th></tr>";
while($row = $result->fetch_assoc())
{
    echo "<tr>";
    echo "<td>".$row['idDato']."</td>";
    echo "<td>".$row['data']."</td>";
    echo "<td>".$row['temp']."</td>";
    echo "<td>".$row['umidita']."</td>";
    echo "</tr>";
}
echo "</tr></table>";

?>
</body>
</html>
