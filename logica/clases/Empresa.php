<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of empresa
 *
 * @author adora
 */
class Empresa {
    private $nit;
    private $nombre;
    private $direccion;
    private $telefono;
    private $correoElectronico;
    private $paginaWeb;
    private $facebook;
    private $instagram;
    private $twitter;
    
    public function __construct($campo, $valor) {
            if ($campo != null){ //Si el valor enviado(campo) es diferente de null, entra aquí
            if (!is_array($campo)){ //Si el valor enviado (campo) es diferente a un arreglo, entra aquí
                $cadenaSQL="select nit, nombre, direccion, telefono, correoElectronico, paginaWeb, facebook, "
                        . "instagram, twitter from empresa where $campo=$valor";
                //echo $cadenaSQL.'<p>';
                $campo=ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }  
            $this->nit=$campo['nit'];
            $this->nombre=$campo['nombre'];
            $this->direccion=$campo['direccion'];
            $this->telefono=$campo['telefono'];
            $this->correoElectronico=$campo['correoElectronico'];
            $this->paginaWeb=$campo['paginaWeb'];
            $this->facebook=$campo['facebook'];
            $this->instagram=$campo['instagram'];
            $this->twitter=$campo['twitter'];
        }
    }
    
    public function getNit() {
        return $this->nit;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getCorreoElectronico() {
        return $this->correoElectronico;
    }

    public function getPaginaWeb() {
        return $this->paginaWeb;
    }

    public function getFacebook() {
        return $this->facebook;
    }

    public function getInstagram() {
        return $this->instagram;
    }

    public function getTwitter() {
        return $this->twitter;
    }

    public function setNit($nit): void {
        $this->nit = $nit;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setDireccion($direccion): void {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono): void {
        $this->telefono = $telefono;
    }

    public function setCorreoElectronico($correoElectronico): void {
        $this->correoElectronico = $correoElectronico;
    }

    public function setPaginaWeb($paginaWeb): void {
        $this->paginaWeb = $paginaWeb;
    }

    public function setFacebook($facebook): void {
        $this->facebook = $facebook;
    }

    public function setInstagram($instagram): void {
        $this->instagram = $instagram;
    }

    public function setTwitter($twitter): void {
        $this->twitter = $twitter;
    }
    
    public function __toString() {
        return $this->nombre;
    }
    
    public function guardar(){
        $cadenaSQL= "insert into empresa (nit, nombre, direccion, telefono, correoElectronico, paginaWeb, facebook, instagram, twitter) "
                . "values ('$this->nit', '$this->nombre', '$this->direccion', '$this->telefono', '$this->correoElectronico', "
                . "'$this->paginaWeb' ,'$this->facebook', '$this->instagram', '$this->twitter')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update empresa set nit='$this->nit', nombre='$this->nombre', direccion='$this->direccion', "
                . "telefono='$this->telefono', correoElectronico='$this->correoElectronico', paginaWeb='$this->paginaWeb', "
                . "facebook='$this->facebook', instagram='$this->instagram', twitter='$this->twitter' where nit='$this->nit'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from empresa where nit='$this->nit'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from empresa $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Empresa::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $empresa= new Empresa($resultado[$i], null);
            $lista[$i]=$empresa;
        }
        return $lista;
    }    
}