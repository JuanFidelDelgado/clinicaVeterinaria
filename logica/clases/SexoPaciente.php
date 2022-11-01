<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of SexoPaciente
 *
 * @author adora
 */
class SexoPaciente {
    private $id;
    private $tipo;
    private $nombre;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                if ($valor=='') $valor='null';  
                $cadenaSQL="select id, tipo, nombre from sexoPaciente where $campo=$valor";
                //echo $cadenaSQL;
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];  
            }
            if (is_array($campo)) {
                $this->id=$campo['id'];
                $this->tipo=$campo['tipo'];
                $this->nombre=$campo['nombre'];
            }
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTipo() {
        return $this->tipo;
    }
    
    public function getNombre() {
        return $this->nombre;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTipo($tipo): void {
        $this->tipo = $tipo;
    }
    
    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function __toString() {
        if ($this->tipo==null) return '';
        else return $this->nombre;
    }

    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from sexoPaciente $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= SexoPaciente::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $sexoPaciente= new SexoPaciente($resultado[$i], null);
            $lista[$i]=$sexoPaciente;
        }
        return $lista;
    }
    
    public static function getListaEnOptions($predeterminado){
        $lista='';
        $resultado= SexoPaciente::getListaEnObjetos(null, 'nombre');
        for ($i = 0; $i < count($resultado); $i++) {
            $sexoPaciente=$resultado[$i];
            if ($predeterminado==$sexoPaciente->getTipo()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$sexoPaciente->getTipo()}' $auxiliar>{$sexoPaciente->getTipo()}</option>";
        }
        return $lista;
    }
    
}