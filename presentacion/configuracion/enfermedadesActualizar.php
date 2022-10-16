<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$enfermedades= new Enfermedades(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $enfermedades->setNombre($_REQUEST['nombre']);
        $enfermedades->setDescripcion($_REQUEST['descripcion']);
        $enfermedades->guardar();
        break;
    case 'Modificar':
        $enfermedades->setId($_REQUEST['id']);
        $enfermedades->setNombre($_REQUEST['nombre']);
        $enfermedades->setDescripcion($_REQUEST['descripcion']);
        $enfermedades->modificar();
        break;
    case 'Eliminar':
        $enfermedades->setid($_REQUEST['id']);
        $enfermedades->eliminar();
        break;
}
header('location: enfermedades.php')
?>
