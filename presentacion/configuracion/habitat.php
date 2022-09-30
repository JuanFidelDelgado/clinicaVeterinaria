<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$lista='';
@$resultado= Habitat::getListaBuscarEnObjetos($_REQUEST['parametro'], 'id');
for ($i = 0; $i < count($resultado); $i++) {
    $habitat=$resultado[$i];
    $lista.="<tr>";
    $lista.="<td>{$habitat->getTipo()}</td>";
    $lista.="<td>{$habitat->getObservaciones()}</td>";
    $lista.="<td>";
        $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/habitatFormulario.php&accion=Modificar&id={$habitat->getId()}' title='Modificar'><img src='presentacion/imagenes/update.png'></a>";
        $lista.="<img src='presentacion/imagenes/delete.png' onClick='eliminar({$habitat->getId()})' title='Eliminar'>";
    $lista.="</td>";
    $lista.="</tr>";
}
?>

<h3 align="center" >LISTA DE HÁBITAT</h3>
<p></p>
<form name="formularioBuscar" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/habitat.php">
    <table border="0" align="center">
        <tr>
            <th>Buscar:</th><th><input type="text" name="parametro" value="" /></th><th><input type="submit" value="Buscar"/></th>
            <th><a href="principal.php?CONTENIDO=inicio.php" name="Home" title="Home"><img src='presentacion/imagenes/home.png' title='Home'></a></th>
        </tr>
    </table>
</form>
<p></p>
<table border="1" align="center">
    <tr>
        <th>Tipo de hábitat</th><th>Observaciones</th>
        <th><a href="principal.php?CONTENIDO=presentacion/configuracion/habitatFormulario.php&accion=Adicionar" name="Adicionar"><img src='presentacion/imagenes/add.png' title='Adicionar'></a></th>
    </tr>
    <?=$lista?>
</table>

<script type="text/javascript">
function eliminar(id){
    var respuesta=confirm("¿Está seguro de eliminar este registro?");
    if (respuesta)location="principal.php?CONTENIDO=presentacion/configuracion/habitatActualizar.php&accion=Eliminar&id="+id;
}
</script>