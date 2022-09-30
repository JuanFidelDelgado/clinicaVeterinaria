<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$lista='';
@$resultado= Medicamentos::getListaBuscarEnObjetos($_REQUEST['parametro'], 'id');
for ($i = 0; $i < count($resultado); $i++) {
    $medicamento=$resultado[$i];
    $lista.="<tr>";
    $lista.="<td>{$medicamento->getPrincipioActivo()}</td>";
    $lista.="<td>{$medicamento->getPresentacion()}</td>";
    $lista.="<td>{$medicamento->getConcentracion()}</td>";
    $lista.="<td>";
        $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/medicamentosFormulario.php&accion=Modificar&id={$medicamento->getId()}' title='Modificar'><img src='presentacion/imagenes/update.png'></a>";
        $lista.="<img src='presentacion/imagenes/delete.png' onClick='eliminar({$medicamento->getId()})' title='Eliminar'>";
    $lista.="</td>";
    $lista.="</tr>";
}
?>

<h3 align="center">LISTA DE MEDICAMENTOS</h3>
<p></p>
<form name="formularioBuscar" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/medicamentos.php">
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
        <th>Principio Activo</th><th>Presentación</th><th>Concentración</th>
        <th><a href="principal.php?CONTENIDO=presentacion/configuracion/medicamentosFormulario.php&accion=Adicionar" name="Adicionar"><img src='presentacion/imagenes/add.png' title='Adicionar'></a></th>
    </tr>
    <?=$lista?>
</table>

<script type="text/javascript">
function eliminar(id){
    var respuesta=confirm("¿Está seguro de eliminar este registro?");
    if (respuesta)location="principal.php?CONTENIDO=presentacion/configuracion/medicamentosActualizar.php&accion=Eliminar&id="+id;
}
</script>