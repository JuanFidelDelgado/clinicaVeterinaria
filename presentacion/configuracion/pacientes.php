<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$USUARIO= unserialize($_SESSION['usuario']);
$rol= $USUARIO->getTipoUsuario();

@$idUsuario=$_REQUEST['idUsuario'];
if ($idUsuario=='' || $idUsuario==null){
    $resultado= Pacientes::getListaEnObjetos(null, "id");
    $lista='';
    for ($i = 0; $i < count($resultado); $i++) {
        $paciente=$resultado[$i];
        $usuario=new Usuario('id', $paciente->getIdUsuario());
        $historiaClinica= new HistoriaClinica('idpaciente', $paciente->getId());
        $lista.="<tr>";
        $lista.="<td>{$usuario->getNombres()} {$usuario->getApellidos()}</td>";
        $lista.="<td>{$usuario->getTelefono()}</td>";
        $lista.="<td><img src='presentacion/pacientes/fotos/{$paciente->getFoto()}' width='80' heigth='100'/></td>";
        $lista.="<td>{$paciente->getNombre()}</td>";
        $lista.="<td>{$paciente->getEspecie()}</td>";
        $lista.="<td>{$paciente->getRaza()}</td>";
        $lista.="<td>{$paciente->getFechaNacimiento()}</td>";
        $lista.="<td>{$paciente->getSexo()}</td>";
        $lista.="<td>{$paciente->getColor()}</td>";
        $lista.="<td>{$paciente->getSeñasParticulares()}</td>";
        $lista.="<td>";
            $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/pacientesFormulario.php&accion=Modificar&id={$paciente->getId()}&idUsuario={$usuario->getId()}' title='Modificar'><img src='presentacion/imagenes/update.png'></a>";
            $lista.="<img src='presentacion/imagenes/delete.png' onClick='eliminar({$paciente->getId()})' title='Eliminar'>";
        $lista.="</td>";
        $lista.="<td><a href='principal.php?CONTENIDO=presentacion/consulta/historiaClinica.php&idPaciente={$paciente->getId()}' title='Ver historia clinica'><img src='presentacion/imagenes/folder.png'></a></td>";
        if ($historiaClinica->getId()==null){
            $lista.="<td>El paciente no tiene historia clínica</td>";            
        } else {
            $lista.="<td>";
                $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/citas.php&idPaciente={$paciente->getId()}' title='Ver citas'><img src='presentacion/imagenes/calendar.png' width='40' heigth='40'></a>";
                $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/citasFormulario.php&idPaciente={$paciente->getId()}' title='Agendar cita'><img src='presentacion/imagenes/add.png'></a>";
            $lista.="</td>";
        }
        $lista.="</tr>";
    }
} else {
    $usuario= new Usuario('id', $_REQUEST['idUsuario']);
    $resultado= Pacientes::getListaEnObjetos("idUsuario={$idUsuario}", "id");
    $lista='';
    for ($i = 0; $i < count($resultado); $i++) {
        $paciente=$resultado[$i];
        $historiaClinica= new HistoriaClinica('idpaciente', $paciente->getId());
        $lista.="<tr>";
        $lista.="<td>{$usuario->getNombres()} {$usuario->getApellidos()}</td>";
        $lista.="<td>{$usuario->getTelefono()}</td>";
        $lista.="<td><img src='presentacion/pacientes/fotos/{$paciente->getFoto()}' width='50' heigth='70'/></td>";
        $lista.="<td>{$paciente->getNombre()}</td>";
        $lista.="<td>{$paciente->getEspecie()}</td>";
        $lista.="<td>{$paciente->getRaza()}</td>";
        $lista.="<td>{$paciente->getFechaNacimiento()}</td>";
        $lista.="<td>{$paciente->getSexo()}</td>";
        $lista.="<td>{$paciente->getColor()}</td>";
        $lista.="<td>{$paciente->getSeñasParticulares()}</td>";
        $lista.="<td>";
            $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/pacientesFormulario.php&accion=Modificar&id={$paciente->getId()}&idUsuario={$usuario->getId()}' title='Modificar'><img src='presentacion/imagenes/update.png'></a>";
            $lista.="<img src='presentacion/imagenes/delete.png' onClick='eliminar({$paciente->getId()})' title='Eliminar'>";
        $lista.="<td><a href='principal.php?CONTENIDO=presentacion/consulta/historiaClinica.php&idPaciente={$paciente->getId()}' title='Ver historia clinica'><img src='presentacion/imagenes/folder.png'></a></td>";
        if ($historiaClinica->getId()==null){
            $lista.="<td>El paciente no tiene historia clínica</td>";            
        } else {
            $lista.="<td>";
                $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/citas.php&idPaciente={$paciente->getId()}' title='Ver citas'><img src='presentacion/imagenes/calendar.png' width='40' heigth='40'></a>";
                $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/citasFormulario.php&idPaciente={$paciente->getId()}' title='Agendar cita'><img src='presentacion/imagenes/add.png'></a>";
            $lista.="</td>";
        }
        $lista.="</tr>";;
        $lista.="</tr>";
    }
}  
?>


<?php
if ($rol=='C'){
?>
<h3 align="center">MIS MASCOTAS</h3>
<?php
} else {
?>      
<h3 align="center">MIS PACIENTES</h3>
<?php
}
?>


<p></p>
<table border="1" align="center">
    <tr>
        <th>Propietario</th><th>Teléfono</th><th>Foto</th><th>Nombre</th><th>Especie</th><th>Raza</th><th>Fecha Nacimiento</th><th>Sexo</th><th>Color</th><th>Señas Particulares</th>
        <?php
        if ($rol=='C'){
        ?>
        <th><a href="principal.php?CONTENIDO=presentacion/configuracion/pacientesFormulario.php&accion=Adicionar" name="Adicionar"><img src='presentacion/imagenes/add.png' title='Adicionar'></a></th>
        <?php
        } else {
        ?>      
        <th></th>
        <?php
        }
        ?>
        <th>Historia<br>Clínica</th><th>Citas</th>
    </tr>
    <?=$lista?>
</table>

<script type="text/javascript">
function eliminar(id){
    var respuesta=confirm("¿Está seguro de eliminar este registro?");
    if (respuesta)location="principal.php?CONTENIDO=presentacion/configuracion/pacientesActualizar.php&accion=Eliminar&id="+id;
}
</script>

<script type="text/javascript">
function mostrarFoto(){
    var lector=new FileReader();
    lector.readAsDataURL(document.formulario.foto.files[0]);
    lector.onloadend = function (){
        document.getElementById("foto").src=lector.result;
    };
}
</script>
