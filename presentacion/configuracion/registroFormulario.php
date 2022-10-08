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

$titulo='Adicionar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $usuario = new Usuario('id', $_REQUEST['id']);
} else {
    $usuario = new Usuario(null, null);
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/hojaDeEstilo.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"/>
        <title>CLÍNICA VETERINARIA ANIMAL CENTER</title>
    </head>
    <body>
        <div class="registro">
            <div class="formularioRegistro">
                <h3 align="center">REGISTRO DE CLIENTES</h3>
                <form name="formulario" method="post" action="registroActualizar.php">
                    <table border="0" align="center">
                        <tr><th>Identificación</th><td><input type="text" name="identificacion" size="50" maxlength="50" value="<?= $usuario->getIdentificacion() ?>" required></td></tr>
                        <tr><th>Tipo Identificación</th><td><input type="radio" name="tipoIdentificacion" value="1">Cédula de cidadanía</td></tr>
        <tr><th></th><td><input type="radio" name="tipoIdentificacion" value="2">Tarjeta de identidad</td></tr>
            <tr><th></th><td><input type="radio" name="tipoIdentificacion" value="3">Cédula de extranjería</td></tr>
            <tr><th></th><td><input type="radio" name="tipoIdentificacion" value="4">Identificación tributaria</td></tr>
                        <tr><th>Nombres</th><td><input type="text" name="nombres" value="<?= $usuario->getNombres() ?>" required></td></tr>
                        <tr><th>Apellidos</th><td><input type="text" name="apellidos" size="50" maxlength="50" value="<?= $usuario->getApellidos() ?>"></td></tr>
                        <tr><th>Teléfono</th><td><input type="text" name="telefono" size="50" maxlength="50" value="<?= $usuario->getTelefono() ?>" required></td></tr>
                        <tr><th>Dirección</th><td><input type="text" name="direccion" size="50" maxlength="50" value="<?= $usuario->getDireccion() ?>" required></td></tr>
                        <tr><th>Tarjeta Profesional</th><td><input type="text" name="tarjetaProfesional" size="50" maxlength="50" value="<?= $usuario->getTarjetaProfesional() ?>"></td></tr>
                        <tr><th>Correo Electrónico</th><td><input type="text" name="correoElectronico" size="50" maxlength="50" value="<?= $usuario->getCorreoElectronico() ?>" required></td></tr>
                        <tr><th>Clave</th><td><input type="password" name="clave" size="50" maxlength="32" value="<?= $usuario->getClave() ?>" required></td></tr>            
                    <input type="hidden" name="id" value="<?= $usuario->getId()?>"/>
                    <input type="hidden" name="tipoUsuario" value="C"/>
                    <tr><th colspan="2"><input type="submit" name="accion" value="<?= $titulo ?>"/></th></tr>
                    </table><p>
                </form>
            </div>
        </div>
    </body>
</html>