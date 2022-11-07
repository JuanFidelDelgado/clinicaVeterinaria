<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$citas= new Citas('id', $_REQUEST['idCita']);
$medico= new Usuario('id', $_REQUEST['idMedico']);
$paciente= new Pacientes('id', $_REQUEST['idPaciente']);
$historiaClinica= new HistoriaClinica('idPaciente', $_REQUEST['idPaciente']);

//$examenClinico= new ExamenClinico(null, null);
$consulta= new Consulta(null, null);
$consulta->setFecha(date('Y-m-d'));
$consulta->setIdCita($citas->getId());
$consulta->setIdMedico($medico->getId());
$consulta->setIdPaciente($paciente->getId());
$consulta->setIdHistoriaClinica($historiaClinica->getId());
$citas->setEstadoCita('Cumplida');
$citas->modificar();
$consulta->guardar();
header('location: principal.php?CONTENIDO=presentacion/consulta/consulta.php&idPaciente='.$_REQUEST['idPaciente'].'&idCita='.$_REQUEST['idCita'])
?>