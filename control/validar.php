<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once "../logica/clasesGenericas/ConectorBD.php";
require_once "../logica/clases/Usuario.php";

$usuario=$_REQUEST['usuario'];
$clave=$_REQUEST['clave'];
$usuario= Usuario::validar($usuario, $clave);
if ($usuario==null) header('location:../index.php?mensaje=Usuario o contraseña no válidos');
else {
    session_start();
    $_SESSION['usuario']= serialize($usuario);
    header('location:../principal.php?CONTENIDO=inicio.php');
}
?>

