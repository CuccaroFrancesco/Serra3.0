<?php
function logout()
{
    session_start();
    session_unset();
    session_destroy();
}
function controllaLogin()
{
    session_start();
    if(isset($_SESSION['utente']))
    {
        return true;
    }
    else
    {
        return false;
    }
}
function controllaRuolo($ruolo)
{
    session_start();
    if($_SESSION['utente']->getRuolo()==$ruolo || $_SESSION['utente']->getRuolo()=='admin')
    {
        return true;
    }
    else
    {
        return false;
    }
}
?>
<script language='Javascript'>
    function mostraPass()
    {
        var input = document.getElementById("inputPass");
        var icon = document.getElementById("iconaPass");
        if (input.type == "password") 
        {
            icon.classList="svg-inline--fa fa-eye-slash";
            input.type = "text";
        } 
        else
        {
            icon.classList="svg-inline--fa fa-eye";
            input.type = "password";
        }
    }
</script>