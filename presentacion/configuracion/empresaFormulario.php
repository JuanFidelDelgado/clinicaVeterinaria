<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$titulo='Adicionar';
if (isset($_REQUEST['nit'])) {
    $titulo = 'Modificar';
    $empresa = new Empresa('nit', $_REQUEST['nit']);
} else {
    $empresa = new Empresa(null, null);
}
?>

<h3><?= strtoupper($titulo) ?> EMPRESA</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/empresaActualizar.php">
    <table border="0">
        <tr><th>Nit</th><td><input type="text" name="nit" size="50" maxlength="50" value="<?= $empresa->getNit() ?>" required></td></tr>
        <tr><th>Nombre</th><td><input type="text" name="nombre" size="50" maxlength="50" value="<?= $empresa->getNombre() ?>" required></td></tr>
        <tr><th>Dirección</th><td><input type="text" name="direccion" size="50" maxlength="50" value="<?= $empresa->getDireccion() ?>" required></td></tr>
        <tr><th>Teléfono</th><td><input type="text" name="telefono" value="<?= $empresa->getTelefono() ?>" required></td></tr>
        <tr><th>Correo Electrónico</th><td><input type="text" name="correoElectronico" size="50" maxlength="50" value="<?= $empresa->getCorreoElectronico() ?>" required></td></tr>
        <tr><th>Pagina Web</th><td><input type="text" name="paginaWeb" size="50" maxlength="50" value="<?= $empresa->getPaginaWeb() ?>"></td></tr>
        <tr><th>Facebook</th><td><input type="text" name="facebook" size="50" maxlength="50" value="<?= $empresa->getFacebook() ?>"></td></tr>
        <tr><th>Instagram</th><td><input type="text" name="instagram" size="50" maxlength="50" value="<?= $empresa->getInstagram() ?>"></td></tr>
        <tr><th>Twitter</th><td><input type="text" name="twitter" size="50" maxlength="50" value="<?= $empresa->getTwitter() ?>"></td></tr>
    </table><p>
    
    <input type="submit" name="accion" value="<?= $titulo ?>"/>
</form>