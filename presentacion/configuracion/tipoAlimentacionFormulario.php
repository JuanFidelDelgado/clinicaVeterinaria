<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once dirname(__FILE__) . "/../../logica/clasesGenericas/ConectorBD.php";
require_once dirname(__FILE__) . "/../../logica/clases/TipoAlimentacion.php";


@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$titulo='Adicionar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $tipoAlimentacion = new TipoAlimentacion('id', $_REQUEST['id']);
} else {
    $tipoAlimentacion = new TipoAlimentacion(null, null);
}
?>

<h3><?= strtoupper($titulo) ?> TIPO DE ALIMENTACION</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/tipoAlimentacionActualizar.php">
    <table border="0">
        <tr><th>Tipo</th><td><input type="text" name="tipo" value="<?= $tipoAlimentacion->getTipo() ?>" required></td>
        <tr><th>Observaciones</th><td><input type="text" name="observaciones" size="50" maxlength="500" value="<?= $tipoAlimentacion->getObservaciones() ?>" required></td></tr>
    </table><p>
    <input type="hidden" name="id" value="<?= $tipoAlimentacion->getId()?>">
    <input type="submit" name="accion" value="<?= $titulo ?>"/>
</form>