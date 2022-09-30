<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<?php
require_once './logica/clasesGenericas/ConectorBD.php';
require_once './logica/clases/Usuario.php';
require_once './logica/clases/TipoUsuario.php';

session_start();
session_unset();
session_destroy();
$mensaje='';
if (isset($_REQUEST['mensaje'])) $mensaje=$_REQUEST['mensaje'];
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="presentacion/css/hojaDeEstilo.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"/>
        <title>CLÍNICA VETERINARIA ANIMAL CENTER</title>
    </head>
    <body>
        <div id="index" align="center">
            <h2>CLÍNICA VETERINARIA ANIMAL CENTER</h2>
            <h4>INICIO DE SESIÓN</h4>
            <p><font color='red' ><?= $mensaje ?></font></p>
            <form name="formulario" method="post" action="control/validar.php">
            <!--<form name="formulario" method="post" action="inicio.php">-->
            <table border="0">
                <tr><th>Usuario</th><th><input type="text" name="usuario" required/></th></tr>
                <tr><th>Contraseña</th><th><input type="password" name="clave" required/></th></tr>
            </table>
            <p></p>
            <input type="submit" value="Ingresar"/>
            </form>
            <br>
            <a href="presentacion/configuracion/usuariosFormulario.php">Registrarse</a>
            <br>
            <!--
            <a href="presentacion/configuracion/usuariosFormulario.php">Registrarse</a>
            <a href="presentacion/configuracion/usuariosFormulario.php">Cambiar clave</a>
            -->
        </div>
        <table align="center">
            <tr>
                <th><img src="presentacion/imagenes/portada/Clinica1.jpg" height="250"></th>
                <th><img src="presentacion/imagenes/portada/Clinica2.jpg" height="250"></th>
                <th><img src="presentacion/imagenes/portada/Clinica3.jpg" height="250"></th>
            </tr>
            <tr align="center"><td colspan="3">NUESTROS SERVICIOS DE APOYO</td></tr>
            <tr align="center"><td colspan="3">Consulta veterinaria presencial, servicio a domicilio, cirugías y hospitalización, laboratorio, radiología y ecografía.</td>            </tr>
            <tr>
                <th colspan="3"><img src="presentacion/imagenes/portada/cita-de-control.webp" height="250"></th>
            </tr>
        </table>
    </body>
</html>
