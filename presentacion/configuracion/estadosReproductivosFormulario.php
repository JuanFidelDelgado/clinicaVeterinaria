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
    $estados = new EstadosReproductivos('id', $_REQUEST['id']);
} else {
    $estados = new EstadosReproductivos(null, null);
}
?>

<h3><?= strtoupper($titulo) ?> ESTADO</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/estadosReproductivosActualizar.php">
    <table border="0">
        <tr><th>Nombre</th><td><input type="text" name="nombre" size="50" maxlength="50" value="<?= $estados->getNombre() ?>" required></td></tr>
        <tr><th>Observaciones</th><td><input type="text" name="observaciones" size="50" maxlength="500" value="<?= $estados->getObservaciones() ?>"></td></tr>
    </table><p>
    <input type="hidden" name="id" value="<?= $estados->getId()?>">
    <input type="submit" name="accion" value="<?= $titulo ?>"/>
</form>