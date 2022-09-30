<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Razas
 *
 * @author adora
 */
class Razas {
    private $id;
    private $nombre;
    private $idEspecie;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, nombre, idEspecie from raza where $campo=$valor";
                //echo $cadenaSQL.'<p>';
                $campo=ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }  
            $this->id=$campo['id'];
            $this->nombre=$campo['nombre'];
            $this->idEspecie=$campo['idEspecie'];
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getIdEspecie() {
        return $this->idEspecie;
    }
    
    public function getEspecie() {
        return new Especies('id', $this->idEspecie);
    }
    
    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }
    
    public function setIdEspecie($idEspecie): void {
        $this->idEspecie = $idEspecie;
    }

    public function __toString() {
        return $this->nombre;
    }

    public function guardar() {
        $cadenaSQL="insert into raza (nombre, idEspecie) values ('$this->nombre', '$this->idEspecie')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar($idAnterior) {
        $cadenaSQL="update raza set nombre='$this->nombre', idEspecie='$this->idEspecie' where id='$idAnterior'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from raza where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from raza $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Razas::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $raza= new Razas($resultado[$i], null);
            $lista[$i]=$raza;
        }
        return $lista;
    }
    
    public static function getListaBuscar($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where nombre like '%$filtro%'";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from raza $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaBuscarEnObjetos($filtro, $orden) {
        $resultado= Razas::getListaBuscar($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $raza= new Razas($resultado[$i], null);
            $lista[$i]=$raza;
        }
        return $lista;
    }
    
    public static function getListaEnOptions ($preseleccionado){
        $lista='<option value=-1>Seleccione una opción</option>';
        $resultado= Razas::getListaEnObjetos(null, 'nombre');
        for ($i = 0; $i < count($resultado); $i++) {
            $raza=$resultado[$i];
            if ($preseleccionado==$raza->getId()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$raza->getId()}' $auxiliar>{$raza->getNombre()}</option>";
        }
    return $lista;
    }
}