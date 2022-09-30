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
    $habitat = new Habitat('id', $_REQUEST['id']);
} else {
    $habitat = new Habitat(null, null);
}
?>

<h3><?= strtoupper($titulo) ?> HABITAT</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/habitatActualizar.php">
    <table border="0">
        <tr><th>Tipo de hábitat</th><td><input type="text" name="tipo" value="<?= $habitat->getTipo() ?>" required></td>
        <tr><th>Observaciones</th><td><input type="text" name="observaciones" size="50" maxlength="50" value="<?= $habitat->getObservaciones() ?>" required></td></tr>        
    </table><p>
    <input type="hidden" name="id" value="<?= $habitat->getId()?>">
    <input type="submit" name="accion" value="<?= $titulo ?>"/>
</form>
