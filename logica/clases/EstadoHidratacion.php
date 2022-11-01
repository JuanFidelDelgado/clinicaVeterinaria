<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of EstadoHidratacion
 *
 * @author adora
 */
class EstadoHidratacion {
    private $id;
    private $hidratacion;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                if ($valor=='') $valor='null';  
                $cadenaSQL="select id, hidratacion from estadoHidratacion where $campo=$valor";
                //echo $cadenaSQL;
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];  
            }
            if (is_array($campo)) {
                $this->id=$campo['id'];
                $this->hidratacion=$campo['hidratacion'];
            }
        }
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getHidratacion() {
        return $this->hidratacion;
    }

    public function setId($id): void {
        $this->id = $id;
    }
    
    public function setHidratacion($hidratacion): void {
        $this->hidratacion = $hidratacion;
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from estadoHidratacion $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= estadoHidratacion::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $estadoHidratacion= new EstadoHidratacion($resultado[$i], null);
            $lista[$i]=$estadoHidratacion;
        }
        return $lista;
    }
    
    public static function getListaEnOptions($predeterminado){
        $lista='';
        $resultado= estadoHidratacion::getListaEnObjetos(null, 'hidratacion');
        for ($i = 0; $i < count($resultado); $i++) {
            $estadoHidratacion=$resultado[$i];
            if ($predeterminado==$estadoHidratacion->getHidratacion()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$estadoHidratacion->getHidratacion()}' $auxiliar>{$estadoHidratacion->getHidratacion()}</option>";
        }
        return $lista;
    }
}