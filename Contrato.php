<?php
include 'Plan.php';

class Contrato{
    private $fechaInicio;
    private $fechaVencimiento;
    private $plan;
    private $estado;
    private $costo;
    private $seRenueva;
    private $cliente;


    //Constructor
    public function __construct($fechaInicio, $fechaVencimiento, $plan, $estado, $costo, $seRenueva, $cliente)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->plan = $plan;
        $this->estado = $estado;
        $this->costo = $costo;
        $this->seRenueva = $seRenueva;
        $this->cliente = $cliente;
    }

    //get

    public function getFechaInicio(){
        return $this->fechaInicio;
    }
    public function getFechaVencimiento(){
        return $this->fechaVencimiento;
    }
    public function getPlan(){
        return $this->plan;
    }
    public function getEstado(){
        return $this->estado;
    }
    public function getCosto(){
        return $this->costo;
    }
    public function getSeRenueva(){
        return $this->seRenueva;
    }
    public function getCliente(){
        return $this->cliente;
    }
    public function getCodigo(){
        return $this->plan->getCodigo();
    }

    //set

    public function setFechaInicio($fechaInicio){
        $this->fechaInicio = $fechaInicio;
    }
    public function setFechaVencimiento($fechaVencimiento){
        $this->fechaVencimiento = $fechaVencimiento;
    }
    public function setPlan($plan){
        $this->plan = $plan;
    }
    public function setEstado($estado){
        $this->estado = $estado;
    }
    public function setCosto($costo){
        $this->costo = $costo;
    }
    public function setSeRenueva($seRenueva){
        $this->seRenueva = $seRenueva;
    }
    public function setCliente($cliente){
        $this->cliente = $cliente;
    }


    public function actualizarEstadoContrato(){
        $diasVencidos = $this->diasContratoVencido();
        
        if ($diasVencidos <= 0){
            $this->estado = "al día";
        }elseif ($diasVencidos <= 10){
            $this->estado = "moroso";
        }else{
            $this->estado = "suspendido";
        }
    }

    public function calcularImporte(){
        $importeTotal = $this->plan->getImporte();

        $canales = $this->plan->getCanales();
        foreach ($canales as $canal){
            $importeTotal += $canal->getImporte();
        }
        return $importeTotal;
    }

    //toString
    public function __toString(){
        return "Contrato con estado: " . $this->getEstado();
    }
}