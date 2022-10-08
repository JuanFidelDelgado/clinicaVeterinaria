<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$historiaClinica= new HistoriaClinica(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $historiaClinica->setFecha(date('Y-m-d h:i'));
        $historiaClinica->setIdPaciente($_REQUEST['idPaciente']);
        $historiaClinica->setFechaEsterilizacion($_REQUEST['fechaEsterilizacion']);
        $historiaClinica->setTipoAlimentacion($_REQUEST['tipoAlimentacion']);
        $historiaClinica->setHabitat($_REQUEST['habitat']);
        $historiaClinica->guardar();
        break;
    case 'Modificar':
        $historiaClinica->setFecha(date('Y-m-d h:i'));
        $historiaClinica->setIdPaciente($_REQUEST['idPaciente']);
        $historiaClinica->setFechaEsterilizacion($_REQUEST['fechaEsterilizacion']);
        $historiaClinica->setTipoAlimentacion($_REQUEST['tipoAlimentacion']);
        $historiaClinica->setHabitat($_REQUEST['habitat']);
        $historiaClinica->modificar();
        break;
    case 'Eliminar':
        $historiaClinica->setId($_REQUEST['id']);
        $historiaClinica->eliminar();
        break;
}
header('location: principal.php?CONTENIDO=presentacion/consulta/historiaClinica.php')
?>