<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of EstadoCita
 *
 * @author adora
 */
class EstadoCita {
    private $id;
    private $estado;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                if ($valor=='') $valor='null';  
                $cadenaSQL="select id, estado from estadoCita where $campo=$valor";
                //echo $cadenaSQL;
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];  
            }
            if (is_array($campo)) {
                $this->id=$campo['id'];
                $this->estado=$campo['estado'];
            }
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }

    public function __toString() {
        if ($this->estado==null) return '';
        else return $this->estado;
    }

    public function guardar() {
        $cadenaSQL="insert into estadoCita (estado) values ('$this->estado')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update estadoCita set estado='$this->estado' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from estadoCita where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from estadoCita $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= EstadoCita::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $estadoCita= new EstadoCita($resultado[$i], null);
            $lista[$i]=$estadoCita;
        }
        return $lista;
    }
    
    public static function getListaBuscar($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where estado like '%$filtro%'";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from estadoCita $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaBuscarEnObjetos($filtro, $orden) {
        $resultado= EstadoCita::getListaBuscar($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $estadoCitas= new EstadoCita($resultado[$i], null);
            $lista[$i]=$estadoCitas;
        }
        return $lista;
    }
    
    public static function getListaEnOptions($predeterminado){
        $lista='<option value=-1>Seleccione una opción</option>';
        $resultado= EstadoCita::getListaEnObjetos(null, 'estado');
        for ($i = 0; $i < count($resultado); $i++) {
            $estadoCitas=$resultado[$i];
            if ($predeterminado==$estadoCitas->getEstado()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$estadoCitas->getEstado()}' $auxiliar>{$estadoCitas->getEstado()}</option>";
        }
        return $lista;
    }
}


















