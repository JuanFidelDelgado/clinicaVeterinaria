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
$consulta= new Consulta('idCita', $_REQUEST['idCita']);

$titulo='Adicionar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $examen = new ExamenClinico('id', $_REQUEST['idExamen']);
    //$desparasitacion = new Desparasitacion('id', $_REQUEST['idDesparasitacion']);
} else {
    $examen = new ExamenClinico(null, null);
    //$desparasitacion = new Desparasitacion(null, null);
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
<form name="formularioConsulta" method="post" action="../../presentacion/consulta/consultaActualizar.php">
    <table align="center" border="1">
        <tr>
            <input type="hidden" name="idCita" value="<?=$_REQUEST['idCita']?>">
            <input type="hidden" name="idMedico" value="<?=$_REQUEST['idMedico']?>">
            <input type="hidden" name="idPaciente" value="<?=$_REQUEST['idPaciente']?>">
            <input type="hidden" name="idHistoriaClinica" value="<?=$_REQUEST['idHistoriaClinica']?>">
            <th colspan="6" align="right"><input type="submit" name="guardar" value="Iniciar Consulta"/></th>
        </tr>
    </table>
</form>