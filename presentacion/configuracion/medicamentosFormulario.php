<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once dirname(__FILE__) . "/../../logica/clasesGenericas/ConectorBD.php";
require_once dirname(__FILE__) . "/../../logica/clases/Usuario.php";
require_once dirname(__FILE__) . '/../../logica/clases/Medicamentos.php';

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$titulo='Adicionar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $medicamento = new Medicamentos('id', $_REQUEST['id']);
} else {
    $medicamento = new Medicamentos(null, null);
}
?>

<h3><?= strtoupper($titulo) ?> MEDICAMENTO</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/medicamentosActualizar.php">
    <table border="0">
        <tr><th>Principio Activo</th><td><input type="text" name="principioActivo" value="<?= $medicamento->getPrincipioActivo() ?>" required></td>
        <tr><th>Presentación</th><td><input type="text" name="presentacion" size="50" maxlength="50" value="<?= $medicamento->getPresentacion() ?>" required></td></tr>
        <tr><th>Concentración</th><td><input type="text" name="concentracion" size="50" maxlength="50" value="<?= $medicamento->getConcentracion() ?>" required></td>
    </table><p>
    <input type="hidden" name="id" value="<?= $medicamento->getId()?>">
    <input type="submit" name="accion" value="<?= $titulo ?>"/>
</form>