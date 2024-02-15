<?php
$server='localhost';
$username='francescocuccaro';
$password='';
$db='my_francescocuccaro';
$connessione=new mysqli($server,$username,$password,$db);
if($connessione->connect_error)
{
	die("Errore di connessione (".$connessione->connect_errno.") ".$connessione->connect_error);
}

?>