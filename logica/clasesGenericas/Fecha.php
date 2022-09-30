<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Fecha
 *
 * @author adora
 */
class Fecha {
    
    public static function calcularDiferenciaFechasSegundos($fecha1, $fecha2){
        $inicio=strtotime($fecha1);//strtotime devuelve el tiempo en segundos desde el 01/01/1970 hasta la fecha indicada
        $fin=strtotime($fecha2);
        $diferencia=$fin-$inicio;
        return $diferencia;        
    }
    
    
    public static function calcularDiferenciaFechas($fecha1, $fecha2){
        $fechaInicio=new DateTime($fecha1);
        $fechaFin=new DateTime($fecha2);
        $diferencia=$fechaFin->diff($fechaInicio);//diff ejecuta la resta entre dos objetos
        return $diferencia->days;
    }
}
