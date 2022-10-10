<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of ConstantesFisiologicas
 *
 * @author adora
 */
class ConstantesFisiologicas {
    private $id;
    private $idConsulta;
    private $tlc;
    private $temperatura;
    private $fr;
    private $fc;
    private $pulso;
    private $peso;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, idConsulta, tlc, temperatura, fr, fc, pulso, peso from constantesFisiologicas where $campo=$valor";
                echo $cadenaSQL.'<p>';
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];
            }  
            $this->id=$campo['id'];
            $this->idConsulta=$campo['idConsulta'];
            $this->tlc=$campo['tlc'];
            $this->temperatura=$campo['temperatura'];
            $this->fr=$campo['fr'];
            $this->fc=$campo['fc'];
            $this->pulso=$campo['pulso'];
            $this->peso=$campo['peso'];
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

    public function getTlc() {
        return $this->tlc;
    }

    public function getTemperatura() {
        return $this->temperatura;
    }

    public function getFr() {
        return $this->fr;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdConsulta($idConsulta): void {
        $this->idConsulta = $idConsulta;
    }

    public function setTlc($tlc): void {
        $this->tlc = $tlc;
    }

    public function setTemperatura($temperatura): void {
        $this->temperatura = $temperatura;
    }

    public function setFr($fr): void {
        $this->fr = $fr;
    }
    
    public function getFc() {
        return $this->fc;
    }

    public function getPulso() {
        return $this->pulso;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function setFc($fc): void {
        $this->fc = $fc;
    }

    public function setPulso($pulso): void {
        $this->pulso = $pulso;
    }

    public function setPeso($peso): void {
        $this->peso = $peso;
    }
        
    public function guardar() {
        $cadenaSQL="insert into constantesFisiologicas (idConsulta, tlc, temperatura, fr, fc, pulso, peso) values "
                . "('$this->idConsulta', '$this->tlc', '$this->temperatura', '$this->fr', '$this->fc', '$this->pulso', '$this->peso')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update constantesFisiologicas set idConsulta='$this->idConsulta', tlc='$this->tlc', temperatura='$this->temperatura', "
                . "fr='$this->fr', fc='$this->fc', pulso='$this->pulso', peso='$this->peso' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from constantesFisiologicas where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select id, idConsulta, tlc, temperatura, fr, fc, pulso, peso from constantesFisiologicas $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= ConstantesFisiologicas::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $constantesFisiologicas= new ConstantesFisiologicas($resultado[$i], null);
            $lista[$i]=$constantesFisiologicas;
        }
        return $lista;
    }
}