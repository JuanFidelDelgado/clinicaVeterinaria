<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
//Se define el tipo de usuario que está ingresando para mostrar todos los usuarios o solo el propio
$USUARIO= unserialize($_SESSION['usuario']);
$rol= $USUARIO->getTipoUsuario();

if ($rol=='A'){
    @$resultado= Usuario::getListaBuscarEnObjetos($_REQUEST['parametro'], 'tipoUsuario');
}else {
    $resultado= Usuario::getListaEnObjetos("id={$USUARIO->getId()}", "id");
}
$lista='';
for ($i = 0; $i < count($resultado); $i++) {
    $usuario=$resultado[$i];
    $lista.="<tr>";
    $lista.="<td>{$usuario->getId()}</td>";
    $lista.="<td>{$usuario->getTipoUsuarioEnObjeto()}</td>";
    $lista.="<td>{$usuario->getIdentificacion()}</td>";
    $lista.="<td>{$usuario->getTipoIdentificacion()}</td>";
    $lista.="<td>{$usuario->getNombres()}</td>";
    $lista.="<td>{$usuario->getApellidos()}</td>";
    $lista.="<td>{$usuario->getTelefono()}</td>";
    $lista.="<td>{$usuario->getDireccion()}</td>";
    $lista.="<td>{$usuario->getTarjetaProfesional()}</td>";
    $lista.="<td>{$usuario->getCorreoElectronico()}</td>";
    $lista.="<td>";
        $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/usuariosFormulario.php&accion=Modificar&id={$usuario->getId()}' title='Modificar'><img src='presentacion/imagenes/update.png'></a>";
        if ($rol=='A'){
            $lista.="<img src='presentacion/imagenes/delete.png' onClick='eliminar({$usuario->getId()})' title='Eliminar'>";
        }
    $lista.="</td>";
    if ($usuario->getTipoUsuarioEnObjeto()=='Cliente'){
        $lista.="<td><a href='principal.php?CONTENIDO=presentacion/configuracion/pacientes.php&idUsuario={$usuario->getId()}'>Pacientes</a>";
    }
    $lista.="</tr>";
}
?>

<h3 align="center">LISTA DE USUARIOS</h3>
<p></p>
<form name="formularioBuscar" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/usuarios.php">
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
        <th>Id</th><th>Tipo Usuario</th><th>Identificación</th><th>Tipo Identificación</th><th>Nombres</th><th>Apellidos</th><th>Teléfono</th><th>Dirección</th><th>Tarjeta profesional</th><th>Correo electrónico</th>
        <?php
        if ($rol=='A'){
        ?>
        <th><a href="principal.php?CONTENIDO=presentacion/configuracion/usuariosFormulario.php&accion=Adicionar" name="Adicionar"><img src='presentacion/imagenes/add.png' title='Adicionar'></a></th>
        <?php
        } else {
        ?>
        <th></th>
        <?php
        }
        ?>
        <th>Ver pacientes</th>
    </tr>
    <?=$lista?>
</table>

<script type="text/javascript">
function eliminar(id){
    var respuesta=confirm("¿Está seguro de eliminar este registro?");
    if (respuesta)location="principal.php?CONTENIDO=presentacion/configuracion/usuariosActualizar.php&accion=Eliminar&id="+id;
}
</script>