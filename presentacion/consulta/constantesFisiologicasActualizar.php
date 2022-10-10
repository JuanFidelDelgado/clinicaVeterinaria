<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once '../../logica/clases/ConstantesFisiologicas.php';
require_once '../../logica/clasesGenericas/ConectorBD.php';

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

//$direccion='location: principal.php?CONTENIDO=presentacion/consulta/consulta.php';
$constantesFisiologicas= new ConstantesFisiologicas(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $constantesFisiologicas->setIdConsulta($_REQUEST['idConsulta']);
        $constantesFisiologicas->setTlc($_REQUEST['tlc']);
        $constantesFisiologicas->setTemperatura($_REQUEST['temperatura']);
        $constantesFisiologicas->setFr($_REQUEST['fr']);
        $constantesFisiologicas->setFc($_REQUEST['fc']);
        $constantesFisiologicas->setPulso($_REQUEST['pulso']);
        $constantesFisiologicas->setPeso($_REQUEST['peso']);
        $constantesFisiologicas->guardar();
        break;
    case 'Modificar':
        $constantesFisiologicas->setIdConsulta($_REQUEST['idConsulta']);
        $constantesFisiologicas->setTlc($_REQUEST['tlc']);
        $constantesFisiologicas->setTemperatura($_REQUEST['temperatura']);
        $constantesFisiologicas->setFr($_REQUEST['fr']);
        $constantesFisiologicas->setFc($_REQUEST['fc']);
        $constantesFisiologicas->setPulso($_REQUEST['pulso']);
        $constantesFisiologicas->setPeso($_REQUEST['peso']);
        $constantesFisiologicas->modificar();
        break;
    case 'Eliminar':
        $constantesFisiologicas->setId($_REQUEST['id']);
        $constantesFisiologicas->eliminar();
        break;
}
//header('location: principal.php?CONTENIDO=presentacion/consulta/consulta.php')
?>