<?php<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once dirname(__FILE__) . "/../../logica/clasesGenericas/ConectorBD.php";
require_once dirname(__FILE__) . "/../../logica/clases/Usuario.php";
require_once dirname(__FILE__) . "/../../logica/clases/TipoUsuario.php";
require_once dirname(__FILE__) . "/../../logica/clases/TipoIdentificacion.php";
require_once dirname(__FILE__) . "/../../logica/clases/Pacientes.php";

//@session_start();
//if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$titulo='Adicionar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $usuario = new Usuario('id', $_REQUEST['id']);
} else {
    $usuario = new Usuario(null, null);
}
?>

<h3 align="center"><?= strtoupper($titulo) ?> USUARIO</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/usuariosActualizar.php">
    <table border="0">
        <tr><th>Tipo usuario</th><td><input type="radio" name="tipoUsuario" value="A">Administrador</td></tr>
            <tr><th></th><td><input type="radio" name="tipoUsuario" value="C">Cliente</td></tr>
            <tr><th></th><td><input type="radio" name="tipoUsuario" value="M">Médico</td></tr>
            <tr><th></th><td><input type="radio" name="tipoUsuario" value="S">Asociado</td></tr>
        <tr><th>Identificación</th><td><input type="text" name="identificacion" size="50" maxlength="50" value="<?= $usuario->getIdentificacion() ?>" required></td></tr>
        <tr><th>Tipo Identificación</th><td><select name="tipoIdentificacion"><?= TipoIdentificacion::getListaEnOptions($usuario->getTipoIdentificacion()) ?>"></select></td></tr>
        <tr><th>Nombres</th><td><input type="text" name="nombres" value="<?= $usuario->getNombres() ?>" required></td></tr>
        <tr><th>Apellidos</th><td><input type="text" name="apellidos" size="50" maxlength="50" value="<?= $usuario->getApellidos() ?>"></td></tr>
        <tr><th>Teléfono</th><td><input type="text" name="telefono" size="50" maxlength="50" value="<?= $usuario->getTelefono() ?>" required></td></tr>
        <tr><th>Dirección</th><td><input type="text" name="direccion" size="50" maxlength="50" value="<?= $usuario->getDireccion() ?>" required></td></tr>
        <tr><th>Tarjeta Profesional</th><td><input type="text" name="tarjetaProfesional" size="50" maxlength="50" value="<?= $usuario->getTarjetaProfesional() ?>"></td></tr>
        <tr><th>Correo Electrónico</th><td><input type="text" name="correoElectronico" size="50" maxlength="50" value="<?= $usuario->getCorreoElectronico() ?>" required></td></tr>
        <tr><th>Clave</th><td><input type="password" name="clave" size="50" maxlength="32" value="<?= $usuario->getClave() ?>" required></td></tr>
    </table><p>
    <input type="hidden" name="id" value="<?= $usuario->getId()?>"/>
    <input type="submit" name="accion" value="<?= $titulo ?>"/>
</form>