<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Desparasitacion
 *
 * @author adora
 */
class Desparasitacion {
    private $id;
    private $idConsulta;
    private $estadoDesparasitacion;
    private $fechaDesparasitacion;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, idConsulta, estadoDesparasitacion, fechaDesparasitacion from desparasitacion where $campo=$valor";
                //echo $cadenaSQL.'<p>';
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];
            }  
            $this->id=$campo['id'];
            $this->idConsulta=$campo['idConsulta'];
            $this->estadoDesparasitacion=$campo['estadoDesparasitacion'];
            $this->fechaDesparasitacion=$campo['fechaDesparasitacion'];
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

    public function getEstadoDesparasitacion() {
        return $this->estadoDesparasitacion;
    }

    public function getFechaDesparasitacion() {
        return $this->fechaDesparasitacion;
    }
    
    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdConsulta($idConsulta): void {
        $this->idConsulta = $idConsulta;
    }

    public function setEstadoDesparasitacion($estadoDesparasitacion): void {
        $this->estadoDesparasitacion = $estadoDesparasitacion;
    }

    public function setFechaDesparasitacion($fechaDesparasitacion): void {
        $this->fechaDesparasitacion = $fechaDesparasitacion;
    }
    
    public function guardar() {
        $cadenaSQL="insert into desparasitacion (idConsulta, estadoDesparasitacion, fechaDesparasitacion) values "
                . "('$this->idConsulta', '$this->estadoDesparasitacion', '$this->fechaDesparasitacion')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update desparasitacion set idConsulta='$this->idConsulta', estadoDesparasitacion='$this->estadoDesparasitacion', fechaDesparasitacion='$this->fechaDesparasitacion', "
                . "estadoDesparasitacion='$this->estadoDesparasitacion' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from desparasitacion where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select id, idConsulta, estadoDesparasitacion, fechaDesparasitacion from desparasitacion $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Desparasitacion::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $desparasitacion= new Desparasitacion($resultado[$i], null);
            $lista[$i]=$desparasitacion;
        }
        return $lista;
    }
}

