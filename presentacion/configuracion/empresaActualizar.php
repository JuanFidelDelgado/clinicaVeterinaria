<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$empresa= new Empresa(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $empresa->setNit($_REQUEST['nit']);
        $empresa->setNombre($_REQUEST['nombre']);
        $empresa->setDireccion($_REQUEST['direccion']);
        $empresa->setTelefono($_REQUEST['telefono']);
        $empresa->setCorreoElectronico($_REQUEST['correoElectronico']);
        $empresa->setPaginaWeb($_REQUEST['paginaWeb']);
        $empresa->setFacebook($_REQUEST['facebook']);
        $empresa->setInstagram($_REQUEST['instagram']);
        $empresa->setTwitter($_REQUEST['twitter']);
        $empresa->guardar();
        break;
    case 'Modificar':
        $empresa->setNit($_REQUEST['nit']);
        $empresa->setNombre($_REQUEST['nombre']);
        $empresa->setDireccion($_REQUEST['direccion']);
        $empresa->setTelefono($_REQUEST['telefono']);
        $empresa->setCorreoElectronico($_REQUEST['correoElectronico']);
        $empresa->setPaginaWeb($_REQUEST['paginaWeb']);
        $empresa->setFacebook($_REQUEST['facebook']);
        $empresa->setInstagram($_REQUEST['instagram']);
        $empresa->setTwitter($_REQUEST['twitter']);
        $empresa->modificar();
        break;
    case 'Eliminar':
        $empresa->setNit($_REQUEST['nit']);
        $empresa->eliminar();
        break;
}
header('location: principal.php?CONTENIDO=presentacion/configuracion/empresa.php')
?>


