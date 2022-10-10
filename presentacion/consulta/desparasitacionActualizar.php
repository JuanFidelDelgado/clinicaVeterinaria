<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once '../../logica/clases/Desparasitacion.php';
require_once '../../logica/clasesGenericas/ConectorBD.php';

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

//$direccion='location: principal.php?CONTENIDO=presentacion/consulta/consulta.php';
$desparasitacion= new Desparasitacion(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $desparasitacion->setIdConsulta($_REQUEST['idConsulta']);
        $desparasitacion->setEstadoDesparasitacion($_REQUEST['estadoDesparasitacion']);
        $desparasitacion->setFechaDesparasitacion($_REQUEST['fechaDesparasitacion']);
        $desparasitacion->guardar();
        break;
    case 'Modificar':
        $desparasitacion->setId($_REQUEST['id']);
        $desparasitacion->setIdConsulta($_REQUEST['idConsulta']);
        $desparasitacion->setEstadoDesparasitacion($_REQUEST['estadoDesparasitacion']);
        $desparasitacion->setFechaDesparasitacion($_REQUEST['fechaDesparasitacion']);
        $desparasitacion->modificar();
        break;
    case 'Eliminar':
        $desparasitacion->setId($_REQUEST['id']);
        $desparasitacion->eliminar();
        break;
}
//header('location: principal.php?CONTENIDO=presentacion/consulta/consulta.php')
?>
