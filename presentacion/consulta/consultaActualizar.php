<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
/*
require_once '../../logica/clases/Consulta.php';
require_once '../../logica/clases/Citas.php';
require_once '../../logica/clases/Usuario.php';
require_once '../../logica/clases/Pacientes.php';
require_once '../../logica/clases/HistoriaClinica.php';
require_once '../../logica/clasesGenericas/ConectorBD.php';
*/
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$citas= new Citas('id', $_REQUEST['idCita']);
$medico= new Usuario('id', $_REQUEST['idMedico']);
$paciente= new Pacientes('id', $_REQUEST['idPaciente']);
$historiaClinica= new HistoriaClinica('id', $_REQUEST['idHistoriaClinica']);

//$examenClinico= new ExamenClinico(null, null);
$consulta= new Consulta(null, null);
$consulta->setFecha(date('Y-m-d'));
$consulta->setIdCita($_REQUEST['idCita']);
$consulta->setIdMedico($_REQUEST['idMedico']);
$consulta->setIdPaciente($_REQUEST['idPaciente']);
$consulta->setIdHistoriaClinica($_REQUEST['idHistoriaClinica']);
$consulta->guardar();
header('location: principal.php?CONTENIDO=presentacion/consulta/consulta.php&idPaciente='.$_REQUEST['idPaciente'].'&idCita='.$_REQUEST['idCita'])
?>