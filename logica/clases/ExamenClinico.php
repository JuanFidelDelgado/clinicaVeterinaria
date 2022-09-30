<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of ExamenClinico
 *
 * @author adora
 */
class ExamenClinico {
    private $id;
    private $idConsulta;
    private $actitud;
    private $condicionCorporal;
    private $estadoHidratacion;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, idConsulta, actitud, condicionCorporal, estadoHidratacion from examenClinico where $campo=$valor";
                echo $cadenaSQL.'<p>';
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];
            }  
            $this->id=$campo['id'];
            $this->idConsulta=$campo['idConsulta'];
            $this->actitud=$campo['actitud'];
            $this->condicionCorporal=$campo['condicionCorporal'];
            $this->estadoHidratacion=$campo['estadoHidratacion'];
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

    public function getActitud() {
        return $this->actitud;
    }

    public function getCondicionCorporal() {
        return $this->condicionCorporal;
    }

    public function getEstadoHidratacion() {
        return $this->estadoHidratacion;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdConsulta($idConsulta): void {
        $this->idConsulta = $idConsulta;
    }

    public function setActitud($actitud): void {
        $this->actitud = $actitud;
    }

    public function setCondicionCorporal($condicionCorporal): void {
        $this->condicionCorporal = $condicionCorporal;
    }

    public function setEstadoHidratacion($estadoHidratacion): void {
        $this->estadoHidratacion = $estadoHidratacion;
    }
    
    public function guardar() {
        $cadenaSQL="insert into examenClinico (idConsulta, actitud, condicionCorporal, estadoHidratacion) values "
                . "('$this->idConsulta', '$this->actitud', '$this->condicionCorporal', '$this->estadoHidratacion')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update examenClinico set idConsulta='$this->idConsulta', actitud='$this->actitud', condicionCorporal='$this->condicionCorporal', "
                . "estadoHidratacion='$this->estadoHidratacion' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from examenClinico where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select id, idConsulta, actitud, condicionCorporal, estadoHidratacion from examenClinico $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Pacientes::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $examenClinico= new ExamenClinico($resultado[$i], null);
            $lista[$i]=$examenClinico;
        }
        return $lista;
    }
}