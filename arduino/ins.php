<?php
include('../app/config.php');
if(isset($_POST['temperature']) && isset($_POST['humidity']))
{
    $temp=$_POST['temperature'];
    $umid=$_POST['humidity'];
    $sql="INSERT INTO tabDati(data,temp,umidita) VALUES (now(),'$temp','$umidita')";
    $result=mysqli_query($connessione,$sql);
}
?>