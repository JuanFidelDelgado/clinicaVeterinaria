<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once '../../logica/clases/ListaProblemas.php';
require_once '../../logica/clasesGenericas/ConectorBD.php';

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

//$direccion='location: principal.php?CONTENIDO=presentacion/consulta/consulta.php';
$listaProblemas= new ListaProblemas(null, null);
switch ($_REQUEST['accion']){
    case 'Adicionar':
        $listaProblemas->setIdConsulta($_REQUEST['idConsulta']);
        $listaProblemas->setNombre($_REQUEST['nombre']);
        $listaProblemas->setDiagnosticoDiferencial($_REQUEST['diagnosticoDiferencial']);
        $listaProblemas->guardar();
        break;
    case 'Modificar':
        $listaProblemas->setId($_REQUEST['id']);
        $listaProblemas->setIdConsulta($_REQUEST['idConsulta']);
        $listaProblemas->setNombre($_REQUEST['nombre']);
        $listaProblemas->setDiagnosticoDiferencial($_REQUEST['diagnosticoDiferencial']);
        $listaProblemas->modificar();
        break;
    case 'Eliminar':
        $listaProblemas->setId($_REQUEST['id']);
        $listaProblemas->eliminar();
        break;
}
//header('location: principal.php?CONTENIDO=presentacion/consulta/consulta.php')
?>