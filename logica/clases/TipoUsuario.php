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
        /*switch ($this->codigo){
            case 'A': //Menu para el administrador
                $menu.="<li><i class='fas fa-hospital-alt icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/empresa.php'>Datos Empresa</a></li>";
                $menu.="<li><i class='fas fa-user-alt icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/usuarios.php'>Usuarios</a></li>";
                $menu.="<li><i class='fab fa-wpforms icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/especie.php'>Especies</a></li>";
                $menu.="<li><i class='fas fa-syringe icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/vacunas.php'>Vacunas</a></li>";
                $menu.="<li><i class='fab fa-wpforms icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/enfermedades.php'>Enfermedades</a></li>";
                $menu.="<li><i class='fab fa-wpforms icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/medicamentos.php'>Medicamentos</a></li>";
                $menu.="<li><i class='fab fa-wpforms icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/habitat.php'>Hábitat</a></li>";
                $menu.="<li><i class='fab fa-wpforms icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/estadosReproductivos.php'>Estados Reproductivos</a></li>";
                $menu.="<li><i class='fab fa-wpforms icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/tipoAlimentacion.php'>Tipo Alimentación</a></li>";
                break;
            case 'M'://Menú para el médico
                //$menu.="<li><i class='fab fa-wpforms icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/pacientes.php'>Pacientes</a></li>";
                //$menu.="<li><i class='fab fa-wpforms icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/citas.php'>Citas</a></li>";
                $menu.="<li><i class='fas fa-hospital-alt icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/usuarios.php'>Mis datos</a></li>";
                break;
            case 'C'://Menú para el cliente
                //$menu.="<li><i class='fas fa-hospital-alt icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/pacientes.php'>Mis mascotas</a></li>";
                //$menu.="<li><i class='fab fa-wpforms icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/citas.php'>Citas</a></li>";
                $menu.="<li><i class='fas fa-hospital-alt icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/usuarios.php'>Mis datos</a></li>";
                break;
            case 'S'://Menú para el asociado
                //$menu.="<li><i class='fas fa-hospital-alt icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/pacientes.php'>Mis mascotas</a></li>";
                //$menu.="<li><i class='fab fa-wpforms icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/citas.php'>Citas</a></li>";
                $menu.="<li><i class='fas fa-hospital-alt icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/usuarios.php'>Mis datos</a></li>";
                break;
        }*/
        $menu.="<li><i class='fas fa-hospital-alt icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/usuarios.php'>Mis datos</a></li>";
        $menu.="<li><i class='fab fa-wpforms icon'></i><a href='principal.php?CONTENIDO=presentacion/configuracion/cambiarClave.php'>Cambiar clave</a></li>";
        $menu.="<li><a href='index.php'>Salir</a></li>";         
        $menu.="</ul>";
        return $menu;
    } 
}
?>

