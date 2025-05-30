<?php
include 'EmpresaCable.php';
include 'Canal.php';
include 'Plan.php';
include 'Cliente.php';
include 'Contrato.php';
include 'ContratoWeb.php';

//Crear Canales
$canal1 = new Canal("noticias", 300, true);
$canal2 = new Canal("deportivo", 250, false);
$canal3 = new Canal("películas", 400, true);

//Crear 2 planes (uno debe tener código 111)
$plan1 = new Plan(111, [$canal1, $canal2], 2000, true);
$plan2 = new Plan(222, [$canal2, $canal3], 1800, false);

//Crear 1 cliente
$cliente = new Cliente("DNI", "41436207", "Catalina", "morienacata@gmail.com", "2995330241");

//Crear 1 empresa cable con colecciones vacías
$empresa = new EmpresaCable([], [], [], []);

//Crear contratos
$empresa->incorporarContrato($plan1, $cliente, "2024-06-01", "2024-07-01", false); //contrato en empresa
$empresa->incorporarContrato($plan1, $cliente, "2024-07-01", "2024-08-01", true);  //contrato web 1
$empresa->incorporarContrato($plan1, $cliente, "2024-08-01", "2024-09-01", true);  //contrato web 2

//Obtener los contratos
$contratos = $empresa->getContratos();

//Calcular e imprimir los importes
foreach ($contratos as $i => $contrato) {
    echo "Contrato " . ($i+1) . " - Importe final: $" . $contrato->calcularImporte() . "\n";
}

//Agregar planes a la empresa
$empresa->incorporarPlan($plan1);
$empresa->incorporarPlan($plan2);

//Fechas
$hoy = date("Y-m-d");
$vencimiento = date("Y-m-d", strtotime("+30 days"));

//Contrato en la empresa (no es web)
$empresa->incorporarContrato($plan1, $cliente, $hoy, $vencimiento, false);

//Dos contratos vía web
$empresa->incorporarContrato($plan1, $cliente, $hoy, $vencimiento, true);
$empresa->incorporarContrato($plan2, $cliente, $hoy, $vencimiento, true);

//Obtener contratos creados
$contratos = $empresa->getContratos();

//Pagar uno creado en la empresa
echo "Pago contrato (empresa): $" . $empresa->pagarContrato($contratos[0]->getCodigo()) . "\n";

//Pagar uno creado vía web
echo "Pago contrato (web): $" . $empresa->pagarContrato($contratos[1]->getCodigo()) . "\n";

//Obtener promedio de importes de contratos con código 111
echo "Promedio importe contratos (código 111): $" . $empresa->retornarPromImporteContratos(111) . "\n";