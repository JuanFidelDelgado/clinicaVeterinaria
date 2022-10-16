<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

//require_once '../../logica/clasesGenericas/ConectorBD.php';
//require_once '../../logica/clases/Enfermedades.php';

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$lista='';
//$resultado= Enfermedades::getListaEnObjetos(null, 'id');
@$resultado= Enfermedades::getListaBuscarEnObjetos($_REQUEST['parametro'], 'id');
for ($i = 0; $i < count($resultado); $i++) {
    $enfermedades=$resultado[$i];
    $lista.="<tr>";
    //$lista.="<td>{$enfermedades->getId()}</td>";
    $lista.="<td>{$enfermedades->getNombre()}</td>";
    $lista.="<td>{$enfermedades->getDescripcion()}</td>";
    $lista.="<td>";
        $lista.="<a href='enfermedadesFormulario.php?accion=Modificar&id={$enfermedades->getId()}' title='Modificar enfermedad'><img src='../imagenes/update.png'></a>";
        $lista.="<img src='../imagenes/delete.png' onClick='eliminar({$enfermedades->getId()})' title='Eliminar'>";
    $lista.="</td>";
    $lista.="</tr>";
}
?>

<h3 align="center">LISTA DE ENFERMEDADES</h3>
<p></p>
<form name="formularioBuscar" method="post" action="enfermedades.php">
    <table border="0" align="center">
        <tr>
            <th>Buscar:</th><th><input type="text" name="parametro" value="" /></th><th><input type="submit" value="Buscar"/></th>
        </tr>
    </table>
</form>
<p></p>
<table border="1" align="center">
    <tr>
        <th>Nombre</th><th>Descripción</th><th><a href="principal.php?CONTENIDO=presentacion/configuracion/enfermedadesFormulario.php&accion=Adicionar" name="Adicionar" title="Adicionar"><img src='presentacion/imagenes/add.png' title='Adicionar'></a></th>
    </tr>
    <?=$lista?>
    
</table>
<script type="text/javascript">
function eliminar(id){
    var respuesta=confirm("¿Está seguro de eliminar este registro?");
    if (respuesta)location="enfermedadesActualizar.php?accion=Eliminar&id="+id;
}
</script>