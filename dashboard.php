<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Serra 3.0</title>
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="app/funzioni.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://kit.fontawesome.com/5dde4e6992.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
include('login/classeUtente.php');
session_start();
include('login/funzioniLogin.php');
include('app/funzioniDash.php');
if(!isset($_SESSION['utente']))
{
    header('location:die.php');
}
?>
    <div class="sito-dash">
        <div class="sidebar">
            <div class="logo"><img src="img/logo.png"></div>
            <div class="menu">
                <li><a href="index.php"><i class="fa-solid fa-house"></i><span>Home</span></a></li>
                <li><a href="?id=0"><i class="fa-solid fa-chart-simple"></i><span>Dati</span></a></li>
                <li><a href="?id=1"><i class="fa-solid fa-sliders"></i><span>Controlli</span></a></li>
                <?php
                    if(controllaRuolo('admin'))
                    {
                        ?>
                            <li id='utenti' onclick='opzioniUtente()'><i class="fa-solid fa-user"></i><span>Utenti<i class="fa-solid fa-chevron-down" id='icona-utenti'></i></span></li>
                            <li class='nascosto' id='nascosto'>
                                <a href="?id=2"><i class="fa-solid fa-users"></i><span>Visualizza Utenti</span></a>
                                <a href="?id=3"><i class="fa-solid fa-user-plus"></i><span>Inserisci Utente</span></a>
                            </li>
                            <li><a href="?id=4"><i class="fa-solid fa-gear"></i><span>Impostazioni</span></a></li>
                        <?php
                    }
                ?>
            </div>
            <div class="servizi">
                <div class="cambio-tema" onclick='cambiaTema()'><i class="fa-solid fa-moon" id='icona-tema'></i><span id='span-tema'>Passa al tema scuro</span></div>
                <div class="logout">
                    <a href='login/logout.php'>
                        <i class="fa-solid fa-right-from-bracket"></i> <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="dashboard">
            <div class="nav">
                <div class="dash-title">Dashboard <?php if(controllaRuolo('admin')) echo "Amministratore"; else echo "Utente"; ?></div>
                <div class="utente">
                    <div class="nome"> <?php echo $_SESSION['utente']->getNome()." ".$_SESSION['utente']->getCognome(); ?> </div>
                    <div class="ruolo"> <?php echo $_SESSION['utente']->getRuolo(); ?></div>
                </div>
            </div>
            <section>
                <?php
                $id=$_GET['id'];
                switch($id)
                {
                    case 0:
                        visDati();
                        break;
                    case 1:
                        echo "Controlli";
                        break;
                    case 2:
                        if (controllaRuolo('admin'))
                            visUtenti();
                        else
                            echo "<script>window.location.href = 'die.php';</script>";
                        break;
                    case 3:
                        if (controllaRuolo('admin'))
                            insUtente();
                        else
                            echo "<script>window.location.href = 'die.php';</script>";
                        break;
                    case 4:
                        if (controllaRuolo('admin'))
                            echo "Impostazioni";
                        else
                            echo "<script>window.location.href = 'die.php';</script>";
                        break;
                        
                }
                ?>
            </section>
        </div>
    </div>
</body>
</html>