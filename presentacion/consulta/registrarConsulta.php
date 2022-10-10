<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once '../../logica/clases/ExamenClinico.php';
require_once '../../logica/clases/Desparasitacion.php';
require_once '../../logica/clases/ConstantesFisiologicas.php';
require_once '../../logica/clases/PlanDiagnostico.php';
require_once '../../logica/clases/ListaProblemas.php';
require_once '../../logica/clases/Citologia.php';
require_once '../../logica/clases/PlanTerapeutico.php';
require_once '../../logica/clases/DiagnosticoDefinitivo.php';
require_once '../../logica/clasesGenericas/ConectorBD.php';

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado'); //Validación de seguridad

//$direccion='location: principal.php?CONTENIDO=presentacion/consulta/consulta.php';
$examen= new ExamenClinico(null, null);
$desparasitacion= new Desparasitacion(null, null);
$constantesFisiologicas = new ConstantesFisiologicas(null, null);
$planDiagnostico= new PlanDiagnostico(null, null);
$listaProblemas= new ListaProblemas(null, null);
$citologia= new Citologia(null, null);
$planTerapeurico= new PlanTerapeutico(null, null);
$diagnosticoDefinitivo= new DiagnosticoDefinitivo(null, null);

//Graba los datos en la tabla examen clinico
$examen->setIdConsulta($_REQUEST['idConsulta']);
$examen->setActitud($_REQUEST['actitud']);
$examen->setCondicionCorporal($_REQUEST['condicionCorporal']);
$examen->setEstadoHidratacion($_REQUEST['estadoHidratacion']);

$desparasitacion->setIdConsulta($_REQUEST['idConsulta']);
$desparasitacion->setEstadoDesparasitacion($_REQUEST['estadoDesparasitacion']);
$desparasitacion->setFechaDesparasitacion($_REQUEST['fechaDesparasitacion']);

$constantesFisiologicas->setIdConsulta($_REQUEST['idConsulta']);
$constantesFisiologicas->setTlc($_REQUEST['tlc']);
$constantesFisiologicas->setTemperatura($_REQUEST['temperatura']);
$constantesFisiologicas->setFr($_REQUEST['fr']);
$constantesFisiologicas->setFc($_REQUEST['fc']);
$constantesFisiologicas->setPulso($_REQUEST['pulso']);
$constantesFisiologicas->setPeso($_REQUEST['peso']);

$planDiagnostico->setIdConsulta($_REQUEST['idConsulta']);
$planDiagnostico->setCuadroHematico($_REQUEST['cuadroHematico']);
$planDiagnostico->setFechaCuadroHematico($_REQUEST['fechaCuadroHematico']);
$planDiagnostico->setParcialOrina($_REQUEST['parcialOrina']);
$planDiagnostico->setFechaParcialOrina($_REQUEST['fechaParcialOrina']);
$planDiagnostico->setCoprologico($_REQUEST['coprologico']);
$planDiagnostico->setFechaCoprologico($_REQUEST['fechaCoprologico']);
$planDiagnostico->setCoproscopico($_REQUEST['coproscopico']);
$planDiagnostico->setFechaCoproscopico($_REQUEST['fechaCoproscopico']);

$listaProblemas->setIdConsulta($_REQUEST['idConsulta']);
$listaProblemas->setNombre($_REQUEST['nombre']);
$listaProblemas->setDiagnosticoDiferencial($_REQUEST['diagnosticoDiferencial']);

$citologia->setIdConsulta($_REQUEST['idConsulta']);
$citologia->setResultado($_REQUEST['resultado']);
$citologia->setObservaciones($_REQUEST['observacionesCitologia']);

$planTerapeurico->setIdConsulta($_REQUEST['idConsulta']);
$planTerapeurico->setTipo1($_REQUEST['tipo1']);
$planTerapeurico->setTipo2($_REQUEST['tipo2']);
$planTerapeurico->setTipo3($_REQUEST['tipo3']);
$planTerapeurico->setTipo4($_REQUEST['tipo4']);
$planTerapeurico->setTipo5($_REQUEST['tipo5']);
$planTerapeurico->setMedicamento1($_REQUEST['medicamento1']);
$planTerapeurico->setMedicamento2($_REQUEST['medicamento2']);
$planTerapeurico->setMedicamento3($_REQUEST['medicamento3']);
$planTerapeurico->setMedicamento4($_REQUEST['medicamento4']);
$planTerapeurico->setMedicamento5($_REQUEST['medicamento5']);
$planTerapeurico->setDosisTotal1($_REQUEST['dosisTotal1']);
$planTerapeurico->setDosisTotal2($_REQUEST['dosisTotal2']);
$planTerapeurico->setDosisTotal3($_REQUEST['dosisTotal3']);
$planTerapeurico->setDosisTotal4($_REQUEST['dosisTotal4']);
$planTerapeurico->setDosisTotal5($_REQUEST['dosisTotal5']);
$planTerapeurico->setViaAdministracion1($_REQUEST['viaAdministracion1']);
$planTerapeurico->setViaAdministracion2($_REQUEST['viaAdministracion2']);
$planTerapeurico->setViaAdministracion3($_REQUEST['viaAdministracion3']);
$planTerapeurico->setViaAdministracion4($_REQUEST['viaAdministracion4']);
$planTerapeurico->setViaAdministracion5($_REQUEST['viaAdministracion5']);
$planTerapeurico->setFrecuencia1($_REQUEST['frecuencia1']);
$planTerapeurico->setFrecuencia2($_REQUEST['frecuencia2']);
$planTerapeurico->setFrecuencia3($_REQUEST['frecuencia3']);
$planTerapeurico->setFrecuencia4($_REQUEST['frecuencia4']);
$planTerapeurico->setFrecuencia5($_REQUEST['frecuencia5']);
$planTerapeurico->setDuracion1($_REQUEST['duracion1']);
$planTerapeurico->setDuracion2($_REQUEST['duracion2']);
$planTerapeurico->setDuracion3($_REQUEST['duracion3']);
$planTerapeurico->setDuracion4($_REQUEST['duracion4']);
$planTerapeurico->setDuracion5($_REQUEST['duracion5']);

$diagnosticoDefinitivo->setIdConsulta($_REQUEST['idConsulta']);
$diagnosticoDefinitivo->setDiagnosticoDefinitivo($_REQUEST['diagnosticoDefinitivo']);
$diagnosticoDefinitivo->setObservaciones($_REQUEST['observaciones']);

$examen->guardar();
$desparasitacion->guardar();
$constantesFisiologicas->guardar();
$planDiagnostico->guardar();
$listaProblemas->guardar();
$citologia->guardar();
$planTerapeurico->guardar();
$diagnosticoDefinitivo->guardar();


