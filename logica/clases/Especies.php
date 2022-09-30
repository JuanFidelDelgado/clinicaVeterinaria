<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Especies
 *
 * @author adora
 */
class Especies {
    private $id;
    private $nombre;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                if ($valor=='') $valor='null';  
                $cadenaSQL="select id, nombre from especie where $campo=$valor";
                //echo $cadenaSQL;
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];  
            }
            if (is_array($campo)) {
                $this->id=$campo['id'];
                $this->nombre=$campo['nombre'];
            }
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function __toString() {
        if ($this->nombre==null) return '';
        else return $this->nombre;
    }

    public function guardar() {
        $cadenaSQL="insert into especie (nombre) values ('$this->nombre')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update especie set nombre='$this->nombre' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from especie where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from especie $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Especies::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $especie= new Especies($resultado[$i], null);
            $lista[$i]=$especie;
        }
        return $lista;
    }
    
    public static function getListaBuscar($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where nombre like '%$filtro%'";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from especie $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaBuscarEnObjetos($filtro, $orden) {
        $resultado= Especies::getListaBuscar($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $especies= new Especies($resultado[$i], null);
            $lista[$i]=$especies;
        }
        return $lista;
    }
    
    public static function getListaEnOptions($predeterminado){
        $lista='<option value=-1>Seleccione una opción</option>';
        $resultado= Especies::getListaEnObjetos(null, 'nombre');
        for ($i = 0; $i < count($resultado); $i++) {
            $especies=$resultado[$i];
            if ($predeterminado==$especies->getId()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$especies->getId()}' $auxiliar>{$especies->getNombre()}</option>";
        }
        return $lista;
    }
}
