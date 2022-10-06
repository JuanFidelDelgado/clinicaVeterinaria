<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$USUARIO= unserialize($_SESSION['usuario']);
$rol= new Usuario('id', $USUARIO->getId());
$paciente= new Pacientes('id', $_REQUEST['idPaciente']);
$cita= new Citas('id', $_REQUEST['idCita']);
$medico= new Usuario('id', $_REQUEST['idMedico']);
//$historiaClinica= new HistoriaClinica('id', $_REQUEST['idHistoriaClinica']);

$resultado= Consulta::getListaEnObjetos("idPaciente={$_REQUEST['idPaciente']}", "idPaciente");
$cuenta= count($resultado);

$lista='';
for ($i = 0; $i < count($resultado); $i++) {
    $consultas=$resultado[$i];
    $lista.="<tr>";
    $lista.="<td>{$consultas->getId()}</td>";
    $lista.="<td>{$cita->getFecha()} - {$cita->getHora()}</td>";
    $lista.="<td>{$medico->getNombres()} - {$medico->getApellidos()}</td>";
    $lista.="<td>{$cita->getEstadoCita()}</td>";
    //$lista.="<td>";
    if ($rol->getTipoUsuarioEnObjeto()=='Médico' && $cita->getEstadoCita()=='Programada'){
            $lista.="<td><a href='principal.php?CONTENIDO=presentacion/consulta/consulta.php&idPaciente={$cita->getIdPaciente()}&idCita={$cita->getId()}&idMedico={$USUARIO->getId()}&idHistoriaClinica={$historiaClinica->getId()}'>Diligenciar consulta</a></td>";
        }
    //$lista.="</td>";
    $lista.="</tr>";
}
?>

<h3 align="center">CONSULTAS CLINICAS DE - <?= strtoupper($paciente->getNombre()) ?></h3>
<p></p>
<table border="1" align="center">
    <tr>
        <th>IdConsulta</th><th>Fecha Consulta</th><th>Médico</th><th>Estado Consulta</th><th></th>        
    <?=$lista?>
</table>

<script type="text/javascript">
function eliminar(id){
    var respuesta=confirm("¿Está seguro de eliminar este registro?");
    if (respuesta)location="principal.php?CONTENIDO=presentacion/consulta/historiaClinicaActualizar.php&accion=Eliminar&id="+id;
}
</script>

