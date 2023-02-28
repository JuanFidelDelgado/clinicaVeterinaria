<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once './logica/clases/Pacientes.php';
require_once './logica/clases/Usuario.php';

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$USUARIO= unserialize($_SESSION['usuario']);
$usuario= Usuario::getListaEnObjetos(null, null);


@$resultado= Usuario::getListaEnObjetos(null, "id");
$lista='';
if ($USUARIO->getTipoUsuarioEnObjeto()=='Administrador'){
    $lista.="<tr>";
    $lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/empresa.php'><img src='presentacion/imagenes/hospital.png' width='100' height='100'><br>EMPRESA</a></th>";
    $lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/usuarios.php'><img src='presentacion/imagenes/users.png' width='100' height='100'><br>USUARIOS</a></th>";
    $lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/pacientes.php'><img src='presentacion/imagenes/species.png' width='100' height='100'><br>PACIENTES</a></th>";
    $lista.="</tr>";
    $lista.="<tr>";
    $lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/especie.php'><img src='presentacion/imagenes/species.png' width='100' height='100'><br>ESPECIES</a></th>";
    $lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/vacunas.php'><img src='presentacion/imagenes/vaccine.png' width='100' height='100'><br>VACUNAS</a></th>";
    $lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/tipoAlimentacion.php'><img src='presentacion/imagenes/habitat.png' width='100' height='100'><br>TIPO DE<br>ALIMENTACIÓN</a></th>";
    $lista.="</tr>";
    $lista.="<tr>";
    $lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/enfermedades.php'><img src='presentacion/imagenes/virus.png' width='100' height='100'><br>ENFERMEDADES</a></th>";
    $lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/medicamentos.php'><img src='presentacion/imagenes/medicamentos.png' width='100' height='100'><br>MEDICAMENTOS</a></th>";
    $lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/citas.php'><img src='presentacion/imagenes/calendar.png' width='100' height='100'><br>CITAS</a></th>";
    $lista.="</tr>";
    $lista.="<tr>";
    $lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/habitat.php'><img src='presentacion/imagenes/habitat.png' width='100' height='100'><br>HABITAT</a></th>";
    $lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/estadosReproductivos.php'><img src='presentacion/imagenes/habitat.png' width='100' height='100'><br>ESTADOS<br>REPRODUCTIVOS</a></th>";
    $lista.="<th><a href='index.php'><img src='presentacion/imagenes/exit.png' width='100' height='100'><br>SALIR</a></th>";
    $lista.="</tr>";
} else if ($USUARIO->getTipoUsuarioEnObjeto()=='Médico' || $USUARIO->getTipoUsuarioEnObjeto()=='Asociado'){
    "<h3></h3>";
    $lista.="<tr>";
    $lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/pacientes.php'><img src='presentacion/imagenes/species.png' width='200' height='200'><br>PACIENTES</a></th>";
    $lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/citas.php'><img src='presentacion/imagenes/calendar.png' width='200' height='200'><br>CITAS</a></th>";
    $lista.="</tr>";
} else if ($USUARIO->getTipoUsuarioEnObjeto()=='Cliente'){
    "<h3></h3>";
    $lista.="<tr>";
    $lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/pacientes.php&idUsuario={$USUARIO->getId()}'><img src='presentacion/imagenes/species.png' width='200' height='200'><br>MIS MASCOTAS</a></th>";
    //$lista.="<th><a href='principal.php?CONTENIDO=presentacion/configuracion/citas.php'><img src='presentacion/imagenes/calendar.png' width='200' height='200'><br>CITAS</a></th>";
    $lista.="</tr>";
} 
?>
<center>
    <table border="2">
        <tr>
            <?= $lista ?>
        </tr>
    </table>
</center>