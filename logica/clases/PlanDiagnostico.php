<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of PlanDiagnostico
 *
 * @author adora
 */
class PlanDiagnostico {
    private $id;
    private $idConsulta;
    private $cuadroHematico;
    private $fechaCuadroHematico;
    private $parcialOrina;
    private $fechaParcialOrina;
    private $coprologico;
    private $fechaCoprologico;
    private $coproscopico;
    private $fechaCoproscopico;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, idConsulta, cuadroHematico, fechaCuadroHematico, parcialOrina, fechaParcialOrina, coprologico, fechaCoprologico, coproscopico, fechaCoproscopico from planDiagnostico where $campo=$valor";
                echo $cadenaSQL.'<p>';
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];
            }  
            $this->id=$campo['id'];
            $this->idConsulta=$campo['idConsulta'];
            $this->cuadroHematico=$campo['cuadroHematico'];
            $this->fechaCuadroHematico=$campo['fechaCuadroHematico'];
            $this->parcialOrina=$campo['parcialOrina'];
            $this->fechaParcialOrina=$campo['fechaParcialOrina'];
            $this->coprologico=$campo['coprologico'];
            $this->fechaCoprologico=$campo['fechaCoprologico'];
            $this->coproscopico=$campo['coproscopico'];
            $this->fechaCoproscopico=$campo['fechaCoproscopico'];
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

    public function getCuadroHematico() {
        return $this->cuadroHematico;
    }

    public function getFechaCuadroHematico() {
        return $this->fechaCuadroHematico;
    }

    public function getParcialOrina() {
        return $this->parcialOrina;
    }

    public function setId($id): void {
        $this->id = $id;
    }
    
    public function getCoproscopico() {
        return $this->coproscopico;
    }

    public function getFechaCoproscopico() {
        return $this->fechaCoproscopico;
    }

    public function setCoproscopico($coproscopico): void {
        $this->coproscopico = $coproscopico;
    }

    public function setFechaCoproscopico($fechaCoproscopico): void {
        $this->fechaCoproscopico = $fechaCoproscopico;
    }
    
    public function setIdConsulta($idConsulta): void {
        $this->idConsulta = $idConsulta;
    }

    public function setCuadroHematico($cuadroHematico): void {
        $this->cuadroHematico = $cuadroHematico;
    }

    public function setFechaCuadroHematico($fechaCuadroHematico): void {
        $this->fechaCuadroHematico = $fechaCuadroHematico;
    }

    public function setParcialOrina($parcialOrina): void {
        $this->parcialOrina = $parcialOrina;
    }
    
    public function getFechaParcialOrina() {
        return $this->fechaParcialOrina;
    }

    public function getCoprologico() {
        return $this->coprologico;
    }

    public function getFechaCoprologico() {
        return $this->fechaCoprologico;
    }

    public function setFechaParcialOrina($fechaParcialOrina): void {
        $this->fechaParcialOrina = $fechaParcialOrina;
    }

    public function setCoprologico($coprologico): void {
        $this->coprologico = $coprologico;
    }

    public function setFechaCoprologico($fechaCoprologico): void {
        $this->fechaCoprologico = $fechaCoprologico;
    }
        
    public function guardar() {
        $cadenaSQL="insert into planDiagnostico (idConsulta, cuadroHematico, fechaCuadroHematico, parcialOrina, fechaParcialOrina, coprologico, fechaCoprologico, coproscopico, fechaCoproscopico) values "
                . "('$this->idConsulta', '$this->cuadroHematico', '$this->fechaCuadroHematico', '$this->parcialOrina', '$this->fechaParcialOrina', '$this->coprologico', '$this->fechaCoprologico', '$this->coproscopico', '$this->fechaCoprologico')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update planDiagnostico set idConsulta='$this->idConsulta', cuadroHematico='$this->cuadroHematico', fechaCuadroHematico='$this->fechaCuadroHematico', "
                . "parcialOrina='$this->parcialOrina', fechaParcialOrina='$this->fechaParcialOrina', coprologico='$this->coprologico', fechaCoprologico='$this->fechaCoprologico' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from planDiagnostico where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select id, idConsulta, cuadroHematico, fechaCuadroHematico, parcialOrina, fechaParcialOrina, coprologico, fechaCoprologico from planDiagnostico $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= PlanDiagnostico::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $planDiagnostico= new PlanDiagnostico($resultado[$i], null);
            $lista[$i]=$planDiagnostico;
        }
        return $lista;
    }
}