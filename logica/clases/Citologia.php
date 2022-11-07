<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Citologia
 *
 * @author adora
 */
class Citologia {
    private $id;
    private $idConsulta;
    private $resultado;
    private $observaciones;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, idConsulta, resultado, observaciones from citologia where $campo=$valor";
                //echo $cadenaSQL.'<p>';
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];
            }  
            $this->id=$campo['id'];
            $this->idConsulta=$campo['idConsulta'];
            $this->resultado=$campo['resultado'];
            $this->observaciones=$campo['observaciones'];
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getIdConsulta() {
        return $this->idConsulta;
    }
    
    public function getConsulta() {
        return new Consulta('id', $this->idConsulta);
    }

    public function getResultado() {
        return $this->resultado;
    }

    public function getObservaciones() {
        return $this->observaciones;
    }
    
    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdConsulta($idConsulta): void {
        $this->idConsulta = $idConsulta;
    }

    public function setResultado($resultado): void {
        $this->resultado = $resultado;
    }

    public function setObservaciones($observaciones): void {
        $this->observaciones = $observaciones;
    }

    public function guardar() {
        $cadenaSQL="insert into citologia (idConsulta, resultado, observaciones) values "
                . "('$this->idConsulta', '$this->resultado', '$this->observaciones')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update citologia set idConsulta='$this->idConsulta', resultado='$this->resultado', observaciones='$this->observaciones' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from citologia where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select id, idConsulta, resultado, observaciones from citologia $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Citologia::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $citologia= new Citologia($resultado[$i], null);
            $lista[$i]=$citologia;
        }
        return $lista;
    }
}