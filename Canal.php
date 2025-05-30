<?php

class Canal{
    private $tipo;
    private $importe;
    private $esHD;

    //Constructor
    public function __construct($tipo, $importe, $esHD)
    {
        $this->tipo = $tipo;
        $this->importe = $importe;
        $this->esHD = $esHD;
    }

    //get
    public function getTipo(){
        return $this->tipo;
    }
    public function getImporte(){
        return $this->importe;
    }
    public function getEsHD(){
        return $this->esHD;
    }

    //set
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }
    public function setImporte($importe){
        $this->importe = $importe;
    }
    public function setEsHD($esHD){
        $this->esHD = $esHD;
    }

    //toString
    public function __toString(){
        return 
        "Tipo: " . $this->tipo . 
        ", Importe: $" . $this->importe . 
        ", HD: " . ($this->esHD ? "Sí" : "No");
    }
}