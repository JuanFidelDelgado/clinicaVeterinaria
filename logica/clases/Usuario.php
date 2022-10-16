<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Usuario
 *
 * @author adora
 */
class Usuario {
    private $id;
    private $tipoUsuario;
    private $identificacion;
    private $tipoIdentificacion;
    private $nombres;
    private $apellidos;
    private $telefono;
    private $direccion;
    private $tarjetaProfesional;
    private $correoElectronico;
    private $clave;
    
    public function __construct($campo, $valor) {
            if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, tipoUsuario, identificacion, tipoIdentificacion, nombres, apellidos, telefono, direccion, tarjetaProfesional, "
                        . "correoElectronico, clave from usuario where $campo=$valor";
                //echo $cadenaSQL.'<p>';
                $campo=ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }  
            $this->id=$campo['id'];
            $this->tipoUsuario=$campo['tipoUsuario'];
            $this->identificacion=$campo['identificacion'];
            $this->tipoIdentificacion=$campo['tipoIdentificacion'];
            $this->nombres=$campo['nombres'];
            $this->apellidos=$campo['apellidos'];
            $this->telefono=$campo['telefono'];
            $this->direccion=$campo['direccion'];
            $this->tarjetaProfesional=$campo['tarjetaProfesional'];
            $this->correoElectronico=$campo['correoElectronico'];
            $this->clave=$campo['clave'];
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTipoUsuario() {
        return $this->tipoUsuario;
    }
    
    public function getTipoUsuarioEnObjeto(){
        return new TipoUsuario($this->tipoUsuario);
    }

    public function getIdentificacion() {
        return $this->identificacion;
    }

    public function getTipoIdentificacion() {
        return $this->tipoIdentificacion;
    }
    
    public function getTipoIdentificacionEnObjeto(){
        return new TipoIdentificacion('id', $this->tipoIdentificacion);
    }
    
    public function getNombres() {
        return $this->nombres;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getTarjetaProfesional() {
        return $this->tarjetaProfesional;
    }

    public function getCorreoElectronico() {
        return $this->correoElectronico;
    }

    public function getClave() {
        return $this->clave;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTipoUsuario($tipoUsuario): void {
        $this->tipoUsuario = $tipoUsuario;
    }

    public function setIdentificacion($identificacion): void {
        $this->identificacion = $identificacion;
    }

    public function setTipoIdentificacion($tipoIdentificacion): void {
        $this->tipoIdentificacion = $tipoIdentificacion;
    }

    public function setNombres($nombres): void {
        $this->nombres = $nombres;
    }

    public function setApellidos($apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function setTelefono($telefono): void {
        $this->telefono = $telefono;
    }

    public function setDireccion($direccion): void {
        $this->direccion = $direccion;
    }

    public function setTarjetaProfesional($tarjetaProfesional): void {
        $this->tarjetaProfesional = $tarjetaProfesional;
    }

    public function setCorreoElectronico($correoElectronico): void {
        $this->correoElectronico = $correoElectronico;
    }

    public function setClave($clave): void {
        $this->clave = $clave;
    }

    public function __toString() {
        return $this->nombres . ' ' . $this->apellidos;
    }
    
    public function guardar() {
        $cadenaSQL="insert into usuario (tipoUsuario, identificacion, tipoIdentificacion, nombres, apellidos, telefono, direccion, tarjetaProfesional, "
                . "correoElectronico, clave) values ('$this->tipoUsuario', '$this->identificacion', '$this->tipoIdentificacion','$this->nombres', "
                . "'$this->apellidos','$this->telefono', '$this->direccion', '$this->tarjetaProfesional','$this->correoElectronico', md5('$this->clave'))";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        if (strlen($this->clave)<32) $this->clave=md5($this->clave);
        $cadenaSQL="update usuario set tipoUsuario='$this->tipoUsuario', identificacion='$this->identificacion', tipoIdentificacion='$this->tipoIdentificacion', "
                . "nombres='$this->nombres', apellidos='$this->apellidos', telefono='$this->telefono', direccion='$this->direccion', tarjetaProfesional='$this->tarjetaProfesional', "
                . "correoElectronico='$this->correoElectronico', clave='$this->clave' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function cambiarClave() {
        //if (strlen($this->clave)<32) $this->clave=md5($this->clave);
        $cadenaSQL="update usuario set clave=md5('$this->clave') where identificacion='$this->identificacion'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function errorCambiarClave() {
        //if (strlen($this->clave)<32) $this->clave=md5($this->clave);
        $cadenaSQL="Las claves no corresponden";
        echo $cadenaSQL;
        //ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from usuario where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from usuario $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Usuario::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $usuario= new Usuario($resultado[$i], null);
            $lista[$i]=$usuario;
        }
        return $lista;
    }
    
    public static function validar($usuario,$clave){
        $resultado= Usuario::getListaEnObjetos("identificacion='$usuario' and clave=md5('$clave')", null);
        $usuario=null;
        if (count($resultado)>0) $usuario=$resultado[0];
        return $usuario;
    }

    public static function getListaBuscar($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where identificacion like '%$filtro%' or nombres like '%$filtro%' or apellidos like '%$filtro%' or direccion like '%$filtro%' or correoElectronico like '%$filtro%' ";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from usuario $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaBuscarEnObjetos($filtro, $orden) {
        $resultado= Usuario::getListaBuscar($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $usuario= new Usuario($resultado[$i], null);
            $lista[$i]=$usuario;
        }
        return $lista;
    }
    
    public static function getListaEnOptions ($preseleccionado){
        $lista='<option value=-1>Seleccione una opción</option>';
        $resultado= Usuario::getListaEnObjetos(null, 'id');
        for ($i = 0; $i < count($resultado); $i++) {
            $usuario=$resultado[$i];
            if ($preseleccionado==$usuario->getId()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$usuario->getId()}' $auxiliar>{$usuario->getTipoIdentificacion()}</option>";
        }
    }
}
