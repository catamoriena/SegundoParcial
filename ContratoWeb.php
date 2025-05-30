<?php

class ContratoWeb extends Contrato{
    private $porcentajeDescuento;

    public function __construct($fechaInicio, $fechaVencimiento, $plan, $estado, $costo, $seRenueva, $cliente, $porcentajeDescuento = 10)
    {
        parent::__construct($fechaInicio, $fechaVencimiento, $plan, $estado, $costo, $seRenueva, $cliente);
        $this->porcentajeDescuento = $porcentajeDescuento;
    }

    public function __toString()
    {
        return parent::__toString() . "\n" . "Descuento: " . $this->porcentajeDescuento . "%";
    }

    public function calcularImporte(){
        $importeSinDescuento = parent::calcularImporte();
        $descuento = ($importeSinDescuento * $this->porcentajeDescuento) / 100;
        return $importeSinDescuento - $descuento;
    }
}