<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$USUARIO= unserialize($_SESSION['usuario']);
$usuario= new Usuario('id', $USUARIO->getId());

$titulo='Adicionar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $paciente = new Pacientes('id', $_REQUEST['id']);
    //$historiaClinica = new
}else {
    $paciente = new Pacientes(null, null);
}
?>

<h3 align="center"><?= strtoupper($titulo) ?> MASCOTA</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/pacientesActualizar.php" enctype="multipart/form-data">
    <table border="0">
        <tr>
            <td>
                <table border="0">
                    <tr><th>Foto</th><td><input type="file" name="foto" value="<?= $paciente->getFoto() ?>" onchange="mostrarFoto()"></td></tr>
                    <tr><th>Nombre</th><td><input type="text" name="nombre" size="50" maxlength="50" value="<?= $paciente->getNombre() ?>" required></td></tr>
                    <tr><th>Fecha Nacimiento</th><td><input type="date" name="fechaNacimiento" value="<?= $paciente->getFechaNacimiento() ?>" required></td></tr>
                    <tr><th>Sexo</th><td><input type="radio" name="sexo" value="M">Macho</td></tr>
                    <tr><th></th><td><input type="radio" name="sexo" value="H">Hembra</td></tr>
                    <tr><th>Color</th><td><input type="text" name="color" size="50" maxlength="50" value="<?= $paciente->getColor() ?>" required></td></tr>
                    <tr><th>Señas Particulares</th><td><input type="text" name="señasParticulares" size="50" maxlength="50" value="<?= $paciente->getSeñasParticulares() ?>" required></td></tr>
                    <tr><th>Especie</th><td><select name="idEspecie"><?= Especies::getListaEnOptions($paciente->getIdEspecie()) ?>"></select></td></tr>
                    <tr><th>Raza</th><td><select name="idRaza"><?= Razas::getListaEnOptions($paciente->getIdRaza()) ?>"></select></td></tr>
                </table>
            </td>
            <td rawspan="8">
                <img src="presentacion/pacientes/fotos/<?= $paciente->getFoto() ?>" id="foto" width="250" height="200"/>
            </td>
        </tr>
    </table><p>
    <input type="hidden" name="idCliente" value="<?= $usuario->getId() ?>" >
    <input type="hidden" name="id" value="<?= $paciente->getId()?>">
    <input type="submit" name="accion" value="<?= $titulo ?>"/>
</form>
<!-- Esta función se utiliza para mostrar la foto en el formulario de adicion de candidatos -->

<script type="text/javascript">
function mostrarFoto(){
    var lector=new FileReader();
    lector.readAsDataURL(document.formulario.foto.files[0]);
    lector.onloadend = function (){
        document.getElementById("foto").src=lector.result;
    };
}
</script>