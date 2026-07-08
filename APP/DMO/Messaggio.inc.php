<?php
class Messaggio 
{
  // Attributi
  public $id;
  public $datainvio;
  public $orarioinvio;
  public $orarioricevuto;
  public $orariovisualizzato;
  public $testo;
  public $idutenteinviato;
  public $idutentericevuto;

  //costruttore
  function __construct($id, $datainvio, $orarioinvio, $orarioricevuto, $orariovisualizzato, $testo, $idutenteinviato, $idutentericevuto)
  {
    $this->id = $id;
	$this->datainvio = $datainvio;
    $this->orarioinvio = $orarioinvio;
    $this->orarioricevuto = $orarioricevuto;
    $this->orariovisualizzato = $orariovisualizzato;
    $this->testo = $testo;
    $this->idutenteinviato = $idutenteinviato;
    $this->idutentericevuto = $idutentericevuto;
  }
  //METODI GET E SET
  public function setDatainvio($datainvio)
  {
      if(!empty($datainvio)) $this->datainvio = $datainvio;
  }
  public function getDatainvio()
  {
      return $this->datainvio;
  }
  public function setOrarioinvio($orarioinvio)
  {
      if(!empty($orarioinvio)) $this->orarioinvio = $orarioinvio;
  }
  public function getOrarioinvio()
  {
      return $this->orarioinvio;
  }
  public function setOrarioricevuto($orarioricevuto)
  {
      if(!empty($orarioricevuto)) $this->orarioricevuto = $orarioricevuto;
  }
  public function getOrarioricevuto()
  {
      return $this->orarioricevuto;
  }
  public function setOrariovisualizzato($orariovisualizzato)
  {
      if(!empty($orariovisualizzato)) $this->orariovisualizzato = $orariovisualizzato;
  }
  public function getOrariovisualizzato()
  {
      return $this->orariovisualizzato;
  }
  public function setTesto($testo)
  {
      if(!empty($testo)) $this->testo = $testo;
  }
  public function getTesto()
  {
      return $this->testo;
  }
  public function setIdutentericevuto($idutentericevuto)
  {
      if(!empty($idutentericevuto)) $this->idutentericevuto = $idutentericevuto;
  }
  public function getIdutentericevuto()
  {
      return $this->idutentericevuto;
  }
  public function setIdutenteinviato($idutenteinviato)
  {
      if(!empty($idutenteinviato)) $this->idutenteinviato = $idutenteinviato;
  }
  public function getIdutenteinviato()
  {
      return $this->idutenteinviato;
  }
}
?>