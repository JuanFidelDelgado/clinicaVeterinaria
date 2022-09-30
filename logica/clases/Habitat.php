<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Habitat
 *
 * @author adora
 */
class Habitat {
    private $id;
    private $tipo;
    private $observaciones;
    
    public function __construct($campo, $valor) {
         if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, tipo, observaciones from habitat where $campo=$valor";
                //echo $cadenaSQL.'<p>';
                $campo=ConectorBD::ejecutarQuery($cadenaSQL)[0];
            } 
            $this->id = $campo ['id'];
            $this->tipo = $campo ['tipo'];
            $this->observaciones = $campo ['observaciones'];
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getObservaciones() {
        return $this->observaciones;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTipo($tipo): void {
        $this->tipo = $tipo;
    }

    public function setObservaciones($observaciones): void {
        $this->observaciones = $observaciones;
    }

    public function __toString() {
        return $this->tipo;
    }

    public function guardar() {
        $cadenaSQL="insert into habitat (tipo, observaciones) values ('$this->tipo', '$this->observaciones')";
        //echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar($idAnterior) {
        $cadenaSQL="update habitat set tipo='$this->tipo', observaciones='$this->observaciones' where id='$idAnterior'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from habitat where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from habitat $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Habitat::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $habitat= new Habitat($resultado[$i], null);
            $lista[$i]=$habitat;
        }
        return $lista;
    }
    
    public static function getListaBuscar($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where tipo like '%$filtro%' or observaciones like '%$filtro%' ";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from habitat $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaBuscarEnObjetos($filtro, $orden) {
        $resultado= Habitat::getListaBuscar($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $habitat= new Habitat($resultado[$i], null);
            $lista[$i]=$habitat;
        }
        return $lista;
    }
    
    public static function getListaEnOptions($predeterminado){
        $lista='<option value=-1>Seleccione una opción</option>';
        $resultado= Habitat::getListaEnObjetos(null, 'tipo');
        for ($i = 0; $i < count($resultado); $i++) {
            $habitat=$resultado[$i];
            if ($predeterminado==$habitat->getTipo()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$habitat->getTipo()}' $auxiliar>{$habitat->getTipo()}</option>";
        }
        return $lista;
    }
}
