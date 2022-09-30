<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$paciente= new Pacientes('id', $_REQUEST['idPaciente']);
$edad= Pacientes::calcularEdad($paciente->getFechaNacimiento(), date("Y-m-d"));
$usuario= new Usuario('id', $paciente->getIdUsuario());
$examen= new ExamenClinico(null, null);
?>

<h3 align="center">EXÁMEN CLÍNICO</h3>
<p></p>
<table border="1" align="center">
    <tr>
        <td colspan="2" rowspan="6"><img src="<?= $paciente->getFoto() ?>" width="100" height="100"></td>
        <th colspan="6">DATOS DEL PACIENTE</th>
    </tr>
    <tr>
        <th>Nombre</th><td><?= $paciente->getNombre() ?></td><th>Especie</th0><td><?= $paciente->getEspecie() ?></td><th>Raza</th><td><?= $paciente->getRaza() ?></td>
    </tr>
    <tr>
        <th>Color</th><td><?= $paciente->getColor() ?></td><th>Edad</th><td><?= $edad ?> años</td><th>Sexo</th><td><?= $paciente->getSexo() ?></td>
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
<p></p>

<table border="1" align="center">
    <form>
        <tr><th>Actitud</th><td colspan="3"><input type="text" name="actitud" size="100" value="<?= $examen->getActitud() ?>"></td></tr>
        <tr><th colspan="2">CONDICIÓN CORPORAL</th></tr>
        <tr><td colspan="4" align="center"><input type="radio" name="condicionCorporal" value="Normal">NORMAL
        <input type="radio" name="condicionCorporal" value="Caquético">CAQUÉTICO
        <input type="radio" name="condicionCorporal" value="Sobrepeso">SOBREPESO
        <input type="radio" name="condicionCorporal" value="Delgado">DELGADO
        <input type="radio" name="condicionCorporal" value="Obeso">OBESO</td></tr>
        
        <tr><th colspan="2">ESTADO HIDRATACIÓN</th></tr>
        <tr><td colspan="4" align="center"><input type="radio" name="estadoHidratacion" value="Normal">NORMAL
        <input type="radio" name="estadoHidratacion" value="Deshidratado 0.0% - 5.0%">DESHIDRATADO 0.0% - 5.0
        <input type="radio" name="estadoHidratacion" value="Deshidratado 0.0% - 5.0%">DESHIDRATADO 6.0% - 7.0
        <input type="radio" name="estadoHidratacion" value="Deshidratado 0.0% - 5.0%">DESHIDRATADO 8.0% - 9.0
        <input type="radio" name="estadoHidratacion" value="Deshidratado 0.0% - 5.0%">DESHIDRATADO > 10.0%</td></tr>
        
        <input type="hidden" name="id" value="<?= $citas->getId() ?>">
        <input type="hidden" name="idPaciente" value="<?= $_REQUEST['idPaciente'] ?>">
        <input type="submit" name="accion" value="<?= $titulo ?>"/>
        
    </form>
</table>

