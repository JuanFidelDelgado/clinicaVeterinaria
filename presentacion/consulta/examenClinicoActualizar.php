<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once '../../logica/clases/ExamenClinico.php';
require_once '../../logica/clasesGenericas/ConectorBD.php';

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

//$direccion='location: principal.php?CONTENIDO=presentacion/consulta/consulta.php';
$examen= new ExamenClinico(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $examen->setIdConsulta($_REQUEST['idConsulta']);
        $examen->setActitud($_REQUEST['actitud']);
        $examen->setCondicionCorporal($_REQUEST['condicionCorporal']);
        $examen->setEstadoHidratacion($_REQUEST['estadoHidratacion']);
        $examen->guardar();
        break;
    case 'Modificar':
        $examen->setId($_REQUEST['id']);
        $examen->setIdConsulta($_REQUEST['idConsulta']);
        $examen->setActitud($_REQUEST['actitud']);
        $examen->setCondicionCorporal($_REQUEST['condicionCorporal']);
        $examen->setEstadoHidratacion($_REQUEST['estadoHidratacion']);
        $examen->modificar();
        break;
    case 'Eliminar':
        $examen->setId($_REQUEST['id']);
        $examen->eliminar();
        break;
}
//header('location: principal.php?CONTENIDO=presentacion/consulta/consulta.php')
?>