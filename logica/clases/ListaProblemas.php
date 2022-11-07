<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of ListaProblemas
 *
 * @author adora
 */
class ListaProblemas {
    private $id;
    private $idConsulta;
    private $nombre;
    private $diagnosticoDiferencial;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, idConsulta, nombre, diagnosticoDiferencial from listaProblemas where $campo=$valor";
                //echo $cadenaSQL.'<p>';
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];
            }  
            $this->id=$campo['id'];
            $this->idConsulta=$campo['idConsulta'];
            $this->nombre=$campo['nombre'];
            $this->diagnosticoDiferencial=$campo['diagnosticoDiferencial'];
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

    public function getNombre() {
        return $this->nombre;
    }

    public function getDiagnosticoDiferencial() {
        return $this->diagnosticoDiferencial;
    }
    
    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdConsulta($idConsulta): void {
        $this->idConsulta = $idConsulta;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setDiagnosticoDiferencial($diagnosticoDiferencial): void {
        $this->diagnosticoDiferencial = $diagnosticoDiferencial;
    }

    public function guardar() {
        $cadenaSQL="insert into listaProblemas (idConsulta, nombre, diagnosticoDiferencial) values "
                . "('$this->idConsulta', '$this->nombre', '$this->diagnosticoDiferencial')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update listaProblemas set idConsulta='$this->idConsulta', nombre='$this->nombre', diagnosticoDiferencial='$this->diagnosticoDiferencial' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from listaProblemas where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select id, idConsulta, nombre, diagnosticoDiferencial from listaProblemas $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= ListaProblemas::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $listaProblemas= new ListaProblemas($resultado[$i], null);
            $lista[$i]=$listaProblemas;
        }
        return $lista;
    }
}