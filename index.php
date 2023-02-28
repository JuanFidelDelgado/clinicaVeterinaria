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
            <h1>CLÍNICA VETERINARIA ANIMAL CENTER</h1>
            <h4>INICIO DE SESIÓN</h4>
            <p><font color='red' ><?= $mensaje ?></font></p>
            <form name="formulario" method="post" action="control/validar.php">
                <!--<form name="formulario" method="post" action="inicio.php">-->
                <table border="0">
                    <tr width="1000px" border="1px"><th width="auto">Usuario</th><th><input type="text" name="usuario" required/></th></tr>
                    <tr><th>Contraseña</th><th><input type="password" name="clave" required/></th></tr>
                </table>
                <p></p>
                <input type="submit" value="Ingresar"/>
            </form>
            <br>
            <a href="presentacion/configuracion/registroFormulario.php?accion=Adicionar">Registrarse</a>
            <br>
            <br>
            <!--
            <a href="presentacion/configuracion/usuariosFormulario.php">Registrarse</a>
            <a href="presentacion/configuracion/usuariosFormulario.php">Cambiar clave</a>
            -->
        </div>
        <center>
            <table>
                <tr>
                    <section class="imagenes">
                        <img src="presentacion/imagenes/portada/Clinica1.jpg" height="450"> 
                        <img src="presentacion/imagenes/portada/Clinica2.jpg" height="450">
                        <img src="presentacion/imagenes/portada/Clinica3.jpg" height="450">
                    </section>
                </tr>
                <tr>
                    <a href="presentacion/configuracion/registroFormulario.php?accion=Adicionar">
                    <img src="presentacion/imagenes/portada/cita-de-control.webp"></a>
                </tr>
            </table>
        </center>
        <div align="center">
            <h1>NUESTROS SERVICIOS DE APOYO</h1>
            <br>
            <h2>Consulta veterinaria presencial, servicio a domicilio, cirugías y hospitalización, laboratorio, radiología y ecografía.</h2>
        </div>
    <!--
        <center>
            <section class="imagenes1" align="center">
                <a href="presentacion/configuracion/registroFormulario.php?accion=Adicionar">
                <img src="presentacion/imagenes/portada/cita-de-control.webp">
                </a>
            </section>
        </center>
    -->
    </body>
</html>
