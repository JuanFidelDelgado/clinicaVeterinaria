<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once '../../logica/clases/Citologia.php';
require_once '../../logica/clasesGenericas/ConectorBD.php';

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

//$direccion='location: principal.php?CONTENIDO=presentacion/consulta/consulta.php';
$citologia= new Citologia(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $citologia->setIdConsulta($_REQUEST['idConsulta']);
        $citologia->setNombre($_REQUEST['nombre']);
        $citologia->setObservaciones($_REQUEST['observaciones']);
        $citologia->guardar();
        break;
    case 'Modificar':
        $citologia->setId($_REQUEST['id']);
        $citologia->setIdConsulta($_REQUEST['idConsulta']);
        $citologia->setNombre($_REQUEST['nombre']);
        $citologia->setObservaciones($_REQUEST['observaciones']);
        $citologia->modificar();
        break;
    case 'Eliminar':
        $citologia->setId($_REQUEST['id']);
        $citologia->eliminar();
        break;
}
//header('location: principal.php?CONTENIDO=presentacion/consulta/consulta.php')
?>