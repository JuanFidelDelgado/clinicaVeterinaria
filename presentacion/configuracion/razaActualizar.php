<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$especie= new Especies(null, null);
$raza= new Razas(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $raza->setNombre($_REQUEST['nombre']);
        $raza->setIdEspecie($_REQUEST['idEspecie']);
        $raza->guardar();
        break;
    case 'Modificar':
        $raza->setId($_REQUEST['id']);
        $raza->setNombre($_REQUEST['nombre']);
        $raza->setIdEspecie($_REQUEST['idEspecie']);
        $raza->modificar($_REQUEST['idAnterior']);
        break;
    case 'Eliminar':
        $raza->setId($_REQUEST['id']);
        $raza->eliminar();
        break;
}
//header('location: principal.php?CONTENIDO=presentacion/configuracion/raza.php&idEspecie=' . $_REQUEST['idEspecie']).'&id='.$_REQUEST['id'];
header('location: principal.php?CONTENIDO=presentacion/configuracion/raza.php&idEspecie=' . $_REQUEST['idEspecie'])
//header('location: principal.php?CONTENIDO=presentacion/configuracion/especie.php')
?>