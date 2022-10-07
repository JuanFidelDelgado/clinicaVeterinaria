<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$citas= new Citas('id', $_REQUEST['idCita']);
$citas->modificarEstadoCita();
$consulta= new Consulta(null, null);
$consulta->setFecha(date('Y-m-d'));
$consulta->setIdCita($_REQUEST['idCita']);
$consulta->setIdMedico($_REQUEST['idMedico']);
$consulta->setIdPaciente($_REQUEST['idPaciente']);
$consulta->setIdHistoriaClinica($_REQUEST['idHistoriaClinica']);
$consulta->guardar();
header('location: principal.php?CONTENIDO=presentacion/consulta/consulta.php&idPaciente='.$_REQUEST['idPaciente'].'&idCita='.$_REQUEST['idCita'])
?>