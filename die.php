<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/root.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body
        {
            background: white;
        }
        .die {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: center;
            height: 100vh;
        }
        img {
            width: 1200px;
        }
        h3 {
            font-size: 50px;
            font-weight: 700;
            letter-spacing: 2px;
            font-family: 'Inter';
            color: var(--colore-secondario);
            margin: 50px 0;
        }
        p{
            font-family: 'Montserrat';
            font-size: 20px;
            color: black;
            max-width: 500px;   
            text-align: center;
        }
        span
        {
            text-align: center;
            font-size: 15px;
            font-family: 'Nunito';
            margin: 20px;
            color: red;
        }
        a
        {
            background: var(--colore-primario);
            border-radius: 5rem;
            margin-top: 50px;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            font-family: 'Inter';
            transition: 0.3s all;
            box-shadow: rgb(18 177 30 / 21%) 0px 0px 50px 10px;
        }
        a:hover
        {
            transform: scale(1.056);
            background: var(--colore-secondario);
        }
    </style>
    <title>Accesso Negato</title>
</head>
<body>
    <div class="die">
        <img src="img/die.png">
        <h3>Accesso Negato</h3>
        <p>Mi dispiace, ma non disponi dei permessi necessari per accedere a questa pagina.</p>
        <span id='countdown'>Tra 10s verrai reindirizzato all'homepage</span>
        <a href='index.php'>Torna alla Home</a>

        <script>
            let countdown = 10;
            
            function updateCountdown() {
                document.getElementById('countdown').textContent = `Tra ${countdown}s verrai reindirizzato all'homepage`;
            }

            function redirect() {
                window.location.href = 'index.php';
            }

            updateCountdown(); // Mostra il conteggio iniziale

            const countdownInterval = setInterval(() => {
                countdown--;
                updateCountdown();

                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    redirect();
                }
            }, 1000);
        </script>
    </div>
</body>
</html>