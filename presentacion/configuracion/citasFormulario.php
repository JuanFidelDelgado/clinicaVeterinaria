<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once dirname(__FILE__) . "/../../logica/clasesGenericas/ConectorBD.php";
require_once dirname(__FILE__) . "/../../logica/clases/Usuario.php";
require_once dirname(__FILE__) . "/../../logica/clases/Citas.php";
require_once dirname(__FILE__) . "/../../logica/clases/EstadoCita.php";
require_once dirname(__FILE__) . "/../../logica/clases/TipoCita.php";

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$idPaciente=$_REQUEST['idPaciente'];
$historiaClinica=new HistoriaClinica('idPaciente', $idPaciente);

$titulo='Agendar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $citas = new Citas('id', $_REQUEST['id']);
} else {
    $citas = new Citas(null, null);
}
?>

<h3><?= strtoupper($titulo) ?> CITA</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/citasActualizar.php">
    <table border="0">
        <tr><th>Fecha</th><td><input type=date name="fecha" value="<?= $citas->getFecha() ?>" required></td></tr>
        <tr><th>Hora</th><td><input type="time" name="hora" value="<?= $citas->getHora() ?>" required></td></tr>
        <tr><th>Lugar</th><td><select name="lugar"><?= LugarCita::getListaEnOptions($citas->getLugar()) ?></select></td></tr>
        <tr><th>Tipo</th><td><select name="tipoCita"><?= TipoCita::getListaEnOptions($citas->getTipoCita()) ?></select></td></tr>
        <!--<tr><th>Estado</th><td><select name="estadoCita"><?= EstadoCita::getListaEnOptions($citas->getEstadoCita()) ?></select></td></tr>-->
    </table><p>
    <input type="hidden" name="estadoCita" value="Programada">
    <input type="hidden" name="id" value="<?= $citas->getId() ?>">
    <input type="hidden" name="idPaciente" value="<?= $idPaciente ?>">
    <input type="submit" name="accion" value="<?= $titulo ?>"/>
</form>
