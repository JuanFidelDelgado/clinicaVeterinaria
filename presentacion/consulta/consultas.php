<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$USUARIO= unserialize($_SESSION['usuario']);
$paciente= new Pacientes('id', $_REQUEST['idPaciente']);

$resultado= Consulta::getListaEnObjetos("idHistoriaClinica={$_REQUEST['idHistoria']}", "id");

$lista='';
for ($i = 0; $i < count($resultado); $i++) {
    $consulta=$resultado[$i];
    $cita= new Citas('id', $consulta->getIdCita());
    $medico= new Usuario('id', $consulta->getIdMedico());
    $lista.="<tr>";
    $lista.="<td>{$consulta->getId()}</td>";
    $lista.="<td>{$cita->getFecha()} - {$cita->getHora()}</td>";
    $lista.="<td>{$medico->getNombres()} - {$medico->getApellidos()}</td>";
    $lista.="<td>{$cita->getEstadoCita()}</td>";
    if ($cita->getEstadoCita()=='Cumplida') {
        $lista.="<td><a href='principal.php?CONTENIDO=presentacion/consulta/consulta.php&idPaciente={$consulta->getIdPaciente()}&idCita={$consulta->getIdCita()}&idMedico={$consulta->getIdMedico()}&idHistoriaClinica={$consulta->getIdHistoriaClinica()}'>Ver reporte de consulta</a></td>";
    }
    $lista.="</<tr>";
}
?>

<h3 align="center">CONSULTAS CLINICAS DE - <?= strtoupper($paciente->getNombre()) ?></h3>
<p></p>
<table border="1" align="center">
    <tr>
        <th>IdConsulta</th><th>Fecha Consulta</th><th>Médico</th><th>Estado Consulta</th><th>Ver Consulta</th>        
    <?=$lista?>
</table>

<script type="text/javascript">
function eliminar(id){
    var respuesta=confirm("¿Está seguro de eliminar este registro?");
    if (respuesta)location="principal.php?CONTENIDO=presentacion/consulta/historiaClinicaActualizar.php&accion=Eliminar&id="+id;
}
</script>

