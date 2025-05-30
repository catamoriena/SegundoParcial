<?php
class Cliente{
    private $tipoDoc;
    private $numDoc;
    private $nombre;
    private $email;
    private $telefono;

    public function __construct($tipoDoc, $numDoc, $nombre, $email, $telefono){
        $this->tipoDoc = $tipoDoc;
        $this->numDoc = $numDoc;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->telefono = $telefono;
    }

    public function getTipoDoc(){
        return $this->tipoDoc;
    }
    public function getNumDoc(){
        return $this->numDoc;
    }

    public function __toString(){
        return $this->nombre . " (" . $this->tipoDoc . " " . $this->numDoc . ")";
    }
}
