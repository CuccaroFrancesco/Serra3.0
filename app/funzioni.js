function attivaBot() 
{
    var chatBot = document.getElementById('wrapper');
    var btnChat = document.getElementById('btn-chat');
    chatBot.classList.toggle('active');
    if (btnChat.classList=="svg-inline--fa fa-comments") 
    {
        btnChat.classList="svg-inline--fa fa-xmark";
    }
    else
    {
        btnChat.classList="svg-inline--fa fa-comments";
    }
}
function cambiaTema()
{
    document.body.classList.toggle("dark");
}

function controlla()
{
    var position = window.scrollY;
    navbar = document.getElementById('nav');
    wrapper = document.getElementById('wrapper');
    bottone = document.getElementById('bottone');
    var btnChat = document.getElementById('btn-chat');
    if(position>100)
    {
        navbar.classList.add('active');
        bottone.classList.add('active');
    }
    else
    {
        navbar.classList.remove('active');
        bottone.classList.remove('active');
        wrapper.classList.remove('active');
        btnChat.classList="svg-inline--fa fa-comments";
    }
}

window.addEventListener("scroll", controlla);