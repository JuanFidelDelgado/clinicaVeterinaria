<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$USUARIO= unserialize($_SESSION['usuario']);
@$paciente=$_REQUEST['idPaciente'];
$consulta= new Consulta(null, null);
$usuario= new Usuario('id', $USUARIO->getId());


if ($paciente==null || $paciente==''){
    $historiaClinica= new HistoriaClinica(null, null);
}else {
    $historiaClinica= new HistoriaClinica('idPaciente', $paciente);
}

if ($paciente=='' || $paciente==null){
    $resultado= Citas::getListaEnObjetos(null, "id" );
    $paciente=new Pacientes(null, 'id');
    $usuario=new Usuario(null, null);
} else {
    $resultado= Citas::getListaEnObjetos("idPaciente={$paciente}", "id");
    $paciente= new Pacientes('id', $paciente);
    $usuario= new Usuario('id', $paciente->getIdUsuario());
}

$lista='';
for ($i = 0; $i < count($resultado); $i++) {
    $citas=$resultado[$i];
    $paciente=$citas->getPaciente();
    $usuario=$paciente->getUsuario();
    $lista.="<tr>";
    $lista.="<td>{$usuario->getNombres()} {$usuario->getApellidos()}</td>";
    $lista.="<td>{$usuario->getTelefono()}</td>";
    $lista.="<td>{$paciente->getNombre()}</td>";
    $lista.="<td>{$paciente->getRaza()}</td>";
    $lista.="<td>{$paciente->getEspecie()}</td>";
    $lista.="<td>{$paciente->calcularEdad($paciente->getFechaNacimiento(), date("Y-m-d"))}</td>";
    $lista.="<td>{$citas->getTipoCita()}</td>";
    $lista.="<td>{$citas->getLugar()}</td>";
    $lista.="<td>{$citas->getFecha()}</td>";
    $lista.="<td>{$citas->getHora()}</td>";
    $lista.="<td>{$citas->getEstadoCita()}</td>";
    if ($citas->getEstadoCita()=='Programada' /*&& $USUARIO->getTipoUsuarioEnObjeto()=='Médico'*/){
        $lista.="<td>";
        $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/citasFormulario.php&accion=Modificar&id={$citas->getId()}&idPaciente={$paciente->getId()}' title='Modificar'><img src='presentacion/imagenes/update.png'></a>";
        $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/citasActualizar.php&accion=Eliminar&id={$citas->getId()}&idPaciente={$paciente->getId()}' title='Cancelar Cita'><img src='presentacion/imagenes/cancel.png'></a>";
        $lista.="</td>";
    } else {
        $lista.="<td></td>";
    }
    if ($usuario->getTipoUsuarioEnObjeto()=='Cliente' && $citas->getEstadoCita()=='Programada') {
        $lista.="<td><a href='principal.php?CONTENIDO=presentacion/consulta/consultaActualizar.php&idPaciente={$citas->getIdPaciente()}&idCita={$citas->getId()}&idMedico={$USUARIO->getId()}&idHistoriaClinica={$historiaClinica->getId()}'>Ir a consulta</a></td>";
    }
    $lista.="</tr>";
}

//$lista.="<img src='presentacion/imagenes/delete.png' onClick='eliminar({$citas->getId()})' title='Eliminar'>";
?>

<h3 align="center">CITAS</h3>
<p></p>
<table border="1" align="center">
    <tr>
        <th>Cliente</th><th>Teléfono</th><th>Paciente</th><th>Raza</th><th>Especie</th><th>Edad</th><th>Tipo Cita</th><th>Lugar Cita</th><th>Fecha</th><th>Hora</th><th>Estado</th><th>Acciones</th><th>Consulta</th>
    </tr>
    <?=$lista?>
</table>
<script type="text/javascript">
function eliminar(id){
    var respuesta=confirm("¿Está seguro de eliminar este registro?");
    if (respuesta)location="citasActualizar.php?accion=Eliminar&id="+id;
}
</script>