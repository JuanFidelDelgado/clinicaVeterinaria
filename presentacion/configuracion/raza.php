<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$especie= new Especies('id', $_REQUEST['idEspecie']);

$lista='';
$resultado= Razas::getListaEnObjetos("idEspecie={$especie->getId()}", 'id');
for ($i = 0; $i < count($resultado); $i++) {
    $raza=$resultado[$i];
    $lista.="<tr>";
    $lista.="<td>{$raza->getId()}</td>";
    $lista.="<td>{$raza->getNombre()}</td>";
    $lista.="<td>{$especie->getNombre()}</td>";
    $lista.="<td>";
        $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/razaFormulario.php&accion=Modificar&id={$raza->getId()}' title='Modificar raza'><img src='presentacion/imagenes/update.png'></a>";
        $lista.="<img src='presentacion/imagenes/delete.png' onClick='eliminar({$raza->getId()})' title='Eliminar raza'>";
    $lista.="</td>";
    $lista.="</tr>";
}
?>

<h3 align="center">LISTA DE RAZAS DE <?= strtoupper($especie->getNombre()) ?></h3>
<p></p>
<table border="1" align="center">
    <tr>
        <th>Id</th><th>Nombre</th><th>Especie</th><th><a href="principal.php?CONTENIDO=presentacion/configuracion/razaFormulario.php&idEspecie=<?= $especie->getId() ?>" name="Adicionar"><img src='presentacion/imagenes/add.png' title='Acicionar'></a></th>
    </tr>
    <?=$lista?>
</table>

<script type="text/javascript">
function eliminar(id){
    var respuesta=confirm("¿Está seguro de eliminar este registro?");
    if (respuesta)location="principal.php?CONTENIDO=presentacion/configuracion/razaActualizar.php&accion=Eliminar&id="+id;
}
</script>
