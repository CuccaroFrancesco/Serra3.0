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
            temp=data.primo.temp+" C°";
            temp2=data.secondo.temp;
            vtemp=((data.primo.temp-temp2)/temp2)*100;
            vtemp = Math.round(vtemp);
            if(vtemp > 0)
            {
                modifica = "<span class='up'><i class='fa-solid fa-arrow-up'></i> "+ vtemp + " %</span>";
                $('#v-temp').html(modifica);
            }
            else
            {
                if(vtemp == 0)
                {
                    modifica = "<span class='same'><i class='fa-solid fa-arrow-down-up-across-line'></i> "+ vtemp + " %</span>";
                    $('#v-temp').html(modifica);
                }
                else
                {
                    modifica = "<span class='down'><i class='fa-solid fa-arrow-down'></i> "+ vtemp + " %</span>";
                    $('#v-temp').html(modifica);
                }
            }
            umidita2=data.secondo.umidita;
            umidita=data.primo.umidita+" %";
            varia=((data.primo.umidita-umidita2)/umidita2)*100;
            varia = Math.round(varia);
            if(varia > 0)
            {
                modifica = "<span class='up'><i class='fa-solid fa-arrow-up'></i> "+ varia + " %</span>";
                $('#v-aria').html(modifica);
            }
            else
            {
                if(varia == 0)
                {
                    modifica = "<span class='same'><i class='fa-solid fa-arrows-left-right'></i> "+ varia + " %</span>";
                    $('#v-aria').html(modifica);
                }
                else
                {
                    modifica = "<span class='down'><i class='fa-solid fa-arrow-down'></i> "+ varia + " %</span>";
                    $('#v-aria').html(modifica);
                }
            }
            aria=data.primo.temp+" %";
            $('#temp').html(temp);
            $('#aria').html(umidita);
            $('#terra').html(aria);
        },
    });
}

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
                    <?php
                        include('app/config.php');
                        $sql = "SELECT * FROM tabDati ORDER BY data DESC LIMIT 5";
                        $result = $connessione->query($sql);
                        $i=1;
                        while($row = $result->fetch_assoc())
                        {
                            $giorno=explode(" ",$row['data']);
                            echo "<div class='riga'>";
                            echo "<div class='td'>".$i."</div>";
                            echo "<div class='td'>".$giorno[1]."</div>";
                            echo "<div class='td'>".$row['temp']." C°</div>";
                            echo "<div class='td'>".$row['umidita']." %</div>";
                            echo "<div class='td'>".$row['temp']." %</div>";
                            echo "</div>";
                            $i++;
                        }
                        ?>
                </div>
            </div>
        </div>
    <?php
}
?>