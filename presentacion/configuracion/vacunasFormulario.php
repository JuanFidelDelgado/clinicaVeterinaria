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
    $vacunas = new Vacunas('id', $_REQUEST['id']);
} else {
    $vacunas = new Vacunas(null, null);
}
?>

<h3 align="center"><?= strtoupper($titulo) ?> VACUNA</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/vacunasActualizar.php" align="center">
    <table border="0" align="center">
        <tr><th>Nombre</th><td><input type="text" name="nombre" size="50" maxlength="20" value="<?= $vacunas->getNombre() ?>" required></td></tr>
        <tr><th>Observaciones</th><td><input type="text" name="observaciones" size="50" maxlength="500" value="<?= $vacunas->getObservaciones() ?>"></td></tr>
    </table><p>
    <input type="hidden" name="id" value="<?= $vacunas->getId()?>">
    <input type="submit" name="accion" value="<?= $titulo ?>"/>
</form>