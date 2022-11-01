<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of CondicionCorporal
 *
 * @author adora
 */
class CondicionCorporal {
    private $id;
    private $condicion;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                if ($valor=='') $valor='null';  
                $cadenaSQL="select id, condicion from condicionCorporal where $campo=$valor";
                //echo $cadenaSQL;
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];  
            }
            if (is_array($campo)) {
                $this->id=$campo['id'];
                $this->condicion=$campo['condicion'];
            }
        }
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getCondicion() {
        return $this->condicion;
    }

    public function setId($id): void {
        $this->id = $id;
    }
    
    public function setCondicion($condicion): void {
        $this->condicion = $condicion;
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from condicionCorporal $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= condicionCorporal::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $condicionCorporal= new CondicionCorporal($resultado[$i], null);
            $lista[$i]=$condicionCorporal;
        }
        return $lista;
    }
    
    public static function getListaEnOptions($predeterminado){
        $lista='';
        $resultado= condicionCorporal::getListaEnObjetos(null, 'condicion');
        for ($i = 0; $i < count($resultado); $i++) {
            $condicionCorporal=$resultado[$i];
            if ($predeterminado==$condicionCorporal->getCondicion()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$condicionCorporal->getCondicion()}' $auxiliar>{$condicionCorporal->getCondicion()}</option>";
        }
        return $lista;
    }
}