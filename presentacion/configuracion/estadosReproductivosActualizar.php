<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$estados= new EstadosReproductivos(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $estados->setNombre($_REQUEST['nombre']);
        $estados->setObservaciones($_REQUEST['observaciones']);
        $estados->guardar();
        break;
    case 'Modificar':
        $estados->setId($_REQUEST['id']);
        $estados->setNombre($_REQUEST['nombre']);
        $estados->setObservaciones($_REQUEST['observaciones']);
        $estados->modificar();
        break;
    case 'Eliminar':
        $estados->setid($_REQUEST['id']);
        $estados->eliminar();
        break;
}
header('location: principal.php?CONTENIDO=presentacion/configuracion/estadosReproductivos.php')
?>

