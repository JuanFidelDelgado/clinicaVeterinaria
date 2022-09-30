<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Enfermedades
 *
 * @author adora
 */
class Enfermedades {
    private $id;
    private $nombre;
    private $descripcion;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, nombre, descripcion from enfermedades where $campo=$valor";
                //echo $cadenaSQL;
                $campo=ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id=$campo['id'];
            $this->nombre=$campo['nombre'];
            $this->descripcion=$campo['descripcion'];
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function guardar(){
        $cadenaSQL= "insert into enfermedades (nombre, descripcion) values ('$this->nombre', '$this->descripcion')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update enfermedades set id='$this->id', nombre='$this->nombre', descripcion='$this->descripcion' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from enfermedades where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from enfermedades $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Enfermedades::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $enfermedades= new Enfermedades($resultado[$i], null);
            $lista[$i]=$enfermedades;
        }
        return $lista;
    }
    
    public static function getListaBuscar($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where nombre like '%$filtro%' or descripcion like '%$filtro%' ";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from enfermedades $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaBuscarEnObjetos($filtro, $orden) {
        $resultado= Enfermedades::getListaBuscar($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $enfermedades= new Enfermedades($resultado[$i], null);
            $lista[$i]=$enfermedades;
        }
        return $lista;
    }
    
}