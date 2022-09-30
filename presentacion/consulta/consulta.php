<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$USUARIO= unserialize($_SESSION['usuario']);
$medico= new Usuario('id', $USUARIO->getId());

$historiaClinica= new HistoriaClinica('idPaciente', $_REQUEST['idPaciente']);
$paciente= new Pacientes('id', $_REQUEST['idPaciente']);
$usuario= new Usuario('id', $paciente->getIdUsuario());
$cita= new Citas('id', $_REQUEST['idCita']);

$titulo='Adicionar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $examen = new ExamenClinico('id', $_REQUEST['idExamen']);
} else {
    $examen = new ExamenClinico(null, null);
}
?>

<h3 align="center">CONSULTA</h3>
<p></p>

<table border="1" align="center">
    <tr>        
        <th colspan="6">DATOS DEL PROFESIONAL</th>
    </tr>
    <tr>
         <th>Nombres</th><td><?= $medico->getNombres() ?></td><th>Apellidos</th><td><?= $medico->getApellidos() ?></td><th>N° Tarjeta Profesional</th><td><?= $medico->getTarjetaProfesional() ?></td>
    </tr>
</table>
<br>
<table border="1" align="center">
    <tr>
        <td colspan="2" rowspan="6"><img src="presentacion/pacientes/fotos/<?= $paciente->getFoto() ?>" width="100" height="100"></td>
        <th colspan="6">DATOS DEL PACIENTE</th>
    </tr>
    <tr>
        <th>Nombre</th><td><?= $paciente->getNombre() ?></td><th>Especie</th0><td><?= $paciente->getEspecie() ?></td><th>Raza</th><td><?= $paciente->getRaza() ?></td>
    </tr>
    <tr>
        <th>Color</th><td><?= $paciente->getColor() ?></td><th>Edad</th><td><?= $paciente->calcularEdad($paciente->getFechaNacimiento(), date("Y-m-d")) ?> años</td><th>Sexo</th><td><?= $paciente->getSexo() ?></td>
    </tr>
    <tr>
        <th colspan="6">DATOS DEL ACUDIENTE</th>
    </tr>
    <tr>
        <th>Nombres</th><td colspan="2"><?= $usuario->getNombres() ?> <?= $usuario->getApellidos() ?></td><th>Identificacion</th><td colspan="2"><?= $usuario->getIdentificacion() ?></td>
    </tr>
    <tr>
        <th>Teléfono</th><td colspan="2"><?= $usuario->getTelefono() ?></td><th>Correo Electrónico</th><td colspan="2"><?= $usuario->getCorreoElectronico() ?></td>
    </tr>
</table>
<br>
<form name="formExamenClinico" method="post" action="presentacion/consulta/examenClinicoActualizar.php">
    <table align="center" border="1">
        <tr>
            <th colspan="7">
               EXAMEN CLÍNICO 
            </th>
        </tr>
        <tr><th>ACTITUD</th><td colspan="6"><input type="text" name="actitud" value="<?= $examen->getActitud()?>" size="80"/></td></tr>
        <tr><th>CONDICIÓN CORPORAL</th><td><input type="radio" name="condicionCorporal" value="Normal">Normal</td>
            <td><input type="radio" name="condicionCorporal" value="Caquético">Caquético</td>
            <td><input type="radio" name="condicionCorporal" value="Sobrepeso">Sobrepeso</td>
            <td><input type="radio" name="condicionCorporal" value="Delgado">Delgado</td>
            <td><input type="radio" name="condicionCorporal" value="Obeso">Obeso</td>
        </tr>
        <tr><th rawspan="2">ESTADO HIDRATACIÓN</th><td><input type="radio" name="estadoHidratacion" value="Normal">Normal</td>
            <td><input type="radio" name="estadoHidratacion" value="Deshidratado 0.0% - 5.0%">Deshidratado 0.0% - 5.0%</td>
            <td><input type="radio" name="estadoHidratacion" value="Deshidratado 5.0% - 7.0%">Deshidratado 5.0% - 7.0%</td></tr>
        <tr><th></th><td><input type="radio" name="estadoHidratacion" value="Deshidratado 9.0% - 9.0%">Deshidratado 7.0% - 9.0%</td>
            <td><input type="radio" name="estadoHidratacion" value="Deshidratado 9.0% - 10.0%">Deshidratado 9.0% - 10.0%</td>
            <td><input type="radio" name="estadoHidratacion" value="Deshidratado Mayor a 10.0%">Deshidratado Mayor a 10.0%</td>
        </tr>
        <tr>
        <input type="hidden" name="idConsulta" value=""/>
            <td colspan="6" align="right"><input type="submit" name="guardar" value="Adicionar"/></td>
        </tr>
    </table>
</form>

<br>
<table border="1" align="center">
    <tr>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/examenClinico.php&idPaciente=<?= $paciente->getId()?>&idConsulta=" title="Exámen Clínico"><img src="presentacion/imagenes/consulta/examenClinico.png" width="100" height="100"></a></td>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/desparacitacion.php" title="Desparasitación"><img src="presentacion/imagenes/consulta/desparasitacion.png" width="100" height="100"></a></td>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/constantesFisiologicas.php" title="Constantes Fisiológicas"><img src="presentacion/imagenes/consulta/constantesFisiologicas.png" width="100" height="100"></a></td>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/planDiagnostico.php" title="Plan Diagnóstico"><img src="presentacion/imagenes/consulta/planDiagnostico.png" width="100" height="100"></a></td>
    </tr>
    <tr>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/listaProblemas.php" title="Lista de problemas"><img src="presentacion/imagenes/consulta/listaProblemas.png" width="100" height="100"></a></td>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/citologia.php" title="Citología"><img src="presentacion/imagenes/consulta/citologia.png" width="100" height="100"></a></td>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/planTerapeutico.php" title="Plan Terapéutico"><img src="presentacion/imagenes/consulta/planTerapeutico.png" width="100" height="100"></a></td>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/diagnosticoDefinitivo.php" title="Diagnóstico Definitivo"><img src="presentacion/imagenes/consulta/diagnosticoDefinitivo.png" width="100" height="100"></a></td>
    </tr>
</table>

<script type="text/javascript">
function mostrarFoto(){
    var lector=new FileReader();
    lector.readAsDataURL(document.formulario.foto.files[0]);
    lector.onloadend = function (){
        document.getElementById("foto").src=lector.result;
    };
}
</script>

