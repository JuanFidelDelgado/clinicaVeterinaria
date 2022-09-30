<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once '../../logica/clasesGenericas/ConectorBD.php';
require_once '../../logica/clases/Usuario.php';
require_once '../../logica/clases/TipoUsuario.php';
require_once '../../logica/clases/Enfermedades.php';

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$titulo='Adicionar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $enfermedades = new Enfermedades('id', $_REQUEST['id']);
} else {
    $enfermedades = new Enfermedades(null, null);
}
?>

<h3><?= strtoupper($titulo) ?> ENFERMEDAD</h3>
<form name="formulario" method="post" action="enfermedadesActualizar.php">
    <table border="0">
        <tr><th>Nombre</th><td><input type="text" name="nombre" size="50" maxlength="50" value="<?= $enfermedades->getNombre() ?>" required></td></tr>
        <tr><th>Descripcion</th><td><input type="text" name="descripcion" size="50" maxlength="500" value="<?= $enfermedades->getDescripcion() ?>"></td></tr>
    </table><p>
    <input type="hidden" name="id" value="<?= $enfermedades->getId()?>">
    <input type="submit" name="accion" value="<?= $titulo ?>"/>
</form>