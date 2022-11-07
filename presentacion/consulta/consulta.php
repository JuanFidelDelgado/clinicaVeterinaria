<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad
$USUARIO= unserialize($_SESSION['usuario']);
$medico= new Usuario('id', $USUARIO->getId());

$historiaClinica= new HistoriaClinica('idPaciente', $_REQUEST['idPaciente']);
$paciente= new Pacientes('id', $_REQUEST['idPaciente']);
$usuario= new Usuario('id', $paciente->getIdUsuario());
$cita= new Citas('id', $_REQUEST['idCita']);
$consulta= new Consulta('id', $_REQUEST['idConsulta']);

$titulo='Adicionar';
//if (isset($_REQUEST['id'])) {
if ($consulta->getId()!=null) {
    //$titulo = 'Modificar';
    $examen = new ExamenClinico('idConsulta', $consulta->getId());
    $desparasitacion = new Desparasitacion('idConsulta', $consulta->getId());
    $constantesFisiologicas = new ConstantesFisiologicas('idConsulta', $consulta->getId());
    $planDiagnostico = new PlanDiagnostico('idConsulta', $consulta->getId());
    $listaProblemas = new ListaProblemas('idConsulta', $consulta->getId());
    $citologia = new Citologia('idConsulta', $consulta->getId());
    $planTerapeurico = new PlanTerapeutico('idConsulta', $consulta->getId());
    $diagnosticoDefinitivo = new DiagnosticoDefinitivo('idConsulta', $consulta->getId());
    
} else {
    $examen = new ExamenClinico(null, null);
    $desparasitacion = new Desparasitacion(null, null);
    $constantesFisiologicas = new ConstantesFisiologicas(null, null);
    $planDiagnostico = new PlanDiagnostico(null, null);
    $listaProblemas = new ListaProblemas(null, null);
    $citologia = new Citologia(null, null);
    $planTerapeurico = new PlanTerapeutico(null, null);
    $diagnosticoDefinitivo = new DiagnosticoDefinitivo(null, null);
}
?>

<h3 align="center">CONSULTA</h3>
<p></p>

<table border="1" align="center">
    <tr>        
        <th colspan="6">DATOS DEL PROFESIONAL</th>
    </tr>
    <tr>
         <th>Nombres</th><td><?= $medico->getNombres() ?></td><th>Apellidos</th><td><?= $medico->getApellidos() ?></td><th>N° Tarjeta Profesional</th><td><?= $medico->getTarjetaProfesional() ?></td>
    </tr>
</table>
<br>
<table border="1" align="center">
    <tr>
        <td colspan="2" rowspan="6"><img src="presentacion/pacientes/fotos/<?= $paciente->getFoto() ?>" width="100" height="100"></td>
        <th colspan="6">DATOS DEL PACIENTE</th>
    </tr>
    <tr>
        <th>Nombre</th><td><?= $paciente->getNombre() ?></td><th>Especie</th0><td><?= $paciente->getEspecie() ?></td><th>Raza</th><td><?= $paciente->getRaza() ?></td>
    </tr>
    <tr>
        <th>Color</th><td><?= $paciente->getColor() ?></td><th>Edad</th><td><?= $paciente->calcularEdad($paciente->getFechaNacimiento(), date("Y-m-d")) ?> años</td><th>Sexo</th><td><?= $paciente->getSexo() ?></td>
    </tr>
    <tr>
        <th colspan="6">DATOS DEL ACUDIENTE</th>
    </tr>
    <tr>
        <th>Nombres</th><td colspan="2"><?= $usuario->getNombres() ?> <?= $usuario->getApellidos() ?></td><th>Identificacion</th><td colspan="2"><?= $usuario->getIdentificacion() ?></td>
    </tr>
    <tr>
        <th>Teléfono</th><td colspan="2"><?= $usuario->getTelefono() ?></td><th>Correo Electrónico</th><td colspan="2"><?= $usuario->getCorreoElectronico() ?></td>
    </tr>
</table>
<br>
<form name="formularioConsulta" method="post" action="presentacion/consulta/registrarConsulta.php">
    <table align="center" border="1">
        <tr>
            <th colspan="7">
               EXAMEN CLÍNICO 
            </th>
        </tr>
        <tr><th>ACTITUD</th><td colspan="6"><input type="text" name="actitud" value="<?= $examen->getActitud()?>" size="80"/></td></tr>
        <tr><th>CONDICIÓN CORPORAL</th><td><select name="condicionCorporal"><?= CondicionCorporal::getListaEnOptions($examen->getCondicionCorporal()) ?></select></td>
            <th>ESTADO HIDRATACIÓN</th><td><select name="estadoHidratacion"><?= EstadoHidratacion::getListaEnOptions($examen->getEstadoHidratacion()) ?></select></td>
        </tr>
        </table>
<br>
    <table align="center" border="1">
        <tr>
            <th colspan="7">
               DESPARASITACIÓN
            </th>
        </tr>
        <tr><th>ESTADO DESPARASITACIÓN</th>
            <td><select name="estadoDesparasitacion" value="<?=$desparasitacion->getEstadoDesparasitacion()?>">
                <option value="Si">Si</option>
                <option value="No" selected>No</option>
                </select>
                <input type="hidden" name="fechaDesparasitacion" value="<?=date('Y-m-d h:i')?>"
            </td>
        </tr>
    </table>
<br>
    <table align="center" border="1">
        <tr>
            <th colspan="7">
               CONSTANTES FISIOLÓGICAS
            </th>
        </tr>
        <tr>
            <th>T.LI.C</th><td><input type="text" name="tlc" value="<?=$constantesFisiologicas->getTlc()?>" size="10"/></td>
            <th>TEMPERATURA</th><td><input type="text" name="temperatura" value="<?=$constantesFisiologicas->getTemperatura()?>" size="10"/></td>
            <th>F.R</th><td><input type="text" name="fr" value="<?=$constantesFisiologicas->getFr()?>" size="10"/></td>            
        </tr>
        <tr>
            <th>PULSO</th><td><input type="text" name="pulso" value="<?=$constantesFisiologicas->getPulso()?>" size="10"/></td>
            <th>PESO</th><td><input type="text" name="peso" value="<?=$constantesFisiologicas->getPeso()?>" size="10"/></td>
            <th>F.C</th><td><input type="text" name="fc" value="<?=$constantesFisiologicas->getFc()?>" size="10"/></td>            
        </tr>
    </table>
<br>
    <table align="center" border="1">
        <tr>
            <th colspan="7">
               PLAN DIAGNÓSTICO
            </th>
        </tr>
        <tr>
            <th>CUADRO HEMÁTICO</th><td><input type="text" name="cuadroHematico" value="<?= $planDiagnostico->getCuadroHematico()?>" size="50"/></td>
            <th>FECHA</th><td><input type="text" name="fechaCuadroHematico" value="<?= $planDiagnostico->getFechaCuadroHematico()?>"/></td>
        </tr>               
        <tr>
            <th>PARCIAL DE ORINA</th><td><input type="text" name="parcialOrina" value="<?= $planDiagnostico->getParcialOrina()?>" size="50"/></td>
            <th>FECHA</th><td><input type="text" name="fechaParcialOrina" value="<?= $planDiagnostico->getFechaParcialOrina()?>"/></td>
        </tr>
        <tr>
            <th>COPROLÓGICO</th><td><input type="text" name="coprologico" value="<?= $planDiagnostico->getCoprologico()?>" size="50"/></td>
            <th>FECHA</th><td><input type="text" name="fechaCoprologico" value="<?= $planDiagnostico->getFechaCoprologico()?>"/></td>
        </tr>        
        <tr>
            <th>COPROSCÓPICO</th><td><input type="text" name="coproscopico" value="<?= $planDiagnostico->getCoproscopico()?>" size="50"/></td>
            <th>FECHA</th><td><input type="text" name="fechaCoproscopico" value="<?= $planDiagnostico->getFechaCoproscopico()?>"/></td>
        </tr>           
    </table>
<br>
    <table align="center" border="1">
        <tr>
            <th colspan="4">
               LISTA DE PROBLEMAS
            </th>
        </tr>
        <tr>
            <th>NOMBRE</th><td><input type="text" name="nombre" value="<?= $listaProblemas->getNombre()?>" size="50"/></td>
            <th>DIAGNOSTICO DIFERENCIAL</th><td><input type="text" name="diagnosticoDiferencial" value="<?= $listaProblemas->getDiagnosticoDiferencial()?>"/></td>
        </tr>                       
        <tr>
            <td colspan="4" align="center">D: Degenerativa – A: Anomalía congénita – M: Metabólica – N: Nutricional y neoplásica<br> V: Vascular – I: Infecciosa, inflamatoria o idiomática – T: Trauma</td>
        </tr>
    </table>
<br>
    <table align="center" border="1">
        <tr>
            <th colspan="7">
               CITOLOGÍA
            </th>
        </tr>
        <tr>
            <th>RESULTADO</th><td><input type="text" name="resultado" value="<?= $citologia->getResultado()?>" size="40"/></td>
            <th>OBSERVACIONES</th><td><input type="text" name="observacionesCitologia" value="<?= $citologia->getObservaciones()?>" size="40"/></td>
        </tr>
    </table>
<br>
    <table align="center" border="1">
        <tr>
            <th colspan="7">
               PLAN TERAPÉUTICO
            </th>
        </tr>
        <tr>
            <th>TIPO</th><th>MEDICAMENTO</th><th>DOSIS TOTAL</th><th>VIA ADMINISTRACIÓN</th><th>FRECUENCIA</th><th>DURACIÓN</th>
        </tr>
        <tr>
            <td><input type="text" name="tipo1" value="<?= $planTerapeurico->getTipo1()?>" size="10"/></td>
            <td><input type="text" name="medicamento1" value="<?= $planTerapeurico->getMedicamento1()?>" size="20"/></td>
            <td><input type="text" name="dosisTotal1" value="<?= $planTerapeurico->getDosisTotal1()?>" size="10"/></td>
            <td><input type="text" name="viaAdministracion1" value="<?= $planTerapeurico->getViaAdministracion1()?>"/></td>
            <td><input type="text" name="frecuencia1" value="<?= $planTerapeurico->getFrecuencia1()?>" size="10"/></td>
            <td><input type="text" name="duracion1" value="<?= $planTerapeurico->getDuracion1()?>" size="10"/></td>
        </tr>
        <tr>
            <td><input type="text" name="tipo2" value="<?= $planTerapeurico->getTipo2()?>" size="10"/></td>
            <td><input type="text" name="medicamento2" value="<?= $planTerapeurico->getMedicamento2()?>" size="20"/></td>
            <td><input type="text" name="dosisTotal2" value="<?= $planTerapeurico->getDosisTotal2()?>" size="10"/></td>
            <td><input type="text" name="viaAdministracion2" value="<?= $planTerapeurico->getViaAdministracion2()?>"/></td>
            <td><input type="text" name="frecuencia2" value="<?= $planTerapeurico->getFrecuencia2()?>" size="10"/></td>
            <td><input type="text" name="duracion2" value="<?= $planTerapeurico->getDuracion2()?>" size="10"/></td>
        </tr>
        <tr>
            <td><input type="text" name="tipo3" value="<?= $planTerapeurico->getTipo3()?>" size="10"/></td>
            <td><input type="text" name="medicamento3" value="<?= $planTerapeurico->getMedicamento3()?>" size="20"/></td>
            <td><input type="text" name="dosisTotal3" value="<?= $planTerapeurico->getDosisTotal3()?>" size="10"/></td>
            <td><input type="text" name="viaAdministracion3" value="<?= $planTerapeurico->getViaAdministracion3()?>"/></td>
            <td><input type="text" name="frecuencia3" value="<?= $planTerapeurico->getFrecuencia3()?>" size="10"/></td>
            <td><input type="text" name="duracion3" value="<?= $planTerapeurico->getDuracion3()?>" size="10"/></td>
        </tr>
        <tr>
            <td><input type="text" name="tipo4" value="<?= $planTerapeurico->getTipo4()?>" size="10"/></td>
            <td><input type="text" name="medicamento4" value="<?= $planTerapeurico->getMedicamento4()?>" size="20"/></td>
            <td><input type="text" name="dosisTotal4" value="<?= $planTerapeurico->getDosisTotal4()?>" size="10"/></td>
            <td><input type="text" name="viaAdministracion4" value="<?= $planTerapeurico->getViaAdministracion4()?>"/></td>
            <td><input type="text" name="frecuencia4" value="<?= $planTerapeurico->getFrecuencia4()?>" size="10"/></td>
            <td><input type="text" name="duracion4" value="<?= $planTerapeurico->getDuracion4()?>" size="10"/></td>
        </tr>
        <tr>
            <td><input type="text" name="tipo5" value="<?= $planTerapeurico->getTipo5()?>" size="10"/></td>
            <td><input type="text" name="medicamento5" value="<?= $planTerapeurico->getMedicamento5()?>" size="20"/></td>
            <td><input type="text" name="dosisTotal5" value="<?= $planTerapeurico->getDosisTotal5()?>" size="10"/></td>
            <td><input type="text" name="viaAdministracion5" value="<?= $planTerapeurico->getViaAdministracion5()?>"/></td>
            <td><input type="text" name="frecuencia5" value="<?= $planTerapeurico->getFrecuencia5()?>" size="10"/></td>
            <td><input type="text" name="duracion5" value="<?= $planTerapeurico->getDuracion5()?>" size="10"/></td>
        </tr>
    </table>
<br>
    <table align="center" border="1">
        <tr>
            <th colspan="4">
               DIAGNÓSTICO DEFINITIVO
            </th>
        </tr>
        <tr>
            <th>DIAGNOSTICO DEFINITIVO</th><td><input type="text" name="diagnosticoDefinitivo" value="<?= $diagnosticoDefinitivo->getDiagnosticoDefinitivo()?>"/></td>
        </tr>
        <tr>
            <th>OBSERVACIONES</th><td><input type="text" name="observaciones" value="<?= $diagnosticoDefinitivo->getObservaciones()?>"/></td>
        </tr>                       
        <tr>                       
        <input type="hidden" name="idConsulta" value="<?=$consulta->getId()?>"/>            
        </tr>
    </table>
        <br>
        <br>
    <table align="center" border="1">
        <tr>
            <th colspan="6" align="right"><input type="submit" name="guardar" value="Adicionar"/></th>
        </tr>
    </table>
        
</form>
<br>
<!--
<table border="1" align="center">
    <tr>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/examenClinico.php&idPaciente=<?= $paciente->getId()?>&idConsulta=" title="Exámen Clínico"><img src="presentacion/imagenes/consulta/examenClinico.png" width="100" height="100"></a></td>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/desparacitacion.php" title="Desparasitación"><img src="presentacion/imagenes/consulta/desparasitacion.png" width="100" height="100"></a></td>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/constantesFisiologicas.php" title="Constantes Fisiológicas"><img src="presentacion/imagenes/consulta/constantesFisiologicas.png" width="100" height="100"></a></td>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/planDiagnostico.php" title="Plan Diagnóstico"><img src="presentacion/imagenes/consulta/planDiagnostico.png" width="100" height="100"></a></td>
    </tr>
    <tr>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/listaProblemas.php" title="Lista de problemas"><img src="presentacion/imagenes/consulta/listaProblemas.png" width="100" height="100"></a></td>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/citologia.php" title="Citología"><img src="presentacion/imagenes/consulta/citologia.png" width="100" height="100"></a></td>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/planTerapeutico.php" title="Plan Terapéutico"><img src="presentacion/imagenes/consulta/planTerapeutico.png" width="100" height="100"></a></td>
        <td><a href="principal.php?CONTENIDO=presentacion/consulta/diagnosticoDefinitivo.php" title="Diagnóstico Definitivo"><img src="presentacion/imagenes/consulta/diagnosticoDefinitivo.png" width="100" height="100"></a></td>
    </tr>
</table>
-->

<script type="text/javascript">
function mostrarFoto(){
    var lector=new FileReader();
    lector.readAsDataURL(document.formulario.foto.files[0]);
    lector.onloadend = function (){
        document.getElementById("foto").src=lector.result;
    };
}
</script>

