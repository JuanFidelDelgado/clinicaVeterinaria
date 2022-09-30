<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Medicamentos
 *
 * @author adora
 */
class Medicamentos {
    private $id;
    private $principioActivo;
    private $presentacion;
    private $concentracion;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, principioActivo, presentacion, concentracion from medicamentos where $campo=$valor";
                //echo $cadenaSQL;
                $campo=ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id=$campo['id'];
            $this->principioActivo=$campo['principioActivo'];
            $this->presentacion = $campo['presentacion'];
            $this->concentracion = $campo['concentracion'];
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getPrincipioActivo() {
        return $this->principioActivo;
    }

    public function getPresentacion() {
        return $this->presentacion;
    }

    public function getConcentracion() {
        return $this->concentracion;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setPrincipioActivo($principioActivo): void {
        $this->principioActivo = $principioActivo;
    }

    public function setPresentacion($presentacion): void {
        $this->presentacion = $presentacion;
    }

    public function setConcentracion($concentracion): void {
        $this->concentracion = $concentracion;
    }
    
    public function guardar(){
        $cadenaSQL= "insert into medicamentos (principioActivo, presentacion, concentracion) values ('$this->principioActivo', '$this->presentacion', '$this->concentracion')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update medicamentos set principioActivo='$this->principioActivo', presentacion='$this->presentacion', concentracion='$this->concentracion' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from medicamentos where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from medicamentos $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Medicamentos::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $medicamentos= new Medicamentos($resultado[$i], null);
            $lista[$i]=$medicamentos;
        }
        return $lista;
    }
    
    public static function getListaBuscar($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where principioActivo like '%$filtro%' or presentacion like '%$filtro%' or concentracion like '%$filtro%'";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from medicamentos $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaBuscarEnObjetos($filtro, $orden) {
        $resultado= Medicamentos::getListaBuscar($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $medicamentos= new Medicamentos($resultado[$i], null);
            $lista[$i]=$medicamentos;
        }
        return $lista;
    }   
}