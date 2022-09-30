<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
/*
require_once "../../logica/clasesGenericas/ConectorBD.php";
require_once "../../logica/clases/Usuario.php";
require_once "../../logica/clases/TipoUsuario.php";
require_once '../../logica/clases/Pacientes.php';
*/
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$USUARIO= unserialize($_SESSION['usuario']);

$usuario= new Usuario(null, null);
$paciente= new Pacientes(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        //Procedimiento para subir el archivo        
        //$nombreArchivo='Mascota'.$_REQUEST['idCliente'].'_'.$paciente->getId();
        $nombreArchivo='Mascota'.$_REQUEST['idCliente'].date("s");
        $ruta='presentacion/pacientes';
        $extension= substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.'));//Esta línea obtiene la extensión del archivo
        move_uploaded_file($_FILES['foto']['tmp_name'], "$ruta/fotos/$nombreArchivo$extension");
        //Fin subir el archivo
        $paciente->setIdUsuario($_REQUEST['idCliente']);
        $paciente->setFoto($nombreArchivo.$extension);
        $paciente->setNombre($_REQUEST['nombre']);
        $paciente->setIdEspecie($_REQUEST['idEspecie']);
        $paciente->setIdRaza($_REQUEST['idRaza']);
        $paciente->setFechaNacimiento($_REQUEST['fechaNacimiento']);
        $paciente->setSexo($_REQUEST['sexo']);
        $paciente->setColor($_REQUEST['color']);
        $paciente->setSeñasParticulares($_REQUEST['señasParticulares']);
        $paciente->guardar();
        break;
    case 'Modificar':
        $paciente->setId($_REQUEST['id']);
        //Procedimiento para subir el archivo        
        //$nombreArchivo='Mascota'.$_REQUEST['idCliente'].'_'.$_REQUEST['id'];
        $nombreArchivo='Mascota'.$_REQUEST['idCliente'].date("s");
        $ruta='presentacion/pacientes';
        $extension= substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.'));//Esta línea obtiene la extensión del archivo
        move_uploaded_file($_FILES['foto']['tmp_name'], "$ruta/fotos/$nombreArchivo$extension");
        //Fin subir el archivo
        $paciente->setIdUsuario($_REQUEST['idCliente']);
        $paciente->setFoto($nombreArchivo.$extension);
        $paciente->setNombre($_REQUEST['nombre']);
        $paciente->setIdEspecie($_REQUEST['idEspecie']);
        $paciente->setIdRaza($_REQUEST['idRaza']);
        $paciente->setFechaNacimiento($_REQUEST['fechaNacimiento']);
        $paciente->setSexo($_REQUEST['sexo']);
        $paciente->setColor($_REQUEST['color']);
        $paciente->setSeñasParticulares($_REQUEST['señasParticulares']);
        $paciente->modificar();
        break;
    case 'Eliminar':
        $paciente->setId($_REQUEST['id']);
        $paciente->eliminar();
        break;
}
header('location: principal.php?CONTENIDO=presentacion/configuracion/pacientes.php')
?>
