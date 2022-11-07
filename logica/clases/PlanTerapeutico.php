<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of PlanTerapeutico
 *
 * @author adora
 */
class PlanTerapeutico {
    private $id;
    private $idConsulta;
    private $tipo1;
    private $medicamento1;
    private $dosisTotal1;
    private $viaAdministracion1;
    private $frecuencia1;
    private $duracion1;
    private $tipo2;
    private $medicamento2;
    private $dosisTotal2;
    private $viaAdministracion2;
    private $frecuencia2;
    private $duracion2;
    private $tipo3;
    private $medicamento3;
    private $dosisTotal3;
    private $viaAdministracion3;
    private $frecuencia3;
    private $duracion3;
    private $tipo4;
    private $medicamento4;
    private $dosisTotal4;
    private $viaAdministracion4;
    private $frecuencia4;
    private $duracion4;
    private $tipo5;
    private $medicamento5;
    private $dosisTotal5;
    private $viaAdministracion5;
    private $frecuencia5;
    private $duracion5;
    
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)){
                $cadenaSQL="select id, idConsulta, tipo1, medicamento1, dosisTotal1, viaAdministracion1, frecuencia1, duracion1, "
                        . "tipo2, medicamento2, dosisTotal2, viaAdministracion2, frecuencia2, duracion2, "
                        . "tipo3, medicamento3, dosisTotal3, viaAdministracion3, frecuencia3, duracion3, "
                        . "tipo4, medicamento4, dosisTotal4, viaAdministracion4, frecuencia4, duracion4, "
                        . "tipo5, medicamento5, dosisTotal5, viaAdministracion5, frecuencia5, duracion5 "
                        . " from planTerapeutico where $campo=$valor";
                //echo $cadenaSQL.'<p>';
                $resultado=ConectorBD::ejecutarQuery($cadenaSQL);
                if (count($resultado)>0) $campo=$resultado[0];
            }  
            $this->id=$campo['id'];
            $this->idConsulta=$campo['idConsulta'];
            $this->tipo1=$campo['tipo1'];
            $this->medicamento1=$campo['medicamento1'];
            $this->dosisTotal1=$campo['dosisTotal1'];
            $this->viaAdministracion1=$campo['viaAdministracion1'];
            $this->frecuencia1=$campo['frecuencia1'];
            $this->duracion1=$campo['duracion1'];
            $this->tipo2=$campo['tipo2'];
            $this->medicamento2=$campo['medicamento2'];
            $this->dosisTotal2=$campo['dosisTotal2'];
            $this->viaAdministracion2=$campo['viaAdministracion2'];
            $this->frecuencia2=$campo['frecuencia2'];
            $this->duracion2=$campo['duracion2'];
            $this->tipo3=$campo['tipo3'];
            $this->medicamento3=$campo['medicamento3'];
            $this->dosisTotal3=$campo['dosisTotal3'];
            $this->viaAdministracion3=$campo['viaAdministracion3'];
            $this->frecuencia3=$campo['frecuencia3'];
            $this->duracion3=$campo['duracion3'];
            $this->tipo4=$campo['tipo4'];
            $this->medicamento4=$campo['medicamento4'];
            $this->dosisTotal4=$campo['dosisTotal4'];
            $this->viaAdministracion4=$campo['viaAdministracion4'];
            $this->frecuencia4=$campo['frecuencia4'];
            $this->duracion4=$campo['duracion4'];
            $this->tipo5=$campo['tipo5'];
            $this->medicamento5=$campo['medicamento5'];
            $this->dosisTotal5=$campo['dosisTotal5'];
            $this->viaAdministracion5=$campo['viaAdministracion5'];
            $this->frecuencia5=$campo['frecuencia5'];
            $this->duracion5=$campo['duracion5'];
        }
    }
    
    public function getConsulta() {
        return new Consulta('id', $this->idConsulta);
    }
    
    public function getId() {
        return $this->id;
    }

    public function getIdConsulta() {
        return $this->idConsulta;
    }

    public function getTipo1() {
        return $this->tipo1;
    }

    public function getMedicamento1() {
        return $this->medicamento1;
    }

    public function getDosisTotal1() {
        return $this->dosisTotal1;
    }

    public function getViaAdministracion1() {
        return $this->viaAdministracion1;
    }

    public function getFrecuencia1() {
        return $this->frecuencia1;
    }

    public function getDuracion1() {
        return $this->duracion1;
    }

    public function getTipo2() {
        return $this->tipo2;
    }

    public function getMedicamento2() {
        return $this->medicamento2;
    }

    public function getDosisTotal2() {
        return $this->dosisTotal2;
    }

    public function getViaAdministracion2() {
        return $this->viaAdministracion2;
    }

    public function getFrecuencia2() {
        return $this->frecuencia2;
    }

    public function getDuracion2() {
        return $this->duracion2;
    }

    public function getTipo3() {
        return $this->tipo3;
    }

    public function getMedicamento3() {
        return $this->medicamento3;
    }

    public function getDosisTotal3() {
        return $this->dosisTotal3;
    }

    public function getViaAdministracion3() {
        return $this->viaAdministracion3;
    }

    public function getFrecuencia3() {
        return $this->frecuencia3;
    }

    public function getDuracion3() {
        return $this->duracion3;
    }

    public function getTipo4() {
        return $this->tipo4;
    }

    public function getMedicamento4() {
        return $this->medicamento4;
    }

    public function getDosisTotal4() {
        return $this->dosisTotal4;
    }

    public function getViaAdministracion4() {
        return $this->viaAdministracion4;
    }

    public function getFrecuencia4() {
        return $this->frecuencia4;
    }

    public function getDuracion4() {
        return $this->duracion4;
    }

    public function getTipo5() {
        return $this->tipo5;
    }

    public function getMedicamento5() {
        return $this->medicamento5;
    }

    public function getDosisTotal5() {
        return $this->dosisTotal5;
    }

    public function getViaAdministracion5() {
        return $this->viaAdministracion5;
    }

    public function getFrecuencia5() {
        return $this->frecuencia5;
    }

    public function getDuracion5() {
        return $this->duracion5;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdConsulta($idConsulta): void {
        $this->idConsulta = $idConsulta;
    }

    public function setTipo1($tipo1): void {
        $this->tipo1 = $tipo1;
    }

    public function setMedicamento1($medicamento1): void {
        $this->medicamento1 = $medicamento1;
    }

    public function setDosisTotal1($dosisTotal1): void {
        $this->dosisTotal1 = $dosisTotal1;
    }

    public function setViaAdministracion1($viaAdministracion1): void {
        $this->viaAdministracion1 = $viaAdministracion1;
    }

    public function setFrecuencia1($frecuencia1): void {
        $this->frecuencia1 = $frecuencia1;
    }

    public function setDuracion1($duracion1): void {
        $this->duracion1 = $duracion1;
    }

    public function setTipo2($tipo2): void {
        $this->tipo2 = $tipo2;
    }

    public function setMedicamento2($medicamento2): void {
        $this->medicamento2 = $medicamento2;
    }

    public function setDosisTotal2($dosisTotal2): void {
        $this->dosisTotal2 = $dosisTotal2;
    }

    public function setViaAdministracion2($viaAdministracion2): void {
        $this->viaAdministracion2 = $viaAdministracion2;
    }

    public function setFrecuencia2($frecuencia2): void {
        $this->frecuencia2 = $frecuencia2;
    }

    public function setDuracion2($duracion2): void {
        $this->duracion2 = $duracion2;
    }

    public function setTipo3($tipo3): void {
        $this->tipo3 = $tipo3;
    }

    public function setMedicamento3($medicamento3): void {
        $this->medicamento3 = $medicamento3;
    }

    public function setDosisTotal3($dosisTotal3): void {
        $this->dosisTotal3 = $dosisTotal3;
    }

    public function setViaAdministracion3($viaAdministracion3): void {
        $this->viaAdministracion3 = $viaAdministracion3;
    }

    public function setFrecuencia3($frecuencia3): void {
        $this->frecuencia3 = $frecuencia3;
    }

    public function setDuracion3($duracion3): void {
        $this->duracion3 = $duracion3;
    }

    public function setTipo4($tipo4): void {
        $this->tipo4 = $tipo4;
    }

    public function setMedicamento4($medicamento4): void {
        $this->medicamento4 = $medicamento4;
    }

    public function setDosisTotal4($dosisTotal4): void {
        $this->dosisTotal4 = $dosisTotal4;
    }

    public function setViaAdministracion4($viaAdministracion4): void {
        $this->viaAdministracion4 = $viaAdministracion4;
    }

    public function setFrecuencia4($frecuencia4): void {
        $this->frecuencia4 = $frecuencia4;
    }

    public function setDuracion4($duracion4): void {
        $this->duracion4 = $duracion4;
    }

    public function setTipo5($tipo5): void {
        $this->tipo5 = $tipo5;
    }

    public function setMedicamento5($medicamento5): void {
        $this->medicamento5 = $medicamento5;
    }

    public function setDosisTotal5($dosisTotal5): void {
        $this->dosisTotal5 = $dosisTotal5;
    }

    public function setViaAdministracion5($viaAdministracion5): void {
        $this->viaAdministracion5 = $viaAdministracion5;
    }

    public function setFrecuencia5($frecuencia5): void {
        $this->frecuencia5 = $frecuencia5;
    }

    public function setDuracion5($duracion5): void {
        $this->duracion5 = $duracion5;
    }
        
    public function guardar() {
        $cadenaSQL="insert into planTerapeutico (idConsulta, tipo1, medicamento1, dosisTotal1, viaAdministracion1, frecuencia1, duracion1, "
                . "tipo2, medicamento2, dosisTotal2, viaAdministracion2, frecuencia2, duracion2, "
                . "tipo3, medicamento3, dosisTotal3, viaAdministracion3, frecuencia3, duracion3, "
                . "tipo4, medicamento4, dosisTotal4, viaAdministracion4, frecuencia4, duracion4, "
                . "tipo5, medicamento5, dosisTotal5, viaAdministracion5, frecuencia5, duracion5) values "
                . "('$this->idConsulta', '$this->tipo1', '$this->medicamento1', '$this->dosisTotal1', '$this->viaAdministracion1', '$this->frecuencia1', '$this->duracion1', "
                . "'$this->tipo2', '$this->medicamento2', '$this->dosisTotal2', '$this->viaAdministracion2', '$this->frecuencia2', '$this->duracion2', "
                . "'$this->tipo3', '$this->medicamento3', '$this->dosisTotal3', '$this->viaAdministracion3', '$this->frecuencia3', '$this->duracion3', "
                . "'$this->tipo4', '$this->medicamento4', '$this->dosisTotal4', '$this->viaAdministracion4', '$this->frecuencia4', '$this->duracion4', "
                . "'$this->tipo5', '$this->medicamento5', '$this->dosisTotal5', '$this->viaAdministracion5', '$this->frecuencia5', '$this->duracion5')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update planTerapeutico set idConsulta='$this->idConsulta', tipo1='$this->tipo1', medicamento1='$this->medicamento1', dosisTotal1='$this->dosisTotal1', viaAdministracion1='$this->viaAdministracion1', frecuencia1='$this->frecuencia1', duracion1='$this->duracion1', "
                . "tipo2='$this->tipo2', medicamento2='$this->medicamento2', dosisTotal2='$this->dosisTotal2', viaAdministracion2='$this->viaAdministracion2', frecuencia2='$this->frecuencia2', duracion2='$this->duracion2', "
                . "tipo3='$this->tipo3', medicamento3='$this->medicamento3', dosisTotal3='$this->dosisTotal3', viaAdministracion3='$this->viaAdministracion3', frecuencia3='$this->frecuencia3', duracion3='$this->duracion3', "
                . "tipo4='$this->tipo4', medicamento4='$this->medicamento4', dosisTotal4='$this->dosisTotal4', viaAdministracion4='$this->viaAdministracion4', frecuencia4='$this->frecuencia4', duracion4='$this->duracion4', "
                . "tipo5='$this->tipo5', medicamento5='$this->medicamento5', dosisTotal5='$this->dosisTotal5', viaAdministracion5='$this->viaAdministracion5', frecuencia5='$this->frecuencia5', duracion5='$this->duracion5' "
                . "where id='$this->id'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from planTerapeutico where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden){
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';else $orden=" order by $orden";
        $cadenaSQL="select id, idConsulta, tipo1, medicamento1, dosisTotal1, viaAdministracion1, frecuencia1, duracion1 from planTerapeutico $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= PlanTerapeutico::getLista($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($resultado); $i++) {
            $planTerapeutico= new PlanTerapeutico($resultado[$i], null);
            $lista[$i]=$planTerapeutico;
        }
        return $lista;
    }
}