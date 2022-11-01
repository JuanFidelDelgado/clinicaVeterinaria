<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of LugarCita
 *
 * @author adora
 */
class LugarCita {
    private $id;
    private $lugar;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                if ($valor=='') $valor='null';  
                $cadenaSQL="select id, lugar from lugarCita where $campo=$valor";
                //echo $cadenaSQL;
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];  
            }
            if (is_array($campo)) {
                $this->id=$campo['id'];
                $this->lugar=$campo['lugar'];
            }
        }
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getLugar() {
        return $this->lugar;
    }

    public function setId($id): void {
        $this->id = $id;
    }
    
    public function setLugar($lugar): void {
        $this->lugar = $lugar;
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from lugarCita $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= LugarCita::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $lugarCita= new LugarCita($resultado[$i], null);
            $lista[$i]=$lugarCita;
        }
        return $lista;
    }
    
    public static function getListaEnOptions($predeterminado){
        $lista='';
        $resultado= LugarCita::getListaEnObjetos(null, 'lugar');
        for ($i = 0; $i < count($resultado); $i++) {
            $lugarCita=$resultado[$i];
            if ($predeterminado==$lugarCita->getLugar()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$lugarCita->getLugar()}' $auxiliar>{$lugarCita->getLugar()}</option>";
        }
        return $lista;
    }
}