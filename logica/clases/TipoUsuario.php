<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of TipoUsuario
 *
 * @author adora
 */
class TipoUsuario {
    private $codigo;
   
    public function __construct($codigo) {
        $this->codigo = $codigo;
    }
    
    public function getTipoUsuario(){
        switch ($this->codigo){
            case 'A': $nombreUsuario="Administrador";
                break;
            case 'M': $nombreUsuario="Médico";
                break;
            case 'C': $nombreUsuario="Cliente";
                break;
            case 'S': $nombreUsuario="Asociado";
                break;
            default: $nombreUsuario="Deconocido";
                break;
        }
        return $nombreUsuario; 
    }
    
    public function __toString() {
        return $this->getTipoUsuario();        
    }

    public function getMenu(){
        $menu="<ul>";
        $menu.="<li><i class='fas fa-home icon'></i><a href='principal.php?CONTENIDO=inicio.php'>Inicio</a></li>";
        $menu.="<li><i class='fas fa-hospital-alt icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/usuarios.php'>Mis datos</a></li>";
        $menu.="<li><i class='fab fa-wpforms icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/cambiarClave.php'>Cambiar clave</a></li>";
        $menu.="<li><a href='index.php'>Salir</a></li>";         
        $menu.="</ul>";
        return $menu;
    } 
}
?>

