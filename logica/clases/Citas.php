<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Citas
 *
 * @author adora
 */
class Citas {
    private $id;
    private $idPaciente;
    private $fecha;
    private $hora;
    private $lugar;
    private $estadoCita;
    private $tipoCita;
    
    public function __construct($campo, $valor) {
        if ($campo != null){ //Si el valor enviado(campo) es diferente de null, entra aquí
            if (!is_array($campo)){ //Si el valor enviado (campo) es diferente a un arreglo, entra aquí
                $cadenaSQL="select id, idPaciente, tipoCita, fecha, hora, lugar, estadoCita from citas where $campo=$valor";
                //echo $cadenaSQL;
                $campo=ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id=$campo['id'];
            $this->idPaciente=$campo['idPaciente'];
            $this->tipoCita=$campo['tipoCita'];
            $this->fecha=$campo['fecha'];
            $this->hora=$campo['hora'];
            $this->lugar=$campo['lugar'];
            $this->estadoCita=$campo['estadoCita'];
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getIdPaciente() {
        return $this->idPaciente;
    }
    
    public function getPaciente(){
        return new Pacientes('id', $this->idPaciente);
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHora() {
        return $this->hora;
    }

    public function getLugar() {
        return $this->lugar;
    }

    public function getEstadoCita() {
        return $this->estadoCita;
    }

    public function getTipoCita() {
        return $this->tipoCita;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdPaciente($idPaciente): void {
        $this->idPaciente = $idPaciente;
    }

    public function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    public function setHora($hora): void {
        $this->hora = $hora;
    }

    public function setLugar($lugar): void {
        $this->lugar = $lugar;
    }

    public function setEstadoCita($estadoCita): void {
        $this->estadoCita = $estadoCita;
    }

    public function setTipoCita($tipoCita): void {
        $this->tipoCita = $tipoCita;
    }
            
    public function guardar() {
        $cadenaSQL="insert into citas (idPaciente, fecha, hora, lugar, estadoCita, tipoCita) values ('$this->idPaciente', '$this->fecha', '$this->hora', '$this->lugar', '$this->estadoCita', '$this->tipoCita')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update citas set fecha='$this->fecha', hora='$this->hora', lugar='$this->lugar', estadoCita='$this->estadoCita', tipoCita='$this->tipoCita' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from citas where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from citas $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Citas::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $citas= new Citas($resultado[$i], null);
            $lista[$i]=$citas;
        }
        return $lista;
    }
    
    public static function getListaBuscar($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where tipoCita like '%$filtro%'";//Aqui puede haber un error
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from citas $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaBuscarEnObjetos($filtro, $orden) {
        $resultado= Citas::getListaBuscar($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $citas= new Citas($resultado[$i], null);
            $lista[$i]=$citas;
        }
        return $lista;
    }
    /*
    public static function getListaEnOptions ($preseleccionado){
        $lista='<option value=-1>Seleccione una opción</option>';
        $resultado= Citas::getListaEnObjetos(null, 'id');
        for ($i = 0; $i < count($resultado); $i++) {
            $cita=$resultado[$i];
            if ($preseleccionado==$cita->getId()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$cita->getId()}' $auxiliar>{$cita->getTipo()}</option>";
        }
    return $lista;
    }
        */
}
