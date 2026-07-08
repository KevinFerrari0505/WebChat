<?php
class File 
{
  // Attributi
  public $id;
  public $contenuto;
  public $tipo;
  public $idmessaggio;

  //costruttore
  function __construct($id, $contenuto, $tipo, $idmessaggio)
  {
    $this->id = $id;
		$this->contenuto = $contenuto;
    $this->tipo = $tipo;
    $this->idmessaggio = $idmessaggio;
  }
  //METODI GET E SET
  public function setContenuto($contenuto)
  {
      if(!empty($contenuto)) $this->contenuto = $contenuto;
  }
  public function getContenuto()
  {
      return $this->contenuto;
  }
  public function setTipo($tipo)
  {
      if(!empty($tipo)) $this->tipo = $tipo;
  }
  public function getTipo()
  {
      return $this->tipo;
  }
  public function setIdmessaggio($idmessaggio)
  {
      if(!empty($idmessaggio)) $this->idmessaggio = $idmessaggio;
  }
  public function getIdmessaggio()
  {
      return $this->idmessaggio;
  }
}
?>