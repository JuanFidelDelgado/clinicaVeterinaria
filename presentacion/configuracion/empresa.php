<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

$lista='';
$resultado= Empresa::getListaEnObjetos(null, "nit");
$cuenta= count($resultado);

for ($i = 0; $i < count($resultado); $i++) {
    $empresa=$resultado[$i];
    $lista.='<tr>';
    $lista.="<td>{$empresa->getNit()}</td>";
    $lista.="<td>{$empresa->getNombre()}</td>";
    $lista.="<td>{$empresa->getDireccion()}</td>";
    $lista.="<td>{$empresa->getTelefono()}</td>";
    $lista.="<td>{$empresa->getCorreoElectronico()}</td>";
    $lista.="<td>{$empresa->getPaginaWeb()}</td>";
    $lista.="<td>{$empresa->getFacebook()}</td>";
    $lista.="<td>{$empresa->getInstagram()}</td>";
    $lista.="<td>{$empresa->getTwitter()}</td>";
    $lista.="<td>";
        $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/empresaFormulario.php&accion=Modificar&nit={$empresa->getNit()}' title='Modificar empresa'><img src='presentacion/imagenes/update.png'></a>";
        $lista.="<img src='presentacion/imagenes/delete.png' onClick='eliminar({$empresa->getNit()})' title='Eliminar'>";
    $lista.="</td>";
    $lista.='</tr>';
}
?>

<h3 align="center">DATOS DE LA EMPRESA</h3>
<p></p>
<table border="1" align="center">
    <tr>
        <th>NIT</th><th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Correo Electrónico</th><th>Pagina Web</th><th>Facebook</th><th>Instagram</th><th>Twitter</th>
        <?php
        if ($cuenta=='0') {
        ?>
        <th><a href="principal.php?CONTENIDO=presentacion/configuracion/empresaFormulario.php&accion=Adicionar" name="Adicionar"><img src='presentacion/imagenes/add.png' title='Adicionar'></a></th>
        <?php
        }
        ?>
    </tr>
    <?=$lista?>
</table>

<script type="text/javascript">
function eliminar(nit){
    var respuesta=confirm("¿Está seguro de eliminar este registro?");
    if (respuesta)location="principal.php?CONTENIDO=presentacion/configuracion/empresaActualizar.php&accion=Eliminar&nit="+nit;
}
</script>