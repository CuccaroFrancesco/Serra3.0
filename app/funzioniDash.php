<script>
function opzioniUtente()
{
    icona = document.getElementById('icona-utenti');
    nascosto = document.getElementById('nascosto');
    nascosto.classList.toggle('active');
    if(icona.style.transform=='rotate(-180deg)')
    {
        icona.style.transform='rotate(0deg)';
    }
    else
    {
        icona.style.transform='rotate(-180deg)';
    }
}
function stampaDati() 
{
    $.ajax({
        url: 'arduino/datiSerra.php',
        dataType: 'json',
        success: function (data) 
        {
            temp=data.temp+" C°";
            $('#temp').html(temp);
            umidita=data.umidita+" %";
            $('#aria').html(umidita);
            terra=data.terra+" %";
            $('#terra').html(terra);

            //Valori ideali

            tempIdeale=21;
            umiditaIdeale=70;
            terraIdeale=65;

            //Variazioni temperatura

            diffTemp = data.temp - tempIdeale;
            diffTemp = Math.round(diffTemp);

            var classeColore = (diffTemp > 4 || diffTemp < -4) ? 'down' : 'up';
            var direzioneFreccia = (diffTemp > 0 ) ? 'up' : 'down';

            if (diffTemp === 0) 
            {
                classeColore = 'up';
                diffTemp = 'Ideale';
                direzioneFreccia = 'fa-check';
                modifica = "<span class='" + classeColore + "'><i class='fa-solid" + direzioneFreccia + "'></i> " + diffTemp + "</span>";
            }
            else
                modifica = "<span class='" + classeColore + "'><i class='fa-solid fa-arrow-" + direzioneFreccia + "'></i> " + diffTemp + " °C</span>";

            $('#v-temp').html(modifica);

            //Variazioni umidità aria

            diffAria = data.umidita - umiditaIdeale;
            diffAria = Math.round(diffAria);

            var classeColore = (diffAria > 10 || diffAria < -10) ? 'down' : 'up';
            var direzioneFreccia = (diffAria > 0 ) ? 'up' : 'down';

            if (diffAria === 0) 
            {
                classeColore = 'up';
                diffAria = 'Ideale';
                direzioneFreccia = 'fa-check';
                modifica = "<span class='" + classeColore + "'><i class='fa-solid" + direzioneFreccia + "'></i> " + diffAria + "</span>";
            }
            else
                modifica = "<span class='" + classeColore + "'><i class='fa-solid fa-arrow-" + direzioneFreccia + "'></i> " + diffAria + " %</span>";

            $('#v-aria').html(modifica);

            //Variazioni umidità terra

            diffTerra = data.terra - terraIdeale;
            diffTerra = Math.round(diffTerra);

            var classeColoreTerra = (diffTerra > 5 || diffTerra < -5) ? 'down' : 'up';
            var direzioneFrecciaTerra = (diffTerra > 0 ) ? 'up' : 'down';

            if (diffTerra === 0) 
            {
                classeColoreTerra = 'up';
                diffTerra = 'Ideale';
                direzioneFrecciaTerra = 'fa-check';
                modifica = "<span class='" + classeColoreTerra + "'><i class='fa-solid" + direzioneFrecciaTerra + "'></i> " + diffTerra + "</span>";
            }
            else
                modifica = "<span class='" + classeColoreTerra + "'><i class='fa-solid fa-arrow-" + direzioneFrecciaTerra + "'></i> " + diffTerra + " %</span>";

            $('#v-terra').html(modifica);
        },
    });
}

function storico() {
    $.ajax({
        url: 'arduino/vis.php',
        dataType: 'json',
        success: function (data) {
            $('.table .corpo').empty();
            var id = 1;

            $.each(data, function (index, row) 
            {
                orario = row.data.split(" ");
                var rigaHTML = '<div class="riga">' +
                    '<div class="td">' + id + '</div>' +
                    '<div class="td">' + orario[1] + '</div>' +
                    '<div class="td">' + row.temp + '</div>' +
                    '<div class="td">' + row.umidita + '</div>' +
                    '<div class="td">' + row.terra + '</div>' +
                    '</div>';
                id++;

                $('.table .corpo').append(rigaHTML);
            });
        },
    });
}

storico();
setInterval(storico, 1000);


stampaDati();
setInterval(stampaDati, 1000);
</script>
<?php
function visDati()
{
    
    ?>
        <div class="container-dati">
            <div class="mini-list">
                <div class="dato">
                    <div class="destra">
                        <div class="variazione" id='v-temp'></div>
                    </div>
                    <div class="sinistra">
                        <div class="icon"><i class="fa-solid fa-temperature-three-quarters"></i></div>
                        <div class="info" id='temp'>°C</div>
                        <label>Temperatura</label>
                    </div>
                </div>
                <div class="dato">
                    <div class="destra">
                        <div class="variazione" id='v-aria'></div>
                    </div>
                    <div class="sinistra">
                        <div class="icon"><i class="fa-solid fa-wind"></i></div>
                        <div class="info" id='aria'></div>
                        <label>Umidità aria</label>
                    </div>
                </div>
                <div class="dato">
                    <div class="destra">
                        <div class="variazione" id='v-terra'></div>
                    </div>
                    <div class="sinistra">
                        <div class="icon"><i class="fa-solid fa-droplet"></i></div>
                        <div class="info" id='terra'></div>
                        <label>Umidità terreno</label>
                    </div>
                </div>
            </div>
            <div class="storico">
                <div class="titolo">Storico Dati</div>
                <div class='table'>
                    <div class="intestazioni">
                        <div class='riga'>
                            <div class='th'>ID</div>
                            <div class='th'>Orario</div>
                            <div class='th'>Temperatura</div>
                            <div class='th'>Umidità</div>
                            <div class='th'>Terreno</div>
                        </div>
                    </div>
                    <div class="corpo">
                        <div class="riga"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php
}
?>