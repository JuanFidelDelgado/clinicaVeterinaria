<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$habitat= new Habitat(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $habitat->setTipo($_REQUEST['tipo']);
        $habitat->setObservaciones($_REQUEST['observaciones']);
        $habitat->guardar();
        break;
    case 'Modificar':
        $habitat->setId($_REQUEST['id']);
        $habitat->setTipo($_REQUEST['tipo']);
        $habitat->setObservaciones($_REQUEST['observaciones']);
        $habitat->modificar($_REQUEST['id']);
        break;
    case 'Eliminar':
        $habitat->setId($_REQUEST['id']);
        $habitat->eliminar();
        break;
}
header('location: principal.php?CONTENIDO=presentacion/configuracion/habitat.php')
?>
