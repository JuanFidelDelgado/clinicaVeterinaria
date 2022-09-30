<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once dirname(__FILE__) . "/../../logica/clasesGenericas/ConectorBD.php";
require_once dirname(__FILE__) . "/../../logica/clases/Usuario.php";
require_once dirname(__FILE__) . "/../../logica/clases/TipoUsuario.php";
require_once dirname(__FILE__) . "/../../logica/clases/TipoIdentificacion.php";
require_once dirname(__FILE__) . "/../../logica/clases/Pacientes.php";

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$USUARIO= unserialize($_SESSION['usuario']);
$usuario= new Usuario('id', $USUARIO->getId());
//echo $usuario->getNombres();

/*
$titulo='Cambiar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $usuario = new Usuario('id', $_REQUEST['id']);
} else {
    $usuario = new Usuario(null, null);
}
*/
?>

<h3>CAMBIAR CLAVE</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/usuariosActualizar.php">
    <table border="0">
        <tr><th>Identificación</th><td><input type="text" name="identificacion" size="50" maxlength="50" value="" required></td></tr>
        <tr><th>Clave nueva</th><td><input type="password" name="claveNueva" size="50" maxlength="32" value="" required></td></tr>
    </table><p>
        <input type="hidden" name="id" value="<?= $usuario->getId()?>"/>
    <input type="submit" name="accion" value="Cambiar"/>
</form>