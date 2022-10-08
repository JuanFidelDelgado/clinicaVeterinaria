<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of HistoriaClinica
 *
 * @author adora
 */
class HistoriaClinica {
    private $id;
    private $fecha;
    private $idPaciente;
    private $fechaEsterilizacion;
    private $tipoAlimentacion;
    private $habitat;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, fecha, idPaciente, fechaEsterilizacion, tipoAlimentacion, habitat from historiaClinica where $campo=$valor";
                //echo $cadenaSQL.'<p>';
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];  
            }
            if (is_array($campo)) {
                $this->id=$campo['id'];
                $this->fecha=$campo['fecha'];
                $this->idPaciente=$campo['idPaciente'];
                $this->fechaEsterilizacion=$campo['fechaEsterilizacion'];
                $this->tipoAlimentacion=$campo['tipoAlimentacion'];
                $this->habitat=$campo['habitat'];
            }
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getIdPaciente() {
        return $this->idPaciente;
    }

    public function getFechaEsterilizacion() {
        return $this->fechaEsterilizacion;
    }

    public function getTipoAlimentacion() {
        return $this->tipoAlimentacion;
    }

    public function getHabitat() {
        return $this->habitat;
    }
        
    public function setId($id): void {
        $this->id = $id;
    }

    public function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    public function setIdPaciente($idPaciente): void {
        $this->idPaciente = $idPaciente;
    }

    public function setFechaEsterilizacion($fechaEsterilizacion): void {
        $this->fechaEsterilizacion = $fechaEsterilizacion;
    }

    public function setTipoAlimentacion($tipoAlimentacion): void {
        $this->tipoAlimentacion = $tipoAlimentacion;
    }

    public function setHabitat($habitat): void {
        $this->habitat = $habitat;
    }

    public function guardar() {
        $cadenaSQL="insert into historiaClinica (fecha, idPaciente, fechaEsterilizacion, tipoAlimentacion, habitat) values "
                . "('$this->fecha', '$this->idPaciente', '$this->fechaEsterilizacion', '$this->tipoAlimentacion', '$this->habitat')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update historiaClinica set fecha='$this->fecha', idPaciente='$this->idPaciente', fechaEsterilizacion='$this->fechaEsterilizacion', "
                . "tipoAlimentacion='$this->tipoAlimentacion', habitat='prueba' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from historiaClinica where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from historiaClinica $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= HistoriaClinica::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $historiaClinica= new HistoriaClinica($resultado[$i], null);
            $lista[$i]=$historiaClinica;
        }
        return $lista;
    }
}
    