<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$lista='';
$resultado= TipoAlimentacion::getListaEnObjetos(null, 'id');
for ($i = 0; $i < count($resultado); $i++) {
    $tipoAlimentacion=$resultado[$i];
    $lista.="<tr>";
    $lista.="<td>{$tipoAlimentacion->getTipo()}</td>";
    $lista.="<td>{$tipoAlimentacion->getObservaciones()}</td>";
    $lista.="<td>";
        $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/tipoAlimentacionFormulario.php&accion=Modificar&id={$tipoAlimentacion->getId()}' title='Modificar'><img src='presentacion/imagenes/update.png'></a>";
        $lista.="<img src='presentacion/imagenes/delete.png' onClick='eliminar({$tipoAlimentacion->getId()})' title='Eliminar'>";
    $lista.="</td>";
    $lista.="</tr>";
}
?>

<h3 align="center">TIPOS DE ALIMENTACIÓN</h3>
<p></p>
<table border="1" align="center">
    <tr>
        <th>Tipo</th><th>Observaciones</th>
        <th><a href="principal.php?CONTENIDO=presentacion/configuracion/tipoAlimentacionFormulario.php&accion=Adicionar" name="Adicionar"><img src='presentacion/imagenes/add.png' title='Adicionar'></a></th>
    </tr>
    <?=$lista?>
</table>

<script type="text/javascript">
function eliminar(id){
    var respuesta=confirm("¿Está seguro de eliminar este registro?");
    if (respuesta)location="principal.php?CONTENIDO=presentacion/configuracion/tipoAlimentacionActualizar.php&accion=Eliminar&id="+id;
}
</script>
