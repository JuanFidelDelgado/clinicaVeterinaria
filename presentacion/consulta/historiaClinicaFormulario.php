<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
date_default_timezone_set("America/Bogota");

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$titulo='Adicionar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $historiaClinica = new HistoriaClinica('id', $_REQUEST['id']);
} else {
    $historiaClinica = new HistoriaClinica(null, null);
}
?>

<h3><?= strtoupper($titulo) ?> HISTORIA CLINICA</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/consulta/historiaClinicaActualizar.php">
    <table border="0">
        <tr><th>Fecha Esterilización</th><td><input type="date" name="fechaEsterilizacion" value="<?= $historiaClinica->getFechaEsterilizacion() ?>"></td></tr>
        <tr><th>Tipo Alimentación</th><td><select name="tipoAlimentacion"><?= TipoAlimentacion::getListaEnOptions($historiaClinica->getTipoAlimentacion()) ?>"</select></td></tr>
        <tr><th>Hábitat</th><td><select name="habitat"><?= Habitat::getListaEnOptions($historiaClinica->getHabitat()) ?>"</select></td></tr>
    </table><p>
    
    <input type="hidden" name="idPaciente" value="<?= $_REQUEST['idPaciente']?>"/>
    <input type="submit" name="accion" value="<?= $titulo ?>"/>
</form>