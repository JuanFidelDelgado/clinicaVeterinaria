<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$USUARIO= unserialize($_SESSION['usuario']);

//$consulta= new Consulta(null, null);
$rol= new Usuario('id', $USUARIO->getId());

$resultado= ExamenClinico::getListaEnObjetos(null, null );

$lista='';
for ($i = 0; $i < count($resultado); $i++) {
    $examen=$resultado[$i];
    $lista.="<tr>";
    $lista.="<td>{$resultado->getId()}</td>";
    $lista.="<td>{$resultado->getIdConsulta()}</td>";
    $lista.="<td>{$resultado->getActitud()}</td>";
    $lista.="<td>{$resultado->getCondicionCorporal()}</td>";
    $lista.="<td>{$resultado->getEstadoHidratacion()}</td>";
    $lista.="<td>";
        $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/examenClinicoFormulario.php?accion=Modificar&id={$examen->getId()}' title='Modificar'><img src='presentacion/imagenes/update.png'></a>";
        $lista.="<img src='presentacion/imagenes/delete.png' onClick='eliminar({$examen->getId()})' title='Eliminar'>";
    $lista.="</td>";
    $lista.="</tr>";
}
?>

<h3 align="center">EXÁMEN CLÍNICO</h3>
<p></p>
<table border="1" align="center">
    <tr>
        <td><img src="<?= $paciente->getFoto() ?>" width="100" height="100"></td>
        <th colspan="12">DATOS DEL PACIENTE</th>
    </tr>
    <tr>
        <th>Nombre</th><td><?= $paciente->getNombre() ?></td><th>Especie</th0><td><?= $paciente->getEspecie() ?></td><th>Raza</th><td><?= $paciente->getRaza() ?></td>
        <th>Color</th><td><?= $paciente->getColor() ?></td><th>Edad</th><td><?= $paciente->calcularEdad($paciente->getFechaNacimiento(), date("Y-m-d")) ?> años</td><th>Sexo</th><td><?= $paciente->getSexo() ?></td>
    </tr>
</table>
<br>

<table border="1">
    <tr><th>ID</th><th>ID CONSULTA</th><th>ACTITUD</th><th>CONDICIÓN CORPORAL</th><th>ESTADO HIDRATACIÓN</th>
        <th><a href="principal.php?CONTENIDO=presentacion/configuracion/consulta/examenClinicoActualizar.php"></a></th><th>ID</th></tr>
</table>

<script type="text/javascript">
function eliminar(id){
    var respuesta=confirm("¿Está seguro de eliminar este registro?");
    if (respuesta)location="principal.php?CONTENIDO=presentacion/configuracion/consulta/examenClinicoActualizar.php?accion=Eliminar&id="+id;
}
</script>