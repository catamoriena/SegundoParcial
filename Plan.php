<?php
class Plan {
    private $codigo;
    private $canales;
    private $importe;
    private $incluyeMG;

    public function __construct($codigo, $canales, $importe, $incluyeMG = true)
    {
        $this->codigo = $codigo;
        $this->canales = $canales;
        $this->importe = $importe;
        $this->incluyeMG = $incluyeMG;
    }

    //get
    public function getCodigo(){
        return $this->codigo;
    }
    public function getCanales(){
        return $this->canales;
    }
    public function getImporte(){
        return $this->importe;
    }
    public function getIncluyeMG(){
        return $this->incluyeMG;
    }

    public function __toString(){
        return 
        "Código: " . $this->codigo . 
        ", Importe: $" . $this->importe . 
        ", Incluye MG: " . ($this->incluyeMG ? "Sí" : "No");
    }
}