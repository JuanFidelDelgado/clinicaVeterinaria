<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$especie= new Especies(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $especie->setNombre($_REQUEST['nombre']);
        $especie->guardar();
        break;
    case 'Modificar':
        $especie->setId($_REQUEST['id']);
        $especie->setNombre($_REQUEST['nombre']);
        $especie->modificar();
        break;
    case 'Eliminar':
        $especie->setId($_REQUEST['id']);
        $especie->eliminar();
        break;
}

header('location: principal.php?CONTENIDO=presentacion/configuracion/especie.php')
?>