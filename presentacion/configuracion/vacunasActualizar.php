<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$vacunas= new Vacunas(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $vacunas->setNombre($_REQUEST['nombre']);
        $vacunas->setObservaciones($_REQUEST['observaciones']);
        $vacunas->guardar();
        break;
    case 'Modificar':
        $vacunas->setId($_REQUEST['id']);
        $vacunas->setNombre($_REQUEST['nombre']);
        $vacunas->setObservaciones($_REQUEST['observaciones']);
        $vacunas->modificar();
        break;
    case 'Eliminar':
        $vacunas->setid($_REQUEST['id']);
        $vacunas->eliminar();
        break;
}
header('location: principal.php?CONTENIDO=presentacion/configuracion/vacunas.php')
?>
