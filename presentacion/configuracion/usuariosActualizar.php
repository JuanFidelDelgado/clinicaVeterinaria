<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
//require_once '../../logica/clases/Usuario.php';


@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$usuario= new Usuario(null, null);
//$rutaRegistro=header('location: principal.php?CONTENIDO=presentacion/configuracion/usuarios.php');
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $usuario->setTipoUsuario($_REQUEST['tipoUsuario']);
        $usuario->setIdentificacion($_REQUEST['identificacion']);
        $usuario->setTipoIdentificacion($_REQUEST['tipoIdentificacion']);
        $usuario->setNombres($_REQUEST['nombres']);
        $usuario->setApellidos($_REQUEST['apellidos']);
        $usuario->setTelefono($_REQUEST['telefono']);
        $usuario->setDireccion($_REQUEST['direccion']);
        $usuario->setTarjetaProfesional($_REQUEST['tarjetaProfesional']);
        $usuario->setCorreoElectronico($_REQUEST['correoElectronico']);
        $usuario->setClave($_REQUEST['clave']);
        $usuario->guardar();
        break;
    case 'Modificar':
        $usuario->setId($_REQUEST['id']);
        $usuario->setTipoUsuario($_REQUEST['tipoUsuario']);
        $usuario->setIdentificacion($_REQUEST['identificacion']);
        $usuario->setTipoIdentificacion($_REQUEST['tipoIdentificacion']);
        $usuario->setNombres($_REQUEST['nombres']);
        $usuario->setApellidos($_REQUEST['apellidos']);
        $usuario->setTelefono($_REQUEST['telefono']);
        $usuario->setDireccion($_REQUEST['direccion']);
        $usuario->setTarjetaProfesional($_REQUEST['tarjetaProfesional']);
        $usuario->setCorreoElectronico($_REQUEST['correoElectronico']);
        $usuario->setClave($_REQUEST['clave']);
        $usuario->modificar();
        break;
    case 'Eliminar':
        $usuario->setId($_REQUEST['id']);
        $usuario->eliminar();
        break;
    case 'Cambiar':
        $usuario->setIdentificacion($_REQUEST['identificacion']);
        
        if ($_REQUEST['claveNueva']==$_REQUEST['claveNueva1']){
            echo "Claves iguales";
            $usuario->setClave($_REQUEST['claveNueva']);
            $usuario->cambiarClave();
            $ruta= 'index.php';
            header('location: '.$ruta);
        } else {
            echo "Las claves ingresadas no son iguales";
            
            //$usuario->errorCambiarClave();
        }
        break;
}
//header('location: principal.php?CONTENIDO=presentacion/configuracion/usuarios.php')
?>