<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$medicamento= new Medicamentos(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $medicamento->setPrincipioActivo($_REQUEST['principioActivo']);
        $medicamento->setPresentacion($_REQUEST['presentacion']);
        $medicamento->setConcentracion($_REQUEST['concentracion']);
        $medicamento->guardar();
        break;
    case 'Modificar':
        $medicamento->setId($_REQUEST['id']);
        $medicamento->setPrincipioActivo($_REQUEST['principioActivo']);
        $medicamento->setPresentacion($_REQUEST['presentacion']);
        $medicamento->setConcentracion($_REQUEST['concentracion']);
        $medicamento->modificar($_REQUEST['id']);
        break;
    case 'Eliminar':
        $medicamento->setId($_REQUEST['id']);
        $medicamento->eliminar();
        break;
}
header('location: principal.php?CONTENIDO=presentacion/configuracion/medicamentos.php')
?>