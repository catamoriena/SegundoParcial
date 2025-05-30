<?php
class EmpresaCable{
    private $planes;
    private $canales;
    private $clientes;
    private $contratos;

    public function __construct($planes, $canales, $clientes, $contratos)
    {
        $this->planes = $planes;
        $this->canales = $canales;
        $this->clientes = $clientes;
        $this->contratos = $contratos;
    }

    public function getContratos(){
        return $this->contratos;
    }
    public function getClientes(){
        return $this->clientes; 
    }


    public function incorporarPlan($nuevoPlan){
        foreach ($this->planes as $planExistente){
            if (
                $planExistente->getIncluyeMG() == $nuevoPlan->getIncluyeMG() &&
                $planExistente->getCanales() == $nuevoPlan->getCanales()
            ){
                return false;
            }
        }
        $this->planes[] = $nuevoPlan;
        return true;
    }

    public function buscarContrato ($tipoDoc, $numDoc){
        foreach ($this->contratos as $contrato){
            $cliente = $contrato->getCliente();
            if (
                $cliente->getTipoDoc() == $tipoDoc &&
                $cliente->getNumDoc() == $numDoc
            ){
                return $contrato;
            }
        }
        return null;
    }

    public function incorporarContrato($plan, $cliente, $fechaInicio, $fechaVencimiento, $esWeb){
        foreach ($this->contratos as $contrato){
            if(
                $contrato->getCliente()->getTipoDoc() == $cliente->getTipoDoc() &&
                $contrato->getCliente()->getNumDoc() == $cliente->getNumDoc() &&
                $contrato->getEstado() != "finalizado"
            ){
                $contrato->setEstado("finalizado");
            }
        }
        $estado = "al día";
        $costo = 0;
        $seRenueva = true;

        if($esWeb){
            $nuevoContrato = new ContratoWeb($fechaInicio, $fechaVencimiento, $plan, $estado, $costo, $seRenueva, $cliente);
        }else{
            $nuevoContrato = new Contrato($fechaInicio, $fechaVencimiento, $plan, $estado, $costo, $seRenueva, $cliente);
        }
        $this->contratos[] = $nuevoContrato;
    }

    public function retornarPromImporteContratos($codigoPlan){
        $totalImporte = 0;
        $cantidad = 0;

        foreach($this->contratos as $contrato){
            if($contrato->getPlan()->getCodigo() == $codigoPlan){
                $totalImporte += $contrato->calcularImporte();
                $cantidad++;
            }
        }
        if($cantidad == 0){
            return 0;
        }
        return $totalImporte / $cantidad;
    }

    public function pagarContrato($codigoContrato){
        foreach($this->contratos as $contrato){
            if($contrato->getCodigo() == $codigoContrato){
                $contrato->actualizarEstadoContrato();
                $estado = $contrato->getEstado();
                $importe = $contrato->calcularImporte();

                if($estado == "finalizado") return null;

                if($estado != "al día"){
                    $dias = $contrato->diasContratoVencido();
                    $importe += $importe * 0.10 * $dias;
                }

                if($estado == "al día" || $estado == "moroso"){
                    $nuevaFecha = new DateTime($contrato->getFechaVencimiento());
                    $nuevaFecha->modify("+1 month");
                    $contrato->setFechaVencimiento($nuevaFecha->format('Y-m-d'));
                    $contrato->setEstado("al día");
                }

                $contrato->setCosto($importe);
                return $importe;
            }
        }
        return null;
    }
}