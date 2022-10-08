<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$paciente= $_REQUEST['idPaciente'];
$paciente= new Pacientes('id', $_REQUEST['idPaciente']);

$resultado= HistoriaClinica::getListaEnObjetos("idPaciente={$_REQUEST['idPaciente']}", "idPaciente");
$cuenta= count($resultado);

$lista='';
for ($i = 0; $i < count($resultado); $i++) {
    $historiaClinica=$resultado[$i];
    $lista.="<tr>";
    $lista.="<td>{$historiaClinica->getFecha()}</td>";
    //$lista.="<td>{$historiaClinica->getIdPaciente()}</td>";
    $lista.="<td>{$historiaClinica->getFechaEsterilizacion()}</td>";
    $lista.="<td>{$historiaClinica->getTipoAlimentacion()}</td>";
    $lista.="<td>{$historiaClinica->getHabitat()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=presentacion/consulta/historiaClinicaFormulario.php&accion=Modificar&id={$historiaClinica->getId()}&idPaciente={$historiaClinica->getIdPaciente()}' title='Modificar'><img src='presentacion/imagenes/update.png'></a></td>";
    $lista.="<td><a href='principal.php?CONTENIDO=presentacion/consulta/consultas.php&idHistoria={$historiaClinica->getId()}&idPaciente={$historiaClinica->getIdPaciente()}' title='Ver consultas'>Ver consultas</a></td>";
    $lista.="</tr>";
}
?>

<h3 align="center">HISTORIA CLÍNICA - <?= strtoupper($paciente->getNombre()) ?></h3>
<p></p>
<table border="1" align="center">
    <tr>
        <th>Fecha Apertura</th><th>Fecha Esterilización</th><th>Tipo Alimentación</th><th>Habitat</th><th>Modificar</th><th>Historial de consultas</th>
        <?php
        if ($cuenta=='0') {
        ?>
        <th><a href="principal.php?CONTENIDO=presentacion/consulta/historiaClinicaFormulario.php&idPaciente=<?=$_REQUEST['idPaciente']?>" name="Adicionar"><img src='presentacion/imagenes/add.png' title='Adicionar'></a></th>
        <?php
        }
        ?>
    <?=$lista?>
</table>

<script type="text/javascript">
function eliminar(id){
    var respuesta=confirm("¿Está seguro de eliminar este registro?");
    if (respuesta)location="principal.php?CONTENIDO=presentacion/consulta/historiaClinicaActualizar.php&accion=Eliminar&id="+id;
}
</script>
