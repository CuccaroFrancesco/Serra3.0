<?php
include('../app/config.php');
if(isset($_POST['temperature']) && isset($_POST['humidity']))
{
    $temp=$_POST['temperature'];
    $umid=$_POST['humidity'];
    $terra=49;
    $comando="SELECT * FROM tabDati ORDER BY data";
    $tabella=mysqli_query($connessione,$comando);
    if($tabella->num_rows >= 5)
    {
        $valori=$tabella->fetch_assoc();
        $primo=$valori['idDato'];
        echo $primo;
        $istr="DELETE FROM tabDati WHERE idDato='$primo'";
        mysqli_query($connessione,$istr);
    }
    $sql="INSERT INTO tabDati(data,temp,umidita,terra) VALUES (now(),'$temp','$umid','$terra')";
    $result=mysqli_query($connessione,$sql);
}
?>