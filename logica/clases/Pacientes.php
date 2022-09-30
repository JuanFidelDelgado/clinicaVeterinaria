<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Pacientes
 *
 * @author adora
 */
class Pacientes {
    private $id;
    private $idUsuario;
    private $foto;
    private $nombre;
    private $idEspecie;
    private $idRaza;
    private $fechaNacimiento;
    private $sexo;
    private $color;
    private $señasParticulares;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, idUsuario, foto, nombre, idEspecie, idRaza, fechaNacimiento, sexo, color, señasParticulares from paciente where $campo=$valor";
                //echo $cadenaSQL.'<p>';
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];
            }  
            $this->id=$campo['id'];
            $this->idUsuario=$campo['idUsuario'];
            $this->foto=$campo['foto'];
            $this->nombre=$campo['nombre'];
            $this->idEspecie=$campo['idEspecie'];
            $this->idRaza=$campo['idRaza'];
            $this->fechaNacimiento=$campo['fechaNacimiento'];
            $this->sexo=$campo['sexo'];
            $this->color=$campo['color'];
            $this->señasParticulares=$campo['señasParticulares'];
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }
    
    public function getUsuario(){
        return new Usuario('id', $this->idUsuario);
    }

    public function getFoto(){
        return $this->foto;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function getIdEspecie() {
        return $this->idEspecie;
    }
    
    public function getEspecie() {
        return new Especies('id', $this->idEspecie);
    }

    public function getIdRaza() {
        return $this->idRaza;
    }
    
    public function getRaza() {
        return new Razas('id', $this->idRaza);
    }

    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getColor() {
        return $this->color;
    }

    public function getSeñasParticulares() {
        return $this->señasParticulares;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdUsuario($idUsuario): void {
        $this->idUsuario = $idUsuario;
    }
    
    public function setFoto($foto): void {
        $this->foto = $foto;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setIdEspecie($idEspecie): void {
        $this->idEspecie = $idEspecie;
    }

    public function setIdRaza($idRaza): void {
        $this->idRaza = $idRaza;
    }

    public function setFechaNacimiento($fechaNacimiento): void {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function setSexo($sexo): void {
        $this->sexo = $sexo;
    }

    public function setColor($color): void {
        $this->color = $color;
    }

    public function setSeñasParticulares($señasParticulares): void {
        $this->señasParticulares = $señasParticulares;
    }

    public function __toString() {
        return $this->nombre;
    }
    
    public function guardar() {
        $cadenaSQL="insert into paciente (idUsuario, foto, nombre, idEspecie, idRaza, fechaNacimiento, sexo, color, señasParticulares) values "
                . "('$this->idUsuario', '$this->foto', '$this->nombre', '$this->idEspecie', '$this->idRaza', '$this->fechaNacimiento', '$this->sexo', "
                . "'$this->color', '$this->señasParticulares')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update paciente set idUsuario='$this->idUsuario', foto='$this->foto', nombre='$this->nombre', idEspecie='$this->idEspecie', idRaza='$this->idRaza', "
                . "fechaNacimiento='$this->fechaNacimiento', sexo='$this->sexo', color='$this->color', señasParticulares='$this->señasParticulares' "
                . "where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from paciente where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from paciente $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Pacientes::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $paciente= new Pacientes($resultado[$i], null);
            $lista[$i]=$paciente;
        }
        return $lista;
    }
    
    //El siguiente método calcula la edad en segundo y hay que realizar el cálculo en años dividiendo en 31557600
    public static function calcularEdadEnAños($fecha1, $fecha2, $hora){
        $inicio=strtotime($fecha1);
        $fin=strtotime($fecha2);
        $diferencia= ceil(($fin-$inicio)/$hora);
        if ($diferencia>0) return $diferencia." años";
        else return null;
    }
    
    public static function calcularEdad($fecha1, $fecha2){
        $fechaInicio=new DateTime($fecha1);
        $fechaFin=new DateTime($fecha2);
        $diferencia=$fechaFin->diff($fechaInicio);//diff ejecuta la resta entre dos objetos
        return floor($diferencia->y);
    }
}