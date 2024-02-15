<?php
class utente
{
    private $username;
    private $nome;
    private $cognome;
    private $ruolo;

    public function __construct($nom,$cognom,$usernam,$ruolo)
    {
        $this->setNome($nom);
        $this->setCognome($cognom);
        $this->setUsername($usernam);
        $this->setRuolo($ruolo);
    }

    public function setNome($nome)
    {
        $this->nome=$nome;
    }
    public function setCognome($cognome)
    {
        $this->cognome=$cognome;
    }
    public function setUsername($username)
    {
        $this->username=$username;
    }
    public function setRuolo($ruolo)
    {
        $this->ruolo=$ruolo;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    public function getCognome()
    {
        return $this->cognome;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getRuolo()
    {
        return $this->ruolo;
    }
}
?>