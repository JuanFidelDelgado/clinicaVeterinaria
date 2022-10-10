<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once '../../logica/clases/PlanDiagnostico.php';
require_once '../../logica/clasesGenericas/ConectorBD.php';

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

//$direccion='location: principal.php?CONTENIDO=presentacion/consulta/consulta.php';
$planDiagnostico= new PlanDiagnostico(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $planDiagnostico->setIdConsulta($_REQUEST['idConsulta']);
        $planDiagnostico->setCuadroHematico($_REQUEST['cuadroHematico']);
        $planDiagnostico->setFechaCuadroHematico($_REQUEST['fechaCuadroHematico']);
        $planDiagnostico->setParcialOrina($_REQUEST['parcialOrina']);
        $planDiagnostico->setFechaParcialOrina($_REQUEST['fechaParcialOrina']);
        $planDiagnostico->setCoprologico($_REQUEST['coprologico']);
        $planDiagnostico->setFechaCoprologico($_REQUEST['fechaCoprologico']);
        $planDiagnostico->setCoproscopico($_REQUEST['coproscopico']);
        $planDiagnostico->setFechaCoproscopico($_REQUEST['fechaCoproscopico']);
        $planDiagnostico->guardar();
        break;
    case 'Modificar':
        $planDiagnostico->setIdConsulta($_REQUEST['idConsulta']);
        $planDiagnostico->setCuadroHematico($_REQUEST['cuadroHematico']);
        $planDiagnostico->setFechaCuadroHematico($_REQUEST['fechaCuadroHematico']);
        $planDiagnostico->setParcialOrina($_REQUEST['parcialOrina']);
        $planDiagnostico->setFechaParcialOrina($_REQUEST['fechaParcialOrina']);
        $planDiagnostico->setCoprologico($_REQUEST['coprologico']);
        $planDiagnostico->setFechaCoprologico($_REQUEST['fechaCoprologico']);
        $planDiagnostico->setCoproscopico($_REQUEST['coproscopico']);
        $planDiagnostico->setFechaCoproscopico($_REQUEST['fechaCoproscopico']);
        $planDiagnostico->modificar();
        break;
    case 'Eliminar':
        $planDiagnostico->setId($_REQUEST['id']);
        $planDiagnostico->eliminar();
        break;
}
//header('location: principal.php?CONTENIDO=presentacion/consulta/consulta.php')
?>