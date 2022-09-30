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
    $raza = new Razas('id', $_REQUEST['id']);
} else {
    $raza = new Razas(null, null);
    $raza->setIdEspecie($_REQUEST['idEspecie']);
}
$especie=$raza->getEspecie();
?>

<h3><?= strtoupper($titulo) ?> RAZA</h3>

<table border="1" align="">
    <tr>
        <th>Especie</th><td colspan="5"><?=$especie->getNombre()?></td>
    </tr>
</table>
<p></p>

<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/razaActualizar.php">
    <table border="0">
        <tr><th>Nombre</th><th></th><td><input type="text" name="nombre" value="<?= $raza->getNombre() ?>" required></td></tr>
        <!--<tr><th>Especie</th><th></th><td><input type="text" name="idEspecie" value="<?= $raza->getIdEspecie() ?>" required></td></tr>-->
    </table><p>
    <input type="hidden" name="id" value="<?= $raza->getId()?>">
    <input type="hidden" name="idAnterior" value="<?= $raza->getId()?>"><!-- Se envia el id como idAnterior para el método modificar -->
    <input type="hidden" name="idEspecie" value="<?= $raza->getIdEspecie()?>"><!-- Se envía idEspecie para que sea reconocido la especie del cual se trata -->
    <input type="submit" name="accion" value="<?= $titulo ?>"/>
</form>