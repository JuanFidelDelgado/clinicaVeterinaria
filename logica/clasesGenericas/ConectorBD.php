<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

class ConectorBD {
    private $servidor;
    private $puerto;
    private $baseDatos;
    private $controlador;
    private $usuario;
    private $clave;
    
    private $conexion;
    
    public function __construct() {
        $ruta = dirname(__FILE__) . '/../../configuracion.ini'  ;
        if (!file_exists($ruta)){
            echo 'Error, no existe el archivo de configuración de la base de datos. Archivo: ´'.$ruta;
        } else {
            $parametros= parse_ini_file($ruta);
            if (!$parametros) {
                echo 'Error, no se pudo procesar el archivo de configuración. Archivo: '.$ruta;               
            }
            else {
                $this->servidor=$parametros['servidor'];
                $this->puerto=$parametros['puerto'];
                $this->baseDatos=$parametros['baseDatos'];
                $this->controlador=$parametros['controlador'];
                $this->usuario=$parametros['usuario'];
                $this->clave=$parametros['clave'];
            }
        }
    }

    public function conectar(){
        try {
            $this->conexion=new PDO("$this->controlador:host=$this->servidor;port=$this->puerto;dbname=$this->baseDatos", $this->usuario, $this->clave);
            //echo 'Conectado a la base de datos';
            return true;
        } catch (Exception $exc) {
            echo 'No se pudo conectar a la base de datos.' . $exc->getMessage();
            return false;
        }
    }
    
    public function desconectar(){
        $this->conexion=null;
    }
    
    public static function ejecutarQuery($cadenaSQL){
        $conectorBD= new ConectorBD();
        if ($conectorBD->conectar()) {
            $sentencia = $conectorBD->conexion->prepare($cadenaSQL);
            if (!$sentencia->execute()) {
                $consulta = false;
            } else {
                $consulta = $sentencia->fetchAll();
                $sentencia->closeCursor();
            }
        } else {
            echo 'No se pudo conectar a la base de datos.';
        }
        $conectorBD->desconectar();
        return $consulta;
    }
}