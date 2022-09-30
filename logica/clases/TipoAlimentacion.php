<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of TipoAlimentacion
 *
 * @author adora
 */
class TipoAlimentacion {
    private $id;
    private $tipo;
    private $observaciones;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, tipo, observaciones from tipoAlimentacion where $campo=$valor";
                echo $cadenaSQL.'<p>';
                $campo=ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }  
            $this->id=$campo['id'];
            $this->tipo=$campo['tipo'];
            $this->observaciones=$campo['observaciones'];
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
    
    public function guardar() {
        $cadenaSQL="insert into tipoAlimentacion (tipo, observaciones) values ('$this->tipo', '$this->observaciones')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update tipoAlimentacion set tipo='$this->tipo', observaciones='$this->observaciones' where id=$this->id";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from tipoAlimentacion where id=$this->id";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from tipoAlimentacion $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= TipoAlimentacion::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $tipoAlimentacion= new TipoAlimentacion($resultado[$i], null);
            $lista[$i]=$tipoAlimentacion;
        }
        return $lista;
    }
    
    public static function getListaBuscar($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where nombre like '%$filtro%'";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from tipoAlimentacion $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaBuscarEnObjetos($filtro, $orden) {
        $resultado= Especies::getListaBuscar($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $tipoAlimentacions= new TipoAlimentacion($resultado[$i], null);
            $lista[$i]=$tipoAlimentacions;
        }
        return $lista;
    }
    
    public static function getListaEnOptions($predeterminado){
        $lista='<option value=-1>Seleccione una opción</option>';
        $resultado= TipoAlimentacion::getListaEnObjetos(null, 'tipo');
        for ($i = 0; $i < count($resultado); $i++) {
            $tipoAlimentacion=$resultado[$i];
            if ($predeterminado==$tipoAlimentacion->getTipo()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$tipoAlimentacion->getTipo()}' $auxiliar>{$tipoAlimentacion->getTipo()}</option>";
        }
        return $lista;
    }
}