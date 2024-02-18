<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/root.css">
    <title>Home - Serra 3.0</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://kit.fontawesome.com/5dde4e6992.js" crossorigin="anonymous"></script>
    <script src="app/funzioni.js"></script>
</head>
<body>
    
<?php
include('login/classeUtente.php');
include('login/funzioniLogin.php');
session_start();
include('app/app.php');
?>
<div class="sito" id='inizio'>
    <!-- Header-->
    <div class="header">
        <div class="navbar">
            <!-- Navbar Utente / Admin -->
            <nav id='nav'>
                <div class='logo'><a href='#inizio'><img src="img/logo.png"></a></div>
                <div class='menu'>
                    <li><a href='#inizio'>Home</a></li>
                    <li><a href='#inizio'>Dettagli</a></li>
                    <?php 
                        if(controllaLogin())
                            echo "<li><a href='dashboard.php'>Dashboard</a></li>";
                    ?>
                    <li><a href='contatti.html'>Contatti</a></li>
                    <li>
                        <a href='login/logout.php'>
                            <?php 
                            if(controllaLogin())
                                echo "<i class='fa-solid fa-right-from-bracket'></i>";
                                else 
                                echo "<i class='fa-solid fa-right-to-bracket'></i>"; 
                            ?>
                        </a>
                    </li>
                </div>
            </nav>
            <!-- Hero centrale -->
            <div class="hero">
                <div class="hero-title">Serra 3.0</div>
                <div class="hero-p">Esplora la serra del futuro!</div>
                <a href=''><div class="cta">Scopri di più</div></a>
                <div class="header-button"><a href=''><i class="fa-solid fa-chevron-down"></i></a></div>
            </div>
        </div>
    </div>
    <!-- Pulsante + SerraAI -->
    <div class="chatbot">
        <div class="bottone" id='bottone' onclick="attivaBot()">
            <i class="fa-solid fa-comments" id='btn-chat'></i>
        </div>
        <div class="wrapper" id="wrapper">
            <div class="title">Serra AI</div>
            <div class="form">
                <div class="bot-inbox inbox">
                    <div class="icon">
                        <i class="fa-solid fa-robot"></i>
                    </div>
                    <div class="msg-header">
                        <p>Ciao <?php if(isset($_SESSION['utente'])) echo $_SESSION['utente']->getNome(); ?>, sono Serra AI, come posso aiutarti?</p>
                    </div>
                </div>
            </div>
            <div class="typing-field">
                <div class="input-data">
                    <form id="chatForm" action="" method="post" onsubmit="chatbot()">
                        <input id="data" type="text" name='data' autocomplete="off" placeholder="Scrivi qualcosa..." required>
                        <input id="send-btn" type='submit' name='invia' value='Invia'>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
