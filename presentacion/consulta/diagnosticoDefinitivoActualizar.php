<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once '../../logica/clases/DiagnosticoDefinitivo.php';
require_once '../../logica/clasesGenericas/ConectorBD.php';

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

//$direccion='location: principal.php?CONTENIDO=presentacion/consulta/consulta.php';
$diagnosticoDefinitivo= new DiagnosticoDefinitivo(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $diagnosticoDefinitivo->setIdConsulta($_REQUEST['idConsulta']);
        $diagnosticoDefinitivo->setDiagnosticoDefinitivo($_REQUEST['diagnosticoDefinitivo']);
        $diagnosticoDefinitivo->setObservaciones($_REQUEST['observaciones']);
        $diagnosticoDefinitivo->guardar();
        break;
    case 'Modificar':
        $diagnosticoDefinitivo->setId($_REQUEST['id']);
        $diagnosticoDefinitivo->setIdConsulta($_REQUEST['idConsulta']);
        $diagnosticoDefinitivo->setDiagnosticoDefinitivo($_REQUEST['diagnosticoDefinitivo']);
        $diagnosticoDefinitivo->setObservaciones($_REQUEST['observaciones']);
        $diagnosticoDefinitivo->modificar();
        break;
    case 'Eliminar':
        $diagnosticoDefinitivo->setId($_REQUEST['id']);
        $diagnosticoDefinitivo->eliminar();
        break;
}
//header('location: principal.php?CONTENIDO=presentacion/consulta/consulta.php')
?>