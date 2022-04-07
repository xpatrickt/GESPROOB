<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('autentificar'))
{
    function autentificar()
    {
        $CI = & get_instance();
        $controlador = $CI->uri->segment(1);
        $accion = $CI->uri->segment(2);
        $parametro = $CI->uri->segment(3);
        $url = ($accion=='' ? $controlador : $controlador.'/'.$accion);

        if($parametro!='')
        {
            $url = $controlador.'/'.$accion.'/'.$parametro;
        }

        $libres = array(
            '/',
            'Login/muestralog',
            'Login/ingresar',
            'Login/logout',
            'AplicativoMovil/listadoProyectoGrupoFuncional',
            'AplicativoMovil/listadoProyectoDivisionFuncional',
            'AplicativoMovil/listadoProyectoFuncion',
            'AplicativoMovil/listadoNoPipPorTipoNoPip',
            'AplicativoMovil/index',
            'AplicativoMovil/listaTotalDeUbicacionesProyecto',
            'AplicativoMovil/DatosGeneralesdelPip',
            'AplicativoMovil/GraficarPip',
            'AplicativoMovil/',
            'AplicativoMovil/Pips',
            'Usuario/accesodenegado'
        );

        if(in_array($url, $libres))
        {
            echo $CI->output->get_output();
        }
        else
        {
            if($CI->session->userdata('idPersona'))
            {
                if($CI->session->userdata('tipo_acceso')==1)
                {
                    $CI->load->database('lectura',FALSE,TRUE);
                }
                if($CI->session->userdata('tipo_acceso')==2)
                {
                    $CI->load->database('escritura',FALSE,TRUE);
                }
                if($CI->session->userdata('tipo_acceso')==3)
                {
                    $CI->load->database('default', FALSE,TRUE);
                }
                if(autorizar($url))
                {
                    if($CI->session->userdata('horario_permitido')=='libre')
                    {
                        echo $CI->output->get_output();
                    }
                    else
                    {
                        $diaHoraAcceso=date('d H:i');
                        $diaHoraPermitido=$CI->session->userdata('horario_permitido');
                        if($diaHoraAcceso>$diaHoraPermitido)
                        {
                            redirect('Login/logout');
                        }
                        else
                        {
                            echo $CI->output->get_output();
                        }
                    }
                }
                else
                {
                    redirect('Usuario/accesodenegado');
                }
            }
            else
            {
            	redirect('Login/muestralog');
            }
        }

    }
}
function autorizar($url)
{
    $CI = & get_instance();
    $CI->load->model('Model_Usuario');
    $listaRutasPermitidas = $CI->Model_Usuario->listaUrlAsignado($CI->session->userdata('idPersona'));
    $arrayPermitido = [];
    foreach ($listaRutasPermitidas as $key => $value)
    {
        $arrayPermitido[] = $value->url;
    }

    $lista_API = array(
      '',
      'Inicio',
      'migracion/clonacion',
      'Usuario/listaMenu',
      'Usuario/listaUrlAsignado',
      'Usuario/itemUsuario',
      'Usuario/ListarTipoUsuario',
      'Personal/ListarPersonal',
      'Funcion/GetDivisionFuncional',
      'Funcion/GetGrupoFuncional',
      'Funcion/GetFuncion',
      'Funcion/GetDistrito',
      'criterio/addPrioridad',
      'criterio/getFactor',
      'criterio/updateCriterio',
      'criterio/addCriterio',
      'criterio/updateFactor',
      'criterio/addFactor',
      'criterio/updateValorizacion',
      'criterio/addValorizacion',
      'Expediente_Tecnico/AsignarValorizacion',
      'Expediente_Tecnico/CronogramacionRecurso',
      'Expediente_Tecnico/eliminarValorizacionPartida',
      'Expediente_Tecnico/MemoriaDescriptiva',
      'Expediente_Tecnico/ImpactoAmbiental',
      'Expediente_Tecnico/reporteDesagGastosGenerales',
      'Expediente_Tecnico/reporteDesagGastosSupervision',
      'Expediente_Tecnico/reporteListaInsumos',
      'Expediente_Tecnico/reporteDesagHerramientas',
      'Expediente_Tecnico/reporteDesagGastosLiquidacion',
      'Expediente_Tecnico/cronogramaEjecucionProyecto',
      'Expediente_Tecnico/reportePdfValorizacionFisicaAdicionales',
      'Expediente_Tecnico/reportePdfValorizacionDeductivo',
      'ET_RelacionInsumo/insertar',
      'ET_RelacionInsumo/ReportePdfCronogramaRequerimiento',
      'ET_Meta_Analitico/insertar',
      'ET_Meta_Analitico/eliminar',
      'ET_AdicionalObra/insertar',
      'ET_AdicionalObra/resolucionComponente',
      'ET_AdicionalObra/resolucionMeta',
      'ET_AdicionalObra/resolucionPartida',
      'DivisionFuncional/EliminarDivisionFunc',
      'GrupoFuncional/EliminarGFuncional',
      'Funcion/EliminarFuncion',
      'Usuario/cambiarContrasenia',
      'usuario/cambiarContrasenia',
      'ET_Componente/cargarNivel',
      'ET_EspecificacionTecnica/Insertar',
      'ET_EspecificacionTecnica/verPorDescripcion',
      'ET_EspecificacionTecnica/Guardar',
      'ET_EspecificacionTecnica/FormatoEspecificacionTecnica',
      'ET_EspecificacionTecnica/FormatoEspecificacionTecnicaPorComponente',
      'ET_EspecificacionTecnica/AgregarGeneralidad',
      'ET_Observacion_Tarea/insertar',
      'ET_Levantamiento_Obs/insertar',
      'ET_Presupuesto_Analitico/insertar',
      'ET_Documento_Ejecucion/insertar',
      'Expediente_Tecnico/registroBuscarMeta',
      'Expediente_Tecnico/AsignarOrden',
      'ET_Img/eliminar',
      'Expediente_Tecnico/registroBuscarProyecto',
      'Expediente_Tecnico/insertar',
      'Expediente_Tecnico/registroBuscarProyecto',
      'Expediente_Tecnico/clonar',
      'Expediente_Tecnico/InformeMensual',
      'Expediente_Tecnico/CalcularNumeroMeses',
      'Expediente_Tecnico/eliminar',
      'Expediente_Tecnico/clonacion',
      'Manifiesto_Gasto/insertar',
      'Manifiesto_Gasto/busquedaManifiesto',
      'Manifiesto_Gasto/reportePdf',
      'Manifiesto_Gasto/busquedaEjecucionPresupuestal',
      'Manifiesto_Gasto/reporteEjecucionPdf',
      'Manifiesto_Gasto/programacionClasificador',
      'Manifiesto_Gasto/listaFuenteFinanciamiento',
      'Manifiesto_Gasto/insertarProgramacionAnalitico',
      'Manifiesto_Gasto/cuadroComparativo',
      'Manifiesto_Gasto/reportePdfCuadro',
      'ET_Presupuesto_Ejecucion/eliminar',
      'ET_Recurso/eliminar',
      'ET_Periodo_Ejecucion/insertar',
      'NoPipProgramados/listarNopip',
      'mensaje/eliminarMensaje',
      'Usuario/getUsuario',
      'mensaje/enviar',
      'Personal/EliminarPersonal',
      'Mo_MonitoreodeProyectos/index',
      'Mo_MonitoreodeProyectos/BuscarProyecto',
      'Mo_MonitoreodeProyectos/InsertarProducto',
      'Mo_MonitoreodeProyectos/EditarProducto',
      'Mo_MonitoreodeProyectos/editarDatosProducto',
      'Mo_MonitoreodeProyectos/eliminarMonitoreo',
      'Mo_MonitoreodeProyectos/eliminarProducto',
      'Mo_MonitoreodeProyectos/FichadeMonitoreo',
      'Mo_MonitoreodeProyectos/FichadeMonitoreoPDF',
      'Mo_MonitoreodeProyectos/avanceFisicoFinanciero',
      'Mo_MonitoreodeProyectos/valoracionRestante',
      'Mo_MonitoreodeProyectos/diagramGantt',
      'Mo_MonitoreodeProyectos/consulta',
      'Mo_Actividad/Insertar',
      'Mo_Actividad/editar',
      'Mo_Actividad/eliminar',
      'Mo_Actividad/calcularMontoProgramado',
      'Mo_Ejecucion_Actividad/Insertar',
      'Mo_Ejecucion_Actividad/eliminar',
      'Mo_Programacion_Actividad/Insertar',
      'Mo_Programacion_Actividad/editar',
      'Mo_Programacion_Actividad/eliminar',
      'Mo_Monitoreo/index',
      'Mo_Monitoreo/insertar',
      'Mo_MonitoreoResultado/index',
      'Mo_MonitoreoResultado/verresultado',
      'Mo_MonitoreoResultado/insertar',
      'Mo_MonitoreoResultado/editar',
      'Mo_MonitoreoResultado/eliminar',
      'Mo_MonitoreoResultado/adjuntarDocumento',
      'Mo_MonitoreoResultado/eliminarArchivo',
      'Mo_Observacion/insertar',
      'Mo_Observacion/editar',
      'Mo_Observacion/eliminar',
      'Mo_Compromiso/insertar',
      'Mo_Compromiso/editar',
      'Mo_Compromiso/eliminar',
      'Mo_ProActVistoBueno/index',
      'Mo_ProActVistoBueno/vistoBueno',
      'Mo_ProActVistoBueno/insertar',
      'Mo_ProActVistoBueno/editar',
      'Mo_ProActVistoBueno/eliminar',
      'Mo_BandejaMonitoreo/ListaMensajes',
      'Mo_BandejaMonitoreo/editarBandeja',
      'Control/insertar',
      'Control/editar',
      'Control/eliminar',
      'Control/editarControlUsuario',
      'bancoproyectos/Get_ubigeo_pip',
      'bancoproyectos/BuscarProyectoSiaf',
      'bancoproyectos/eliminarModalidadPi',
      'bancoproyectos/editarUbicacionGeografica',
      'bancoproyectos/eliminarUbigeo',
      'bancoproyectos/listar_modalidad_ejec',
      'bancoproyectos/Get_OperacionMantenimiento',
      'bancoproyectos/insertarProyectosSiaf',
      'bancoproyectos/insertarProyectosPIDE',
      'bancoproyectos/insertarProyectoCodigoPIDE',
      'bancoproyectos/insertarEstudioCodigoPIDE',
      'bancoproyectos/filtrarProyectoInversion',
      'bancoproyectos/filtrarProyectoInversion1',
      'CarteraInversion/EditCartera',
      'CarteraInversion/AddCartera',
      'PmiCriterioG/ReporteCriteriosG',
      'CarteraInversion/GetCarteraFechaCierre',
      'CarteraInversion/GetCarteraFechaCierre',
      'CarteraInversion/GetCarteraFechaCierre',
      'CarteraInversion/EditCartera',
      'CarteraInversion/AddCartera',
      'CarteraInversion/EliminarCartera',
      'PmiCriterioG/listarCriterioGPorAnios',
      'PmiCriterioEspecifico/listarCriterioEspecificos',
      'PuntajeCriterioPi/listarPuntajePorAnios',
      'PuntajeCriterioPi/pipPriorizadas',
      'bancoproyectos/listar_distrito',
      'bancoproyectos/Editar_ubigeo_proyecto',
      'bancoproyectos/listar_distrito',
      'PrincipalReportes/FuncionNumeroPip',
      'PrincipalReportes/especificacionOrden',
      'PrincipalReportes/FuncionNumeroPip',
      'PrincipalReportes/GrafDetalleMensualizado',
      'PrincipalReportes/GrafDetalleMensualizado',
      'PrincipalReportes/DatosParaEstadisticaAnualProyecto',
      'PrincipalReportes/DatosEjecucionPresupuestal',
      'PrincipalReportes/DatosCorrelativoMeta',
      'PrincipalReportes/GrafEstInfFinanciera',
      'PrincipalReportes/BuscadorPipPorCodigoReporte',
      'PrincipalReportes/GrafAvanceFinanciero',
      'PrincipalReportes/ReporteDevengadoPiaPimPorPipGraficos',
      'PrincipalReportes/listaExpedientes',
      'PrincipalReportes/detalleOrdenExpSiafUe',
      'Importacion/codigo',
      'Importacion/anio',
      'Usuario/editUsuarioProyecto',
      'menu/getMenu',
      'menu/updateMenu',
      'menu/addMenu',
      'Personal/addcargo',
      'Personal/updatecargo',
      'DivisionFuncional/AddDivisionFucion',
      'DivisionFuncional/UpdateDivisionFucion',
      'Funcion/GetFuncion',
      'Funcion/ProyectosPorCadenaFuncional',
      'Entidad/AddEntidad',
      'Entidad/UpdateEntidad',
      'Entidad/EliminarEntidad',
      'EstadoCicloInversion/AddEstadoCicloInversion',
      'EstadoCicloInversion/UpdateEstadoCicloInversion',
      'EstadoCicloInversion/EliminarEstadoCicloInversion',
      'FuenteFinanciamiento/AddFuenteFinanciamiento',
      'FuenteFinanciamiento/UpdateFuenteFinanciamiento',
      'FuenteFinanciamiento/EliminarFuenteFinanciamiento',
      'Funcion/AddFucion',
      'Funcion/UpdateFuncion',
      'Gerencia/AddGerencia',
      'Gerencia/UpdateGerencia',
      'GrupoFuncional/AddGrupoFuncional',
      'GrupoFuncional/UpdateGrupoFuncional',
      'Funcion/GetFuncion',
      'DivisionFuncional/GetDivisionFuncional',
      'Sector/GetSector',
      'MFuncion/GetGrupoFuncional',
      'Importar/addImportar',
      'Indicador/AddIndicador',
      'Indicador/UpdateIndicador',
      'Indicador/DeleteIndicador',
      'MantenimientoBrecha/AddBrecha',
      'MantenimientoBrecha/UpdateBrecha',
      'ServicioPublico/GetServicioAsociado',
      'MantenimientoBrecha/DeleteBrecha',
      'Meta/EditarMetaPresupuestal',
      'Meta/metaPresupuestalPi',
      'Meta/AddMeta',
      'Meta/editarMeta',
      'meta/Eliminar_meta_prepuestal',
      'MetaPresupuestal/AddMetaP',
      'MetaPresupuestal/UpdateMetaP',
      'MFuncion/AddFucion',
      'MFuncion/UpdateFuncion',
      'MFuncion/AddDivisionFucion',
      'MFuncion/UpdateDivisionFucion',
      'MFuncion/AddGrupoFuncional',
      'MFuncion/UpdateGrupoFuncional',      
      'MFuncion/GetFuncion',
      'MFuncion/GetDivisionFuncional',
      'ModalidadEjecucion/AddModalidadE',
      'ModalidadEjecucion/UpdateModalidadE',
      'MRubroEjecucion/AddRubroE',
      'MRubroEjecucion/UpdateRubroE',
      'MRubroEjecucion/EliminarRubroEjecucion',
      'FuenteFinanciamiento/get_FuenteFinanciamiento',
      'MSectorEntidadSpu/EliminarSector1',
      'MSectorEntidadSpu/AddSector',
      'MSectorEntidadSpu/UpdateSector',
      'MSectorEntidadSpu/AddEntidad',
      'MSectorEntidadSpu/UpdateEntidad',
      'MSectorEntidadSpu/AddServicioAsociado',
      'MSectorEntidadSpu/UpdateServicioAsociado',
      'MSectorEntidadSpu/EliminarSector',
      'MSectorEntidadSpu/GetSector',
      'MSectorEntidadSpu/EliminarEntidad',
      'TipologiaInversion/AddNaturalezaInversion',
      'TipologiaInversion/UpdateNaturalezaInversion',
      'TipologiaInversion/EliminarNaturalezaInversion',
      'NivelGobierno/AddNivelGobierno',
      'NivelGobierno/UpdateNivelGobierno',
      'NivelGobierno/EliminarNivelGobierno',
      'Oficina/AddOficina',
      'Oficina/UpdateOficina',
      'SubGerencia/GetSubGerencia',
      'Personal/AddPersonal',
      'Personal/UpdatePersonal',
      'Personal/GetPersona',
      'Oficina/GetOficina',
      'Personal/GetEspecilidad',
      'ProgramaPresupuestal/AddProgramaP',
      'ProgramaPresupuestal/UpdateProgramaP',
      'ProgramaPresupuestal/EliminarProgramaP',
      'Sector/AddSector',
      'Sector/UpdateSector',
      'Sector/EliminarSector',
      'Sector/GetSector',
      'ServicioPublico/UpdateServicioAsociado',
      'ServicioPublico/AddServicioAsociado',
      'ServicioPublico/EliminarServicioPublico',
      'SubGerencia/AddSubGerencia',
      'SubGerencia/UpdateSubGerencia',
      'Gerencia/GetGerencia',
      'Oficina/listarMeta',
      'TipologiaInversion/AddTipoInversion',
      'TipologiaInversion/UpdateTipoInversion',
      'TipologiaInversion/EliminarTipoInversion',
      'TipologiaInversion/AddTipologiaInversion',
      'TipologiaInversion/UpdateTipologiaInversion',
      'TipologiaInversion/EliminarTipologiaInversion',
      'TipologiaInversion/AddTipoNoPip',
      'TipologiaInversion/UpdateTipoNoPip',
      'TipologiaInversion/EliminarTipoNoPip',
      'UnidadE/AddUnidadE',
      'UnidadE/UpdateUnidadE',
      'UnidadF/AddUnidadF',
      'UnidadF/UpdateUnidadF',
      'PrincipalFyE/GetAprobadosEstudio',
      'PrincipalFyE/EstudioInvPorTipoEstudio',
      'PrincipalFyE/TipoGastoMontos',
      'PrincipalFyE/EstudioInvPorProvincia',
      'PrincipalFyE/AvanceCostoInv',
      'PrincipalFyE/getDatosEstudiosInversionNotificacion',
      'PrincipalPmi/get_cantidad_costo_tipo_pi',
      'PrincipalPmi/EstadisticaPipProvinc',
      'PrincipalPmi/EstadisticaMontoPipProvincias',
      'PrincipalPmi/EstadisticaPipEstadoCiclo',
      'PrincipalPmi/GetDatosUbicacion',
      'programar_pip/GetAnioCarteraProgramado',
      'PrincipalPmi/EstadisticaPipProvinc',
      'PrincipalPmi/EstadisticaMontoPipProvincias',
      'PrincipalPmi/EstadisticaPipEstadoCiclo',
      'PrincipalPmi/EstadisticaMontoPipCicloInversion',
      'PrincipalReportes/GetAprobadosEstudio',
      'PrincipalReportes/NaturalezaInversionMontos',
      'PrincipalReportes/CantidadPipFuenteFinancimiento',
      'PrincipalReportes/CantidadPipModalidad',
      'PrincipalReportes/MontoPipModalidad',
      'PrincipalReportes/CantidadPipRubro',
      'PrincipalReportes/CantidadPipProvincia',
      'PrincipalReportes/FuncionNumeroPip',
      'Estudio_Inversion/get_UnidadFormuladora',
      'Estudio_Inversion/eliminarCoordinadorEstudio',
      'Estudio_Inversion/getCoordinadorEstudio',
      'Estudio_Inversion/eliminarEtapaEstado',
      'DenominacionFE/AddDenominacionFE',
      'DenominacionFE/UpdateDenominacionFE',
      'Estudio_Inversion/get_listaproyectos',
      'Estudio_Inversion/get_TipoEstudio',
      'Estudio_Inversion/get_NivelEstudio',
      'Estudio_Inversion/get_UnidadEjecutora',
      'Estudio_Inversion/get_UnidadFormuladora',
      'Estudio_Inversion/get_listaproyectosCargar',
      'Estudio_Inversion/AddEstudioInversion',
      'Estudio_Inversion/registroEstudio',
      'Estudio_Inversion/listaProyectoPorEstado',
      'Estudio_Inversion/AddDocumentosEstudio',
      'Estudio_Inversion/AddEtapaEstudio',
      'Estudio_Inversion/AddResponsableEstudio',
      'EstadoCicloInversion/listarEstadoCicloNombre',
      'Estudio_Inversion/GetDocumentosEstudio',
      'Estudio_Inversion/get_persona',
      'Estudio_Inversion/get_etapasFE',
      'EtapasFE/AddEtapasFE',
      'EtapasFE/UpdateEtapasFE',
      'EstadoEtapa_FE/AddEstadoEtapa_FE',
      'FEsituacion/AddSituacion',
      'Estudio_Inversion/AddAsiganarPersona',
      'EvaluacionFE/GetDetallesituacionActual',
      'FEestado/get_FEestado',
      'FEsituacion/get_FEsituacion',
      'Estudio_Inversion/get_persona',
      'Estudio_Inversion/get_cargo',
      'EstadoEtapa_FE/AddEstadoEtapa_FE',
      'FEsituacion/AddSituacion',
      'Estudio_Inversion/AddAsiganarPersona',
      'EvaluacionFE/GetDetallesituacionActual',
      'FEestado/get_FEestado',
      'FEsituacion/get_FEsituacion',
      'Estudio_Inversion/get_persona',
      'Estudio_Inversion/get_cargo',
      'FEActividadEntregable/Add_Actividades',
      'FEActividadEntregable/MostrarAvance',
      'FEActividadEntregable/Update_Actividades',
      'FEActividadEntregable/AsignacionPersonalActividad',
      'FEActividadEntregable/CalcularAvanceActividad',
      'FEentregableEstudio/UpdateEntregableAvance',
      'FEentregableEstudio/get_entregableId',
      'FEentregableEstudio/calcular_AvaceFisico',
      'FEsituacion/AddSituacion',
      'Estudio_Inversion/AddAsiganarPersona',
      'EvaluacionFE/GetDetallesituacionActual',
      'FEsituacion/get_FEsituacion',
      'Estudio_Inversion/get_persona',
      'Estudio_Inversion/get_cargo',
      'FEentregableEstudio/MostrarAvance',
      'FEActividadEntregable/ObservacionActividad',
      'FEActividadEntregable/LevantaminetoObservacionActividad',
      'FEentregableEstudio/AsignacionPersonalEntregable',
      'FEentregableEstudio/Add_Entregable',
      'FEentregableEstudio/editar_Entregable',
      'DenominacionFE/GetDenominacionFE',
      'FEActividadEntregable/Update_Actividades',
      'FEActividadEntregable/listadoObservacion',
      'FEActividadEntregable/VerValoracionRestanteActividad',
      'FEestado/add_FEestado',
      'FEestado/updateFEestado',
      'EstadoEtapa_FE/AddEstadoEtapa_FE',
      'FEsituacion/AddSituacion',
      'Estudio_Inversion/AddAsiganarPersona',
      'EvaluacionFE/GetDetallesituacionActual',
      'FEestado/get_FEestado',
      'FEsituacion/get_FEsituacion',
      'Estudio_Inversion/get_persona',
      'Estudio_Inversion/get_cargo',
      'FEnivelEstudio/add_NivelEstudio',
      'FEnivelEstudio/Update_NivelEstudio',
      'FEsituacion/add_FEsituacion',
      'FEsituacion/update_FEsituacion',
      'FEsituacion/AddSituacion',
      'Estudio_Inversion/AddAsiganarPersona',
      'EvaluacionFE/GetDetallesituacionActual',
      'FEsituacion/get_FEsituacion',
      'Estudio_Inversion/get_persona',
      'Estudio_Inversion/get_cargo',
      'FEentregableEstudio/get_gantt',
      'TipEstudioFE/AddTipoEstudioFE',
      'TipEstudioFE/UpdateTipoEstudioFE',
      'TipEstudioFE/deleteTipoEstudioFE',
      'bancoproyectos/update_pip',
      'bancoproyectos/AddOperacionMantenimiento',
      'CarteraInversion/GetCarteraAnios',
      'bancoproyectos/update_no_pip',
      'bancoproyectos/AddNoPip',
      'bancoproyectos/AddOperacionMantenimiento',
      'bancoproyectos/AddTipoNoPip',
      'bancoproyectos/AddModalidadEjecPI',
      'bancoproyectos/AddRurboPI',
      'bancoproyectos/AddEstadoCicloPI',
      'bancoproyectos/Add_ubigeo_proyecto',
      'EstadoCicloInversion/get_EstadoCicloInversion',
      'TipologiaInversion/get_NaturalezaInversion',
      'NivelGobierno/get_NivelGobierno',
      'UnidadE/GetUnidadE',
      'MFuncion/GetFuncion',
      'DivisionFuncional/GetDivisionFuncionalId',
      'GrupoFuncional/GetGrupoFuncional',
      'FuenteFinanciamiento/get_FuenteFinanciamiento',
      'bancoproyectos/listar_rubro',
      'bancoproyectos/listar_rubro_pi',
      'TipologiaInversion/get_TipologiaInversion',
      'ProgramaPresupuestal/GetProgramaP',
      'bancoproyectos/listar_estado',
      'bancoproyectos/listar_provincia',
      'bancoproyectos/listar_distrito',
      'TipologiaInversion/get_tipo_no_pip',
      'bancoproyectos/AddModalidadEjecPI',
      'bancoproyectos/AddRurboPI',
      'bancoproyectos/AddEstadoCicloPI',
      'bancoproyectos/Add_ubigeo_proyecto',
      'bancoproyectos/AddProyectos',
      'EstadoCicloInversion/get_EstadoCicloInversion',
      'TipologiaInversion/get_NaturalezaInversion',
      'NivelGobierno/get_NivelGobierno',
      'UnidadE/GetUnidadE',
      'MFuncion/GetFuncion',
      'GrupoFuncional/GetGrupoFuncional',
      'FuenteFinanciamiento/get_FuenteFinanciamiento',
      'TipologiaInversion/get_TipologiaInversion',
      'ProgramaPresupuestal/GetProgramaP',
      'ModalidadEjecucion/GetModalidadE',
      'bancoproyectos/listar_estados',
      'bancoproyectos/listar_provincia',
      'bancoproyectos/listar_distrito',
      'Estudio_Inversion/get_UnidadFormuladora',
      'Meta/EditarMetaPresupuestal',
      'Meta/AddMeta',
      'meta/Eliminar_meta_prepuestal',
      'programar_nopip/AddProgramacion',
      'programar_nopip/AddMeta_PI',
      'programar_nopip/EliminarProgramacion',
      'programar_nopip/EliminarMetaPI',
      'programar_pip/GetAnioCartera',
      'MantenimientoBrecha/GetBrecha',
      'Meta/listar_correlativo',
      'Meta/listar_meta_presupuestal',
      'programar_pip/AddProgramacion_operacion_mantenimiento',
      'programar_pip/AddProgramacion',
      'programar_pip/AddMeta_PI',
      'programar_nopip/EliminarProgramacion',
      'programar_pip/Eliminar_meta_prepuestal_pi',
      'programar_pip/GetAnioCartera',
      'MantenimientoBrecha/GetBrecha',
      'programar_pip/GetAnioCartera',
      'MantenimientoBrecha/GetBrecha',
      'Meta/listar_correlativo',
      'Meta/listar_meta_presupuestal',
      'programar_pip/GetAnioCarteraProgramado',
      'Programacion/AddProgramacion',
      'Programacion/AddProgramacionOperManteni',
      'ServicioPublico/GetServicioAsociado',
      'Programacion/AddProgramacion',
      'CarteraInversion/GetCarteraInvFechAct',
      'Programacion/AddProgramacionTemp',
      'ProyectoInversion/GetProyectoInversionUltimo',
      'MantenimientoBrecha/GetBrecha',
      'CarteraInversion/GetCarteraInvFechAct',
      'ProyectoInversion/AddProyecto',
      'ProyectoInversion/listarProyecto',
      'Programacion/BuscarProyectoInversion',
      'criterio/addPrioridad',
      'programar_nopip/AddProgramacion',
      'programar_nopip/AddMeta_PI',
      'programar_nopip/EliminarProgramacion',
      'programar_nopip/EliminarMetaPI',
      'programar_pip/GetAnioCartera',
      'MantenimientoBrecha/GetBrecha',
      'Meta/listar_correlativo',
      'Meta/listar_meta_presupuestal',
      'criterio/addPrioridad',
      'programar_pip/AddProgramacion_operacion_mantenimiento',
      'programar_pip/AddProgramacion',
      'programar_pip/AddMeta_PI',
      'programar_nopip/EliminarProgramacion',
      'programar_pip/Eliminar_meta_prepuestal_pi',
      'programar_pip/GetAnioCartera',
      'MantenimientoBrecha/GetBrecha',
      'programar_pip/GetAnioCartera',
      'MantenimientoBrecha/GetBrecha',
      'Meta/listar_correlativo',
      'Meta/listar_meta_presupuestal',
      'EstadoCicloInversion/get_EstadoCicloInversion',
      'TipologiaInversion/get_TipologiaInversion',
      'TipologiaInversion/get_NaturalezaInversion',
      'NivelGobierno/get_NivelGobierno',
      'UnidadE/GetUnidadE',
      'MFuncion/GetFuncion',
      'FuenteFinanciamiento/get_FuenteFinanciamiento',
      'TipologiaInversion/get_TipoInversion',
      'GrupoFuncional/GetGrupoFuncionalId',
      'ProgramaPresupuestal/GetProgramaP',
      'ModalidadEjecucion/GetModalidadE',
      'DivisionFuncional/GetDivisioFuncuonaId',
      'MRubroEjecucion/GetRubroId',
      'ProyectoInversion/BuscarProyectoInversion',
      'MUbicacion/get_distritos',
      'MUbicacion/get_provincias',
      'MUbicacion/get_departamento',
      'Login/cerrar',
      'Usuario/AddUsuario',
      'Personal/ListarPersonal',
      'Usuario/ListarTipoUsuario',
      'Login/recuperarMenu/0',
      'Login/recuperarMenu/',
      'programar_nopip/Get_no_pip',
      'programar_pip/GetProyectosEjecucion',
      'programar_pip/GetProyectosFormulacionEvaluacion',
      'programar_pip/GetProyectosFuncionamiento',
      'bancoproyectos/GetProyectoInversion',
      'bancoproyectos/GetNOPIP',
      'CarteraInversion/GetCarteraInversion',
      'Programacion/GetProgramacion',
      'Programacion/GetProgramacionModificar',
      'PipProgramados/GetPipOperacionMantenimiento',
      'PipProgramados/ProyectoProgramadoEjecucion',
      'PipProgramados/reporteProgramacionPdf',
      'PipProgramados/GetPipProgramadosEjecucion',
      'PipProgramados/GetPipProgramadosFormulacionEvaluacion',
      'NoPipProgramados/GetNoPipProgramados',
      'programar_pip/GetAnioCarteraProgramado',
      'Indicador/GetIndicador',
      'Funcion/GetProvincia',
      'Funcion/GetListaFuncion',
      'Usuario/editUsuario',
      'Estudio_Inversion/get_EstudioInversion',
      'FEformulacion/GetFormulacion',
      'EvaluacionFE/GetEvaluacionFE',
      'FEformulacion/GetFEViabilizado',
      'TipEstudioFE/GetTipEstudioFE',
      'FEnivelEstudio/get_FEnivelEstudio',
      'EtapasFE/GetEtapasFE',
      'Entidad/GetEntidad',
      'MRubroEjecucion/GetRubroE',
      'UnidadF/GetUnidadF',
      'Personal/getcargo',
      'personal/GetPersonal',
      'meta/listar_meta',
      'Usuario/asignarProyecto',
      'Mo_MonitoreodeProyectos/EditarProducto',
      'Mo_MonitoreodeProyectos/InsertarProducto',
      'Mo_Actividad/eliminar',
      'Mo_MonitoreodeProyectos/eliminarProducto',
      'Mo_MonitoreodeProyectos/eliminarMonitoreo',
      'Expediente_Tecnico/verdetalle',  // Expediente_Tecnico/verdetalle?id=variable
      'ProyectoInversion/ReporteBuscadorPorPip',
      'Expediente_Tecnico/editar',
      'ET_Responsable/insertar',
      'ET_Responsable/eliminar',
      'ET_Responsable/asignarPersonal',
      'ET_Responsable/asignarFecha',
      'Expediente_Tecnico/vistoBueno',
      'ET_Componente/insertar',
      'ET_Tarea/index',
      'Expediente_Tecnico/valorizacionEjecucionProyecto',
      'Expediente_Tecnico/ResponsableExpediente',
      'Expediente_Tecnico/DocumentoExpediente',
      'Expediente_Tecnico/DetalleExpediente',
      'Expediente_Tecnico/ReporteEstadistico',
      'Expediente_Tecnico/reportePdfExpedienteTecnico',
      'Expediente_Tecnico/reportePdfPresupuestoFF05',
      'Expediente_Tecnico/reportePdfPresupuestoAnalitico',
      'Expediente_Tecnico/reportePdfMetrado',
      'Expediente_Tecnico/reportePdfAnalisisPrecioUnitarioFF11',
      'Expediente_Tecnico/reportePdfAnalisisUnitarioPorComponente',
      'Expediente_Tecnico/reportePdfValorizacionEjecucion',
      'criterio/getPrioridad',
      'RepositorioExpediente/index',
      'RepositorioExpediente/insertar',
      'RepositorioExpediente/mostrarCarpeta',
      'Expediente_Tecnico/InformeMensual',
      'Expediente_Tecnico/reportePdfInformeMensual',
      'Expediente_Tecnico/reportePdfValorizacionFisica',
      'Expediente_Tecnico/reportePdfValorizacionMayorMetrado',
      'Expediente_Tecnico/reportePdfEjecucion007',
      'Expediente_Tecnico/ejecucion',
      'Expediente_Tecnico/index',
      'Expediente_Tecnico/ControlMetrado',
      'Expediente_Tecnico/ValorizacionFisicaMetrado/(:num)/(:num)/(:num)',
      'Expediente_Tecnico/ValorizacionFisicaMetrado',
      'ET_Partida/insertar',
      'ET_Partida/eliminar',
      'ET_Partida/editarCambiosPartida',
      'ET_Meta/insertar',
      'ET_Meta/editarDescMeta',
      'ET_Meta/eliminar',
      'ET_Componente/editarDescComponente',
      'ET_Componente/eliminar',
      'ET_Analisis_Unitario/insertar',
      'ET_Analisis_Unitario/insertarCostoUnitario',
      'ET_Analisis_Unitario/insertarDetalleAnalisisUnitario',
      'ET_Analisis_Unitario/insertarinsumo',
      'ET_Analisis_Unitario/eliminar',
      'ET_Analisis_Unitario/actualizarAnalitico',
      'ET_Analisis_Unitario/cargarNivel',
      'ET_Clasificador/index',
      'ET_Clasificador/BuscarDetalleClasificador',
      'ET_Clasificador/insertar',
      'ET_Clasificador/editar',
      'ET_Clasificador/eliminar',
      'ET_Comentario/insertar',
      'ET_Comentario/eliminar',
      'ET_Detalle_Analisis_Unitario/insertar',
      'ET_Detalle_Analisis_Unitario/eliminar',
      'ET_Detalle_Formato/guardarDetalleFormato',
      'ET_Detalle_Formato/InformeMensual',
      'ET_Detalle_Formato/reportePdf',
      'ET_Detalle_Formato/guardarFotografia',
      'ET_Detalle_Formato/eliminarFotografia',
      'ET_Cronograma_Ejecucion/index',
      'ET_Cronograma_Ejecucion/cronograma',
      'ET_Cronograma_Ejecucion/insertar',
      'ET_Cronograma_Componente/insertar',
      'ET_Detalle_Formato/InformeMensual',
      'ET_Detalle_Partida/insertar',
      'ET_Documento_Ejecucion/insertar',
      'ET_Documento_Ejecucion/eliminar',
      'ET_Documento_Ejecucion/descargar',
      'ET_Especialista_Tarea/insertar',
      'ET_Especialista_Tarea/eliminar',
      'ET_Especialista_Tarea/asignarPersonal',
      'ET_Etapa_Ejecucion/insertar',
      'ET_Etapa_Ejecucion/index',
      'ET_Etapa_Ejecucion/editar',
      'ET_Img/eliminar',
      'ET_Insumo/verPorDescripcion',
      'ET_Levantamiento_Obs/editar',
      'ET_Levantamiento_Obs/insertar',
      'ET_Lista_Partida/verPorDescripcion',
      'ET_Mes_Valorizacion/insertar',
      'ET_Observacion_Tarea/eliminar',
      'ET_Observacion_Tarea/insertar',
      'ET_Per_Req/insertar',
      'ET_PER_REQ/insertar',
      'ET_Per_Req/eliminar',
      'ET_Per_Req/asignarPersonal',
      'ET_Per_Req/asignarQuitarCraet',
      'ET_Presupuesto_Analitico/insertar',
      'ET_Presupuesto_Analitico/eliminar',
      'ET_Presupuesto_Ejecucion/index',
      'ET_Presupuesto_Ejecucion/eliminar',
      'ET_Presupuesto_Ejecucion/insertar',
      'ET_Presupuesto_Ejecucion/insertarPresupuesto',
      'ET_Presupuesto_Ejecucion/editar',
      'ET_Recurso/index',
      'ET_Recurso/eliminar',
      'ET_Recurso/insertar',
      'ET_Recurso/editar',
      'ET_Responsable_Tarea/asignar',
      'ET_Tarea/index',
      'ET_Tarea/insertarBloque',
      'ET_Tarea/administrarDetalleETTarea',
      'ET_Tarea_Observacion/insertar',
      'ET_Tarea_Observacion/eliminar',
      'ET_Tarea_Observacion/levantarObservacion',
      'ET_Tarea_Observacion/eliminarLevantamientoObservacion',
      'ET_Tipo_Gasto/insertar',
      'ET_Tipo_Gasto/editar',
      'ET_Tipo_Gasto/index',
      'ET_Tipo_Responsable/insertar',
      'ET_Tipo_Responsable/editar',
      'ET_Tipo_Responsable/index',
      'ET_Maquinaria/index',
      'ET_Maquinaria/insertar',
      'ET_Maquinaria/eliminar',
      'ET_Maquinaria/editar',
      'ET_Maquinaria/reportePdf',
      'ET_Ejecucion_Maquinaria/index',
      'ET_Ejecucion_Maquinaria/insertar',
      'ET_Ejecucion_Maquinaria/eliminar',
      'ET_Consumo_Maquinaria/index',
      'ET_Consumo_Maquinaria/insertar',
      'ET_Consumo_Maquinaria/eliminar',
      'ET_Consumo_Maquinaria/reportePdf',
      'ET_Almacen/index',
      'PrincipalReportes/DetalleAnalitico',
      'PrincipalReportes/DetalleClasificador',
      'PrincipalReportes/DetalleMensualizado',
      'PrincipalReportes/DetalleMensualizadoFuenteFinan',
      'PrincipalReportes/detalladoMensualizadoConceptoClasificador',
      'PrincipalReportes/detallePedidoCompraMeta',
      'PrincipalReportes/detallePorCadaPedido',
      'PrincipalReportes/ReporteEjecucionFinanciera',
      'CarteraInversion/editarCartera',
      'CarteraInversion/itemCartera',
      'NoPipProgramados/insertar',
      'NoPipProgramados/editar',
      'PrincipalReportes/detalleOrdenExpSiaf',
      'PrincipalReportes/detallePorCadaNumOrden',
      'FEformulacion/Feformulacion',
      'EvaluacionFE/FeEvaluacion',
      'FEformulacion/FeAprobado',
      'FEformulacion/FeViabilizado',
      'Estudio_Inversion/get_etapas_estudio',
      'Estudio_Inversion/get_estado_PI',
      'programar_pip/listar_programacion',
      'programar_pip/listar_programacion_operacion_mantenimiento',
      'programar_nopip/listar_metas_pi',
      'PmiCriterioG/insertar',
      'PmiCriterioG/criterioFuncion',
      'PmiCriterioG/editar',
      'PmiCriterioG/eliminar',
      'PmiCriterioEspecifico/index',
      'PmiCriterioEspecifico/editar',
      'PmiCriterioEspecifico/eliminar',
      'PuntajeCriterioPi/index',
      'PuntajeCriterioPi/insertar',
      'FEestado/EliminarFEestado',
      'ET_Tarea/insertarBloque',
      'FEentregableEstudio/ver_FEentregable',
      'Unidad_Medida/editar',
      'Unidad_Medida/insertar',
      'FE_Presupuesto_Inv/index',
      'FE_Presupuesto_Inv/reportePdfDetalleGasto',
      'FE_Presupuesto_Inv/insertar',
      'FE_Presupuesto_Inv/verDetalle',
      'FE_Presupuesto_Inv/editar',
      'FE_Detalle_Presupuesto/insertar',
      'ET_Per_Req/asignarPersonal',
      'ET_Per_Req/eliminar',
      'ET_Per_Req/insertar',
      'ET_Componente/editarDescComponente',
      'ET_Meta/insertar',
      'ET_Componente/eliminar',
      'ET_Componente/cargarSelectSubPresupuesto',
      'ET_Componente/cargarMetaS10',
      'ET_Meta/editarDescMeta',
      'ET_Meta/eliminar',
      'ET_Partida/insertar',
      'Usuario/addUsuario',
      'Usuario/validateUsername',
      'FEestado/EliminarEstado',
      'FEnivelEstudio/EliminarNivelEstudios',
      'FEsituacion/EliminarSituacion',
      'EtapasFE/EliminarEtapa',
      'Personal/EliminarCargo',
      'Gerencia/EliminarGerencia',
      'SubGerencia/EliminarSubGerencia',
      'Oficina/EliminarOficina',
      'Meta/EditarMeta',
      'ReporteProgramacion/action',
      'EstadoEtapa_FE/GetEstadoEtapa_FE',
      'programar_nopip/listar_programacion',
      'criterio/itemPrioridad',
      'bancoproyectos/verificarProyectoCodigoUnico',
      'bancoproyectos/BuscarProyectoCodigoUnico2nopip',
      'Tipo_Gasto_FE/insertar',
      'Tipo_Gasto_FE/editar',
      'Tipo_Gasto_FE/eliminar',
      'Modulo_FE/insertar',
      'Modulo_FE/editar',
      'Modulo_FE/eliminar',
      'CronogramaValorizacion/insertar',
      'CronogramaValorizacion/editar',
      'Personal/BuscarPersonaActividad',
      'FEentregableEstudio/get_Entregables',
      'FEActividadEntregable/get_Actividades',
      'FEentregableEstudio/get_ResponsableEntregableE',
      'DenominacionFE/EliminarD',
      'Unidad_Medida/eliminar',
      'ModalidadEjecucion/Eliminar',
      'UnidadE/Eliminar',
      'UnidadF/Eliminar',
      'Usuario/VerificarNombreUsuario',
      'Unidad_Medida/listaUnidadMedida',
      'CronogramaValorizacion/Eliminar',
      'ET_Etapa_Ejecucion/Editar',
      'ET_Etapa_Ejecucion/eliminar',
      'Usuario/ListarUnidadEjecutora',
      'PuntajeCriterioPi/eliminarPuntajecriterio',
      'bancoproyectos/eliminarEstadoCiclo',
      'bancoproyectos/eliminarrubroPI',
      'bancoproyectos/eliminarOperacionMantenimiento',
      'Usuario/addTipoUsuario',
      'Usuario/updateTipoUsuario',
      'Usuario/deleteTipoUsuario',
      'Elfinder_lib/manager',
      'Elfinder_lib/connector',
      'elfiles/elfinder_init',
      'elfiles/elfinder_files',
      'Especialidad/ListarEspecialidad',
      'Especialidad/addEspecialidad',
      'Especialidad/updateEspecialidad',
      'Especialidad/deleteEspecialidad',
      'Preliquidacion/index',
      'Liquidacion/listar_liquidacion',
      'Liquidacion/AddLiquidacion',
      'Liquidacion/Eliminar_liquidacion',
      'Liquidacion/editarLiquidacion',
      'Preliquidacion/insertar',
      'Preliquidacion/verdetalle',
      'Preliquidacion/eliminar',
      'Liquidacion/Products',
      'Preliquidacion/editar',
      'Repositorio_Preliquidacion/elfinder_files',
      'Repositorio_Preliquidacion/elfinder_init',
      'PreLiquidacion/ReporteEstadistico',
      'PrincipalReportes/estadoPedido',
      'Personal/verifyPersonalByDNI',
      'Expediente_Tecnico/insertActaEntregaTerreno',
      'Expediente_Tecnico/listarBds10',
      'Expediente_Tecnico/HojaPresupuesto',
      'Expediente_Tecnico/ImprimirReporte',
      'Expediente_Tecnico/costoUnitario',
      'EstadoPedido/register',
      'PrincipalReportes/estadoPedidoShow',
      'EstadoPedido/historialPedidoEstado',
      'ProyectoInversion/addConformidad',
      'ProyectoInversion/editar',
      'ProyectoInversion/insertar',
      'ProyectoInversion/inversionOARR',
      'ProyectoInversion/inversionOARReditar',
      'PMI_RubroPi/insertar',
      'PMI_RubroPi/eliminar',
      'PMI_RubroPi/ListaRubroProyecto',
      'PMI_ModalidadPi/insertar',
      'PMI_ModalidadPi/eliminar',
      'PMI_ModalidadPi/ListaModalidadProyecto',
      'PMI_MetaPresupuestalPi/insertar',
      'PMI_MetaPresupuestalPi/eliminar',
      'PMI_MetaPresupuestalPi/ListaMetaProyecto',
      'PMI_MetaPresupuestalPi/editar',
      'PMI_EstadoPi/insertar',
      'PMI_EstadoPi/eliminar',
      'PMI_EstadoPi/ListaEstadoProyecto',
      'PMI_OperacionMantenimientoPi/insertar',
      'PMI_OperacionMantenimientoPi/eliminar',
      'PMI_OperacionMantenimientoPi/ListaOperacionMantenimiento',
      'PrincipalReportes/conformidadPedido',
      'ProyectoInversion/updateConformidad',
      'PrincipalReportes/ordenServicio',
      'PrincipalReportes/RestoreDB',
      'PrincipalReportes/ImportarTableS10',
      'PrincipalReportes/DeleteDB',
      'ProyectoInversion/addOrdenServicio',
      'ProyectoInversion/updateOrdenServicio',
      'Expediente_Tecnico/formatoFE11',
      'Expediente_Tecnico/formatoFE12',
      'Expediente_Tecnico/formatoFE13',
      'Expediente_Tecnico/formatoFE14',
      'Expediente_Tecnico/formatoFE15',
      'Expediente_Tecnico/formatoFE16',
	  'ProyectoInversion/ReportePipPedidos',
	  'ProyectoInversion/ReportePipOrdenesGeneral',
    'Gerencia/GetListaGerencia',
    'Gerencia/GetGerenciaId',
    'Oficina/cargarMeta',
    'Oficina/listar_metas_oficina',
    'SubGerencia/GetSubGerenciaId',
    'Oficina/GetOficinaId',
    'Oficina/insertarMeta',
    'Oficina/eliminarMeta',
    'SubGerencia/insertarMeta', //desde aqui verificar
    'Gerencia/insertarMeta',
    'Gerencia/listarMeta',
    'SubGerencia/listarMeta',
    'SubGerencia/cargarMeta',
    'Gerencia/cargarMeta',
    'Gerencia/listar_metas_gerencia',
    'SubGerencia/listar_metas_subgerencia',
    'Gerencia/eliminarMeta',
    'SubGerencia/eliminarMeta',
    'Gerencia/getItem',
    'OficinaR/cargarNivel',
    'OficinaR/EliminarOficinaR',
    'OficinaR/UpdateOficinaR',
    'OficinaR/InsertarOficinaR',
    'OficinaR/insertarMeta',
    'OficinaR/listar_metas_oficina',
    'OficinaR/eliminarMeta',
    'OficinaR/listarMeta',
    'OficinaR/cargarMeta',
    'OficinaR/ListaNivel1',
    'Gerencia/UpdateOficinaR',
    'ProyectoInversion/ReportePorOficina',
    'ProyectoInversion/proyectosPorOficina',
    'ProyectoInversion/detalladoProyectoInversion'
    
  );
    foreach( $lista_API as $value ) {
      array_push($arrayPermitido, $value);
    }

    if(in_array($url, $arrayPermitido))
    {
        return true;
    }
    else
    {
        return false;
    }
}
