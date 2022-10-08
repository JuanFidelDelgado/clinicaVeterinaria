<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<?php

date_default_timezone_set("America/Bogota");
require_once './logica/clasesGenericas/ConectorBD.php';
require_once './logica/clases/Citas.php';
require_once './logica/clases/Consulta.php';
require_once './logica/clases/Empresa.php';
require_once './logica/clases/Enfermedades.php';
require_once './logica/clases/Especies.php';
require_once './logica/clases/EstadoCita.php';
require_once './logica/clases/EstadosReproductivos.php';
require_once './logica/clases/Habitat.php';
require_once './logica/clases/Medicamentos.php';
require_once './logica/clases/Pacientes.php';
require_once './logica/clases/Razas.php';
require_once './logica/clases/TipoAlimentacion.php';
require_once './logica/clases/TipoUsuario.php';
require_once './logica/clases/TipoIdentificacion.php';
require_once './logica/clases/Usuario.php';
require_once './logica/clases/Vacunas.php';
require_once './logica/clases/ExamenClinico.php';
require_once './logica/clases/HistoriaClinica.php';

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$USUARIO= unserialize($_SESSION['usuario']);
/*
$usuario= new Usuario('id', $USUARIO->getId());
echo $usuario->getNombres();
 * 
 */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>(<?= $USUARIO->getTipoUsuarioEnObjeto() ?>) CLINICA VETERINARIA ANIMAL CENTER - <?= $USUARIO ?> </title>
        <link rel="stylesheet" href="presentacion/css/hojaDeEstilo.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
        
    </head>
    <body>
        <div id='banner'></div> 
        <div id="contenido"><?=include $_REQUEST['CONTENIDO']?></div>
        <div class="container">
            <div class="card">
                <div class="header">
                    <h2 align="center">Menú</h2>
                </div>
                <div class="body">
                    <?= $USUARIO->getTipoUsuarioEnObjeto()->getMenu() ?>  
                </div>
            </div>
        </div>
    </body>
</html>