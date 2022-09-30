<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$tipoAlimentacion= new TipoAlimentacion(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $tipoAlimentacion->setTipo($_REQUEST['tipo']);
        $tipoAlimentacion->setObservaciones($_REQUEST['observaciones']);
        $tipoAlimentacion->guardar();
        break;
    case 'Modificar':
        $tipoAlimentacion->setId($_REQUEST['id']);
        $tipoAlimentacion->setTipo($_REQUEST['tipo']);
        $tipoAlimentacion->setObservaciones($_REQUEST['observaciones']);
        $tipoAlimentacion->modificar();
        break;
    case 'Eliminar':
        $tipoAlimentacion->setId($_REQUEST['id']);
        $tipoAlimentacion->eliminar();
        break;
}
header('location: principal.php?CONTENIDO=presentacion/configuracion/tipoAlimentacion.php')
?>