<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Consulta
 *
 * @author adora
 */
class Consulta {
    private $id;
    private $idCita;
    private $idMedico;
    private $idPaciente;
    private $fecha;
    private $idHistoriaClinica;
 
    public function __construct($campo, $valor) {
            if ($campo != null){ //Si el valor enviado(campo) es diferente de null, entra aquí
            if (!is_array($campo)){ //Si el valor enviado (campo) es diferente a un arreglo, entra aquí
                $cadenaSQL="select id, idCita, idMedico, idPaciente, fecha, idHistoriaClinica from consulta where $campo=$valor";
                //echo $cadenaSQL.'<p>';
                $campo=ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }  
            $this->id=$campo['id'];
            $this->idCita=$campo['idCita'];
            $this->idMedico=$campo['idMedico'];
            $this->idPaciente=$campo['idPaciente'];
            $this->fecha=$campo['fecha'];
            $this->idHistoriaClinica=$campo['idHistoriaClinica'];
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getIdCita() {
        return $this->idCita;
    }
    
    public function getCita(){
        return new Citas('id', $this->idCita);
    }

    public function getIdMedico() {
        return $this->idMedico;
    }

    public function getIdPaciente() {
        return $this->idPaciente;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getIdHistoriaClinica() {
        return $this->idHistoriaClinica;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdCita($idCita): void {
        $this->idCita = $idCita;
    }

    public function setIdMedico($idMedico): void {
        $this->idMedico = $idMedico;
    }

    public function setIdPaciente($idPaciente): void {
        $this->idPaciente = $idPaciente;
    }

    public function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    public function setIdHistoriaClinica($idHistoriaClinica): void {
        $this->idHistoriaClinica = $idHistoriaClinica;
    }

    public function guardar(){
        $cadenaSQL= "insert into consulta (idCita, idMedico, idPaciente, fecha, idHistoriaClinica) "
                . "values ('$this->idCita', '$this->idMedico', '$this->idPaciente', '$this->fecha', "
                . "'$this->idHistoriaClinica')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update consulta set idCita='$this->idCita', idMedico='$this->idMedico', "
                . "idPaciente='$this->idPaciente', fecha='$this->fecha', idHistoriaClinica='$this->idHistoriaClinica' "
                . "where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from consulta where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from consulta $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Consulta::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $consulta= new Consulta($resultado[$i], null);
            $lista[$i]=$consulta;
        }
        return $lista;
    }
}
