<?php
class Utente 
{
  // Attributi
  public $id;
  public $nome;
  public $cognome;
  public $username;
  public $email;
  public $pwd;

  //costruttore
  function __construct($nome, $cognome, $username, $email, $pwd)
  {
      $this->nome = $nome;
      $this->cognome = $cognome;
      $this->username = $username;
      $this->email = $email;
      $this->pwd = $pwd;
  }
  //METODI GET E SET
  public function setNome($nome)
  {
    if(!empty($nome)) $this->nome = $nome;
  }
  public function getNome()
  {
    return $this->nome;
  }
  public function setCognome($cognome)
  {
    if(!empty($cognome)) $this->cognome = $cognome;
  }
  public function getCognome()
  {
    return $this->cognome;
  }
  public function setUsername($username)
  {
    if(!empty($username)) $this->username = $username;
  }
  public function getUsername()
  {
    return $this->username;
  }
  public function setEmail($email)
  {
    if(!empty($email)) $this->email = $email;
  }
  public function getEmail()
  {
    return $this->email;
  }
  public function setpwd($pwd)
  {
    if(!empty($pwd)) $this->pwd = $pwd;
  }
  public function getpwd()
  {
    return $this->pwd;
  }
}
?>