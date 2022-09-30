<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$lista='';
//$resultado= Vacunas::getListaEnObjetos(null, 'id');
@$resultado= Vacunas::getListaBuscarEnObjetos($_REQUEST['parametro'], 'id');
for ($i = 0; $i < count($resultado); $i++) {
    $vacunas=$resultado[$i];
    $lista.="<tr>";
    $lista.="<td>{$vacunas->getId()}</td>";
    $lista.="<td>{$vacunas->getNombre()}</td>";
    $lista.="<td>{$vacunas->getObservaciones()}</td>";
    $lista.="<td>";
        $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/vacunasFormulario.php&accion=Modificar&id={$vacunas->getId()}' title='Modificar vacuna'><img src='presentacion/imagenes/update.png'></a>";
        $lista.="<img src='presentacion/imagenes/delete.png' onClick='eliminar({$vacunas->getId()})' title='Eliminar'>";
    $lista.="</td>";
    $lista.="</tr>";
}
?>

<h3 align="center">LISTA DE VACUNAS</h3>
<p></p> 
<form name="formularioBuscar" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/vacunas.php">
    <table border="0" align="center">
        <tr>
            <th>Buscar:</th><th><input type="text" name="parametro" value="" /></th><th><input type="submit" value="Buscar"/></th>
        </tr>
    </table>
</form>
<p></p>
<table border="1" align="center">
    <tr>
        <th>ID</th><th>Nombre</th><th>Observaciones</th><th><a href="principal.php?CONTENIDO=presentacion/configuracion/vacunasFormulario.php&accion=Adicionar" name="Adicionar" title="Adicionar"><img src='presentacion/imagenes/add.png' title='Adicionar'></a></th>
    </tr>
    <?=$lista?>
</table>

<script type="text/javascript">
function eliminar(id){
    var respuesta=confirm("¿Está seguro de eliminar este registro?");
    if (respuesta)location="principal.php?CONTENIDO=presentacion/configuracion/vacunasActualizar.php&accion=Eliminar&id="+id;
}
</script>