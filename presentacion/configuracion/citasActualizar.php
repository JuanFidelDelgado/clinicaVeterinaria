<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once dirname(__FILE__) . '/../../logica/clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../../logica/clases/Usuario.php';
require_once dirname(__FILE__) . '/../../logica/clases/Citas.php';

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

if ($_REQUEST['id']!=null){
    $citaOriginal= new Citas('id', $_REQUEST['id']);
}

$citas= new Citas(null, null);
switch ($_REQUEST['accion']){
    case 'Agendar':
        $citas->setIdPaciente($_REQUEST['idPaciente']);
        $citas->setFecha($_REQUEST['fecha']);
        $citas->setHora($_REQUEST['hora']);
        $citas->setLugar($_REQUEST['lugar']);
        $citas->setEstadoCita($_REQUEST['estadoCita']);
        $citas->setTipoCita($_REQUEST['tipoCita']);
        $citas->guardar();
        break;
    case 'Modificar':
        $citas->setId($_REQUEST['id']);
        $citas->setIdPaciente($_REQUEST['idPaciente']);
        $citas->setFecha($_REQUEST['fecha']);
        $citas->setHora($_REQUEST['hora']);
        $citas->setLugar($_REQUEST['lugar']);
        $citas->setEstadoCita($_REQUEST['estadoCita']);
        $citas->setTipoCita($_REQUEST['tipoCita']);
        $citas->modificar();
        break;
    case 'Eliminar':
        $citas->setId($_REQUEST['id']);
        $citas->setFecha($citaOriginal->getFecha());    
        $citas->setHora($citaOriginal->getHora());
        $citas->setLugar($citaOriginal->getLugar());
        $citas->setTipoCita($citaOriginal->getTipoCita());
        $citas->setEstadoCita('Cancelada');
        $citas->modificar();
        break;
}
header('location: principal.php?CONTENIDO=presentacion/configuracion/citas.php&idPaciente='.$_REQUEST['idPaciente'])
?>
