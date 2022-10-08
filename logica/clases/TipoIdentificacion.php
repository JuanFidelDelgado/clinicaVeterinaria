<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of TipoUsuario
 *
 * @author adora
 */
class TipoIdentificacion {
    private $id;
    private $tipo;
    private $nombre;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                if ($valor=='') $valor='null';  
                $cadenaSQL="select id, tipo, nombre from tipoIdentificacion where $campo=$valor";
                //echo $cadenaSQL;
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];  
            }
            if (is_array($campo)) {
                $this->id=$campo['id'];
                $this->tipo=$campo['tipo'];
                $this->nombre=$campo['nombre'];
            }
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTipo() {
        return $this->tipo;
    }
    
    public function getNombre() {
        return $this->nombre;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTipo($tipo): void {
        $this->tipo = $tipo;
    }
    
    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function __toString() {
        if ($this->tipo==null) return '';
        else return $this->nombre;
    }

    public function guardar() {
        $cadenaSQL="insert into tipoIdentificacion (tipo) values ('$this->tipo', '$this->nombre')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update tipoIdentificacion set tipo='$this->tipo', nombre='$this->nombre' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from tipoIdentificacion where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from tipoIdentificacion $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= TipoIdentificacion::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $tipoIdentificacion= new TipoIdentificacion($resultado[$i], null);
            $lista[$i]=$tipoIdentificacion;
        }
        return $lista;
    }
    
    /*public static function getListaBuscar($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where tipo like '%$filtro%'";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from tipoIdentificacion $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaBuscarEnObjetos($filtro, $orden) {
        $resultado= TipoIdentificacion::getListaBuscar($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $tipoIdentificacion= new TipoIdentificacion($resultado[$i], null);
            $lista[$i]=$tipoIdentificacion;
        }
        return $lista;
    }*/
    
    public static function getListaEnOptions($predeterminado){
        $lista='';
        $resultado= TipoIdentificacion::getListaEnObjetos(null, 'tipo');
        for ($i = 0; $i < count($resultado); $i++) {
            $tipoIdentificacion=$resultado[$i];
            if ($predeterminado==$tipoIdentificacion->getNombre()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$tipoIdentificacion->getNombre()}' $auxiliar>{$tipoIdentificacion->getTipo()}</option>";
        }
        return $lista;
    }
}
    //Este es el codigo original
    /*private $codigo;

    
    public function __construct($codigo) {
        $this->codigo = $codigo;
    }
    
    public function getTipoIdentificacion(){
        switch ($this->codigo){
            case 'CC': $nombreTipo="Cédula de ciudadanía";
                break;
            case 'CE': $nombreTipo="Cédula de extranjería";
                break;
            case 'TI': $nombreTipo="Tarjeta de identidad";
                break;
            case 'NIT': $nombreTipo="Número de identificación tributaria";
                break;
            default: $nombreTipo="Deconocido";
                break;
        }
        return $nombreTipo; 
    }
    
    public function __toString() {
        return $this->getTipoIdentificacion();        
    }
}*/