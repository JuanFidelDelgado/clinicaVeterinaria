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
class TipoCita {
    private $id;
    private $tipo;
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                if ($valor=='') $valor='null';  
                $cadenaSQL="select id, tipo from tipoCita where $campo=$valor";
                //echo $cadenaSQL;
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];  
            }
            if (is_array($campo)) {
                $this->id=$campo['id'];
                $this->tipo=$campo['tipo'];
            }
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTipo($tipo): void {
        $this->tipo = $tipo;
    }

    public function __toString() {
        if ($this->tipo==null) return '';
        else return $this->tipo;
    }

    public function guardar() {
        $cadenaSQL="insert into tipoCita (tipo) values ('$this->tipo')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update tipoCita set tipo='$this->tipo' where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from tipoCita where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from tipoCita $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= TipoCita::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $tipoCita= new TipoCita($resultado[$i], null);
            $lista[$i]=$tipoCita;
        }
        return $lista;
    }
    
    public static function getListaBuscar($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where tipo like '%$filtro%'";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select * from tipoCita $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaBuscarEnObjetos($filtro, $orden) {
        $resultado= TipooCita::getListaBuscar($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $tipoCita= new TipoCita($resultado[$i], null);
            $lista[$i]=$tipooCita;
        }
        return $lista;
    }
    
    public static function getListaEnOptions($predeterminado){
        $lista='<option value=-1>Seleccione una opción</option>';
        $resultado= TipoCita::getListaEnObjetos(null, 'tipo');
        for ($i = 0; $i < count($resultado); $i++) {
            $tipoCita=$resultado[$i];
            if ($predeterminado==$tipoCita->getTipo()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$tipoCita->getTipo()}' $auxiliar>{$tipoCita->getTipo()}</option>";
        }
        return $lista;
    }
}
    //Este es el código original
    /*private $codigo;
    
    public function __construct($codigo) {
        $this->codigo = $codigo;
    }
    
    public function getTipoCita(){
        switch ($this->codigo){
            case 'G': $nombreTipo="Medicina General";
                break;
            case 'O': $nombreTipo="Odontología";
                break;
            case 'E': $nombreTipo="Especialista";
                break;
            default: $nombreTipo="Deconocido";
                break;
        }
        return $nombreTipo; 
    }
    
    public function __toString() {
        return $this->getTipoCita();        
    }
}*/