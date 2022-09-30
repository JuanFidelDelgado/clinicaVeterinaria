<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$titulo='Adicionar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $especie = new Especies('id', $_REQUEST['id']);
} else {
    $especie = new Especies(null, null);
}
?>

<h3><?= strtoupper($titulo) ?> ESPECIE</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/especieActualizar.php">
    <table border="0">
        <tr><th>Nombre</th><td><input type="text" name="nombre" value="<?= $especie->getNombre() ?>" required></td></tr>
    </table><p>
        <input type="hidden" name="id" value="<?= $especie->getId()?>">
    <input type="submit" name="accion" value="<?= $titulo ?>"/>
</form>