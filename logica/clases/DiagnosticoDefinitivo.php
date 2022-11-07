<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of DiagnosticoDefinitivo
 *
 * @author adora
 */
class DiagnosticoDefinitivo {
    private $id;
    private $idConsulta;
    private $diagnosticoDefinitivo;
    private $observaciones;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, idConsulta, diagnosticoDefinitivo, observaciones from diagnosticoDefinitivo where $campo=$valor";
                //echo $cadenaSQL.'<p>';
                $diagnosticoDefinitivo=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($diagnosticoDefinitivo)>0) $campo=$diagnosticoDefinitivo[0];
            }  
            $this->id=$campo['id'];
            $this->idConsulta=$campo['idConsulta'];
            $this->diagnosticoDefinitivo=$campo['diagnosticoDefinitivo'];
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

    public function getDiagnosticoDefinitivo() {
        return $this->diagnosticoDefinitivo;
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

    public function setDiagnosticoDefinitivo($diagnosticoDefinitivo): void {
        $this->diagnosticoDefinitivo = $diagnosticoDefinitivo;
    }

    public function setObservaciones($observaciones): void {
        $this->observaciones = $observaciones;
    }

    public function guardar() {
        $cadenaSQL="insert into diagnosticoDefinitivo (idConsulta, diagnosticoDefinitivo, observaciones) values "
                . "('$this->idConsulta', '$this->diagnosticoDefinitivo', '$this->observaciones')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update diagnosticoDefinitivo set idConsulta='$this->idConsulta', diagnosticoDefinitivo='$this->diagnosticoDefinitivo', observaciones='$this->observaciones' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from diagnosticoDefinitivo where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select id, idConsulta, diagnosticoDefinitivo, observaciones from diagnosticoDefinitivo $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $diagnosticoDefinitivo= DiagnosticoDefinitivo::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($diagnosticoDefinitivo); $i++) {
            $diagnosticoDefinitivo= new DiagnosticoDefinitivo($diagnosticoDefinitivo[$i], null);
            $lista[$i]=$diagnosticoDefinitivo;
        }
        return $lista;
    }
}