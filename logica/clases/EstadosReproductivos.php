<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of EstadosReproductivos
 *
 * @author adora
 */
class EstadosReproductivos {
    private $id;
    private $nombre;
    private $observaciones;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, nombre, observaciones from estadosReproductivos where $campo=$valor";
                //echo $cadenaSQL;
                $campo=ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id=$campo['id'];
            $this->nombre=$campo['nombre'];
            $this->observaciones=$campo['observaciones'];
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getObservaciones() {
        return $this->observaciones;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setObservaciones($observaciones): void {
        $this->observaciones = $observaciones;
    }

    public function guardar(){
        $cadenaSQL= "insert into estadosReproductivos (nombre, observaciones) values ('$this->nombre', '$this->observaciones')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update estadosReproductivos set id='$this->id', nombre='$this->nombre', observaciones='$this->observaciones' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from estadosReproductivos where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from estadosReproductivos $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= EstadosReproductivos::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $estadosReproductivos= new EstadosReproductivos($resultado[$i], null);
            $lista[$i]=$estadosReproductivos;
        }
        return $lista;
    }
    
    public static function getListaBuscar($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where nombre like '%$filtro%' or observaciones like '%$filtro%' ";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from estadosReproductivos $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaBuscarEnObjetos($filtro, $orden) {
        $resultado= EstadosReproductivos::getListaBuscar($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $estadosReproductivos= new EstadosReproductivos($resultado[$i], null);
            $lista[$i]=$estadosReproductivos;
        }
        return $lista;
    }   
}