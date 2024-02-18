<script>
    function chatbot() 
    { 
        document.getElementById('send-btn').disabled=true;
        event.preventDefault();
        const formData = new FormData(event.target);
        const prompt = formData.get('data');    

        fetch('arduino/datiSerra.php')
            .then(response => response.json())
            .then(dataFromDatabase => {
                console.log(dataFromDatabase);
                const temp = dataFromDatabase.temp;
                const umidita = dataFromDatabase.umidita;
                const orario = dataFromDatabase.data;
                const terra = dataFromDatabase.terra;
                explode = orario.split(" ");
                giorno = explode[0];
                day = giorno.split("-");
                giorno = day[2] + "/" + day[1] + "/" + day[0];
                ora = explode[1];
                
                document.querySelector('.form').innerHTML += `
                    <div class='user-inbox inbox'>
                        <div class='msg-header'>
                            <p>${prompt}</p>
                        </div>
                    </div>`;
                document.getElementById('data').value = '';
                document.getElementById('data').disabled='true';
                document.getElementById('data').placeholder='In attesa di risposta...';
                document.querySelector('.form').innerHTML += `
                        <div class='bot-inbox inbox'>
                            <div class='icon'>
                                <i class="fa-solid fa-robot"></i>
                            </div>
                            <div class='msg-header'>
                                <p id='risposta'><span><i class="fa-solid fa-ellipsis fa-beat"></i></span></p>
                            </div>
                        </div>`;
                document.querySelector('.form').scrollTop = document.querySelector('.form').scrollHeight;
                const data = {
                    messages: [
                        {
                            role: 'system',
                            content: 'Il tuo nome è SerraAI <?php if(isset($_SESSION['utente'])) echo "e io mi chiamo ".$_SESSION['utente']->getNome(); ?> sei un assistente per la mia serra di pomodori. Se sei a conoscenza del mio nome, quando ti chiedo quale sia o come mi chiamo tu dovrai rispondere. Io sono il proprietario di questa serra.  Se ti ringrazio, sii felice dell essermi stato utile. Fai notare all utente quando le domande non sono inerenti alla serra o alla coltivazione. I dati si riferiscono alla serra'+
                                'La temperatura attuale equivale a: ' + temp + '°C. La umidità dell aria attuale equivale a: '+ umidita +' %. La umidità della terra attualmente equivale a: '+ terra +' %.  Questi dati sono aggiornati alle: '+ ora +' del giorno '+ giorno +'. '
                        },
                        {
                            role: 'user',
                            content: prompt 
                        },
                    ],
                    model: 'gpt-3.5-turbo',
                };

                fetch('https://api.openai.com/v1/chat/completions', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer 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',
                    },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(responseData => {
                    const risposta = responseData.choices[0].message.content || 'Nessuna risposta disponibile';
                    var blocco = document.querySelectorAll('#risposta');
                    var ultimoElemento = blocco[blocco.length - 1];
                    ultimoElemento.innerHTML = risposta;
                    document.getElementById('data').placeholder='Scrivi qualcosa...';
                    document.getElementById('data').disabled=false;
                    document.getElementById('send-btn').disabled=false;
                    document.querySelector('.form').scrollTop = document.querySelector('.form').scrollHeight;
                });
            });
    }
</script>
