<style>
    #table-ProyectoInversionProgramado > tbody > tr > td
    {
        vertical-align: middle;
    }
    #table_proyectos_inversion>tbody>tr>td:nth-child(0n+4)
    {
        text-align: right;
    }
    #Table_OperacionMantenimiento>tbody>tr>td:nth-child(0n+1)
    {
        text-align: right;
    }
    #Table_OperacionMantenimiento>tbody>tr>td:nth-child(0n+3)
    {
        text-align: right;
    }
    .all 
    {
      margin-bottom: 0;
      margin-right: 0;
      width: 100%;
    }
</style>
<style>
  .dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    left: 100%;

}
.dropdown:hover {
}
.trElement li
{
  list-style:none;
   border: 1px solid #D8D8D8;
   padding-top: 6px;
   padding-left: 5px;
  padding-bottom: 5px;
  background-color: #F2F2F2;
}
.trElement li:hover {
  background: #fdfdfd;
}
/*.trElement li ul li:hover {
  background: #F2F2F2;
}
.trElement li ul li{
 background-color: #f9f8f8;
}
.trElement li ul li ul li{
 background-color: #F2F2F2;
}
.trElement li ul li ul li ul li{
 background-color: #f9f8f8;
}*/
.nivel2 li{
   background-color: #f9f8f8; 
}
.nivel
{
  color: #73879C;
    font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
    font-size: 12px;
    font-weight: 400;
    line-height: 1.471;
 
}
 .all 
    {
      margin-bottom: 0;
      margin-right: 0;
      width: 100%;
    }
    ul{
  padding-left: 10px;
  padding-top: 0px;
  padding-bottom: 0px;

 }
 .btnm{
    padding-top: 1px;
    border-top-width: 0px;
    border-bottom-width: 0px;
    padding-bottom: 1px;
    font-size: 11px;

 }
 .btnf{
    padding-right: 2px;
    padding-left: 2px;
    background-color: transparent;
 }


</style>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
        </div>
        <div class="clearfix"></div>
        <div class="">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>BANCO DE INVERSIONES</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-7">
                                <button style="margin-top: 5px;margin-bottom: 15px;" type="button" class="btn btn-primary" onclick="agregarProyectoInversion();"><span class="fa fa-plus-circle"></span> Nuevo </button>
                            </div>
                            <?php if($this->session->userdata('tipoUsuario')==9 || $this->session->userdata('tipoUsuario')==1 ) {?>
                            <div id="validarActualizarSiaf">
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input style="margin-top: 5px;margin-bottom: 15px;" type="text" name="txtAnioActualizarSiaf" id="txtAnioActualizarSiaf" class="form-control" value="<?=date('Y')?>">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <select style="margin-top: 5px;margin-bottom: 15px;" type="text" name="selectUnidadEjecutora" id="selectUnidadEjecutora" class="form-control">
                                        <?php foreach ($unidadEjecutora as $key => $value) { ?>
                                            <option value="<?=$value->id_ue?>" data-id_ue="<?=$value->id_ue?>"><?=$value->codigo_ue?> - <?=$value->nombre_ue?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                           <div class="col-md-1 col-sm-6 col-xs-12">
                                <button id="btnActualizarSiaf" name="btnActualizarSiaf" onclick="ImportarProyectosSiaf();" style="float: right;margin-top: 5px;margin-bottom: 15px;" type="button" class="btn btn-warning"><span class="fa fa-refresh"></span> SIAF</button>
                            </div>
                            <!-- <div class="col-md-1 col-sm-6 col-xs-12">
                                <button id="btnFiltrar" name="btnFiltrar" onclick="filtrarProyectoInversion();" style="float: right;margin-top: 5px;margin-bottom: 15px;" type="button" class="btn btn-warning"><span class="fa fa-refresh"></span> Cargar PIDE</button>
                            </div> -->
                            <?php } ?>
                        </div>
                        <!---combos para listar proyectos-->

           
                 <!---fin combos para listar proyectos-->

                 <ul class="nav nav-tabs" role="tablist">
                            <li class="active">
                                <a href="#home" role="tab" data-toggle="tab">
                                    <icon class="fa fa-home"></icon> 
                                </a>
                            </li>
                            <li><a href="#profile" role="tab" data-toggle="tab">
                                <i class="fa fa-refresh"></i> CARGAR SIAF
                                </a>
                            </li>
                    
                    </ul><br>
                      <div class="tab-content">
                        <div class="tab-pane fade active in" id="home">
                            <div class="table-responsive">
                                <table id="table_proyectos_inversion" class="table table-striped table-bordered jambo_table bulk_action  table-hover" cellspacing="0" width="100%" >
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">#</th>
                                            <th style="width: 8%"><i class="fa fa-thumb-tack"></i> Cod. </th>
                                            <th style="width: 36%"><i class="fa fa-bookmark-o"></i> Nombre</th>
                                            <th style="width: 12%; text-align: right;"><i class="fa fa-money"></i> Costo</th>
                                            <th style="width: 12%"> Estado Ciclo</th>
                                            <th style="width: 12%"> Fecha Viabilidad</th>
                                            <th style="width: 16%">Opción</th>
                                            <!--<th rowspan="2" style="width: 1%"> </th>
                                            <th rowspan="2" style="width: 8%"> Cod.</th>
                                            <th rowspan="2" style="width: 36%"> Nombre</th>
                                            <th rowspan="2" style="width: 8%"> Tipo</th>
                                            <th rowspan="2" style="width: 8%"> Prioridad</th>
                                            <th rowspan="2" style="width: 8%"> Orden</th>
                                            <th rowspan="2" style="width: 8%"> Sector</th>
                                            <th rowspan="2" style="width: 8%"> OPMI</th>
                                            <th rowspan="2" style="width: 8%"> Nivel</th>
                                            <th rowspan="2" style="width: 12%; text-align: right;"> Costo (S/)</th>
                                            <th rowspan="2" style="width: 12%">Devengado acumulado (S/)</th>
                                            <th rowspan="2" style="width: 12%">PIM 2022 (S/)</th>
                                            <th colspan="4" style="width: 12%"> Programación del monto de inversión (S/)</th>-->
                                        </tr>
                                        <!--<tr>
                                            <th style="width: 8%"> Monto 2022 (S/)</th>
                                            <th style="width: 8%"> Monto 2023 (S/)</th>
                                            <th style="width: 8%"> Monto 2024 (S/)</th>
                                            <th style="width: 8%"> Monto 2025 (S/)</th>
                                        </tr>-->
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile">
                            <div class="table-responsive">
                                        <table id="table_proyectos_inversion" class="table table-striped table-bordered jambo_table bulk_action  table-hover" cellspacing="0" width="100%" >
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" style="width: 1%"> Nombre.</th>
                                                    <th rowspan="2" style="width: 1%"> Año eje.</th>
                                                    <th rowspan="2" style="width: 2%"> sec_ejec.</th>
                                                    <th rowspan="2" style="width: 2%"> funcion.</th>
                                                    <th rowspan="2" style="width: 2%"> Act_proy.</th>
                                                    <th rowspan="2" style="width: 2%"> Meta.</th>
                                                    <th rowspan="2" style="width: 2%"> Finalidad.</th>
                                                    <th rowspan="2" style="width: 2%"> Monto.</th>
                                                    <th rowspan="2" style="width: 2%"> Cantidad.</th>
                                                    <th rowspan="2" style="width: 2%"> Pia</th>
                                                    <th rowspan="2" style="width: 2%"> Cantidad semestral</th>
                                                    <th rowspan="2" style="width: 2%"> Cantidad semestral inicial</th>
                                                    <th rowspan="2" style="width: 2%"> Estrategia nacional</th>
                                                    <th rowspan="2" style="width: 2%"> Estado</th>
                                                    <th rowspan="2" style="width: 2%"> Ambito</th>
                                                
                                                
                                            </thead>
                                            <tbody>
                                                <?php foreach ($listarSiaf as $item) { ?>
                                                
                                            
                                                <tr>
                                                    <td><?=$item->nombre?></td>
                                                    <td><?=$item->ano_eje?></td>
                                                    <td><?=$item->sec_ejec?></td>
                                                    <td><?=$item->funcion?></td>
                                                    <td><?=$item->act_proy?></td>
                                                    <td><?=$item->meta?></td>
                                                    <td><?=$item->finalidad?></td>
                                                    <td><?=$item->monto?></td>
                                                    <td><?=$item->cantidad?></td>
                                                    <td><?=$item->es_pia?></td>
                                                    <td><?=$item->cantidad_semestral?></td>
                                                    <td><?=$item->cantidad_semestral_inicial?></td>
                                                    <td><?=$item->estrategia_nacional?></td>
                                                    <td><?=$item->estado?></td>
                                                    <td><?=$item->ambito?></td>
                                                                    
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="modal" id="modal_vista_PIPs" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-jidden="true"></span>Proyectos de inversion</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_vistaPIPs">
                    <div class="table-responsive">
                            <table id="table_PIPs_filtro" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%" >
                                <thead>
                                    <tr>
                                        <th style="width: 1%">#</th>
                                        <th style="width: 8%"><i class="fa fa-thumb-tack"></i> Cod. </th>
                                        <th style="width: 36%"><i class="fa fa-bookmark-o"></i> Nombre</th>
                                        <th style="width: 12%; text-align: right;"><i class="fa fa-money"></i> Costo</th>
                                        <th style="width: 12%"> Estado Ciclo</th>
                                        <th style="width: 12%"> Fecha Viabilidad</th>
                                        <th style="width: 16%">Opción</th>
                                        <!--<th style="width: 1%">#</th>
                                        <th style="width: 8%"> Cod.</th>
                                        <th style="width: 36%"> Nombre</th>
                                        <th style="width: 8%"> Tipo</th>
                                        <th style="width: 8%"> Prioridad</th>
                                        <th style="width: 8%"> Orden</th>
                                        <th style="width: 8%"> Sector</th>
                                        <th style="width: 8%"> OPMI</th>
                                        <th style="width: 8%"> Nivel</th>
                                        <th style="width: 12%; text-align: right;"> Costo (S/)</th>
                                        <th style="width: 12%">Devengado acumulado (S/)</th>
                                        <th style="width: 12%">PIM 2022 (S/)</th>
                                        <th style="width: 12%">Programación Inversión (S/)</th>-->
                                    </tr>
                                </thead>
                            </table>
                        </div>
                </form>
            </div>
        </div>        
    </div>
</div>
<div class="modal fade" id="venta_ubicacion_geografica" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Ubicación Geográfica </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_AddUbigeo">
                    <input id="txt_id_pip" name="txt_id_pip" required="required" type="hidden">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <label for="name">Proyecto:</label>
                            <textarea class="form-control" rows="2" readonly="readonly" id="nombreProyecto" name="nombreProyecto"></textarea>
                        </div>   
                    </div>                         
                    <br>
                    <div class="row" id="validarUbigeoPiPip">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <select class="selectpicker form-control" disabled="disabled">
                                <option value="Apurímac">Apurímac</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <select  id="cbx_provincia" name="cbx_provincia" class="selectpicker form-control" title="Elija provincia(s)">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <select name="cbx_distrito" id="cbx_distrito" data-live-search="true"  class="selectpicker form-control" title="Elija distrito"></select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input id="txt_latitud" name="txt_latitud"  class="form-control" placeholder="Latitud" type="text">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input id="txt_longitud" name="txt_longitud"  class="form-control" placeholder="Longitud"  type="text">
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                            <input type="file" class="form-control" name="ImgUbicacion" id="ImgUbicacion" accept=".png, .jpg, .jpeg">
                            <p style="color: red; display: block;" id="Advertencia">Solo se aceptan archivos en formato JPG y PNG</p>
                        </div>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                            <input class="btn btn-success" onclick="agregarUbigeoPi();" type="button" value="Agregar">                         
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <label for="name">Mapa:</label>
                            <div>
                                <div id="gmap"></div>
                            </div>
                            <br>                            
                        </div>
                    </div>                    
                    <div class="x_panel" style="border: 1px solid #EEEEEE;">
                        <table id="TableUbigeoProyecto_x" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%" >
                            <thead >
                                <tr>
                                    <th style="width: 20%" >Provincia</th>
                                    <th style="width: 20%" >Distrito</th>
                                    <th style="width: 20%" >Latitud</th>
                                    <th style="width: 20%" >Longitud</th>
                                    <th style="width: 10%" >Imagen</th>
                                    <th style="width: 50%" ></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <center>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  class="btn btn-danger" data-dismiss="modal">
                                <span class="glyphicon glyphicon-log-out"></span>
                                Cerrar
                                </button>
                            </div>
                        </div>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>


<!--Modal Meta Oficina-->
<div class="modal fade" id="VentanaMetaOficina" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Asignar Meta - Oficina</h4>
            </div>
     <div class="modal-body">
     <div class="row">
     <div class="col-xs-12">
     <div id="validarMetaOficina">
    <form class="form-horizontal" id="form-MetaOficina">
        <input id="txt_id_oficina" name="txt_id_oficina"  readonly="readonly" autocomplete="off"  type="hidden">
           <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
                <label class="control-label">Oficina:</label>
                <div>
                    <input id="txt_oficina" name="txt_oficina" class="form-control" readonly="readonly" required="required" type="text" >
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Año:</label>
                <div>
                    <input type="text" value="<?=date('Y')?>" id="txtAniometa" name="txtAniometa" autocomplete="off" class="form-control" maxlenght="4">
                </div>
            </div>
            <div class="col-md-1 col-sm-6 col-xs-12">
                <label class="control-label">.</label>
                <div>
                     <button  type="button" class="btn btn-info" onclick="cargarComboMetaSiaf();">
                        <span class="glyphicon glyphicon-search"></span>
                     </button>
                </div>
            </div> 
           </div>  
           <div class="row">
            <input id="txt_ue" name="txt_ue"  autocomplete="off"  type="hidden">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <label class="control-label">Sec Func*</label>
                <div class="form-group">
                    <select class="selectpicker form-control" id="listarMetaO" name="listarMetaO" data-live-search="true">
                        <option value="">Seleccione una opción</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <label class="control-label">Unidad Ejecutora:</label>
                <div>
                    <input id="txt_unidad_ejecutora" name="txt_unidad_ejecutora" class="form-control" readonly="readonly" required="required" type="text" >
                </div>
            </div>
            

        </div>
        <div class="row">
             <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Funcion:</label>
                <div>
                    <input type="text" name="txt_funcion" autocomplete="off" class="form-control " id="txt_funcion" >
                </div>
            </div> 
            <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Programa:</label>
                <div>
                    <input type="text" name="txt_programa" autocomplete="off" id= "txt_programa" class="form-control" maxlength="3">
                </div>  
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Sub Programa:</label>
                <div>
                    <input type="text" name="txt_sub_programa" id= "txt_sub_programa" autocomplete="off" class="form-control" maxlenght="4">
                </div>  
            </div>  
            <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Componente:</label>
                <div>
                    <input type="text" name="txt_componente" autocomplete="off" class="form-control" id="txt_componente" maxlength="7">
                </div>
            </div>  
             <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Meta:</label>
                <div>
                    <input type="text" name="txt_meta" id= "txt_meta" class="form-control" autocomplete="off" maxlength="5">
                </div>  
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Finalidad:</label>
                <div>
                    <input type="text" name="txt_finalidad" class="form-control" id="txt_finalidad" autocomplete="off" maxlength="7">
                </div>
            </div>    
        </div>
        <div class="row">
          <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Act Proy:</label>
                <div>
                    <input type="text" name="txt_act_proy" id= "txt_act_proy" autocomplete="off" class="form-control" maxlenght="7">
                </div>  
            </div>
            <div class="col-md-8 col-sm-3 col-xs-12">
                <label class="control-label">Proyecto:</label>
                <div>
                    <input type="text" name="txt_nombre_proyecto" id= "txt_nombre_proyecto" autocomplete="off" class="form-control" id="txt_nombre_meta">
                </div>
            </div>   
            <div class="col-md-2 col-sm-6 col-xs-12">
                <label>.</label>
                <div>
                    <input style="width:100%" type="button" class="btn btn-success" onclick="guardarMetaOficina();" value="Guardar">
                </div>
            </div>           
        </div>
    </form>
    <div class="ln_solid"></div>
    <div class="table-responsive">
    <table id="tablaMetaOficina" class="table table-bordered table-striped tablaGenerica" style="width:100%;">
            <thead>
                <tr>
                    <th>Sec Func</th>
                    <th>Finalidad</th>
                    <th>Act Proy</th>
                    <th>Proyecto</th>
                    <th>Opción</th>
                </tr>
            </thead>
        </table>
    </div>              
</div>
<div class="row" style="text-align: right;">
    <button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<script>
    function initialize() 
    {
        var myLatlng = new google.maps.LatLng(-13.637,-72.878);
        var myOptions = 
        {
            zoom:7,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("gmap"), myOptions);
        marker = new google.maps.Marker({
            position: myLatlng,
            map: map
        });

        google.maps.event.addListener(map, "click", function(event) 
        {
            var clickLat = event.latLng.lat();
            var clickLon = event.latLng.lng();
            document.getElementById("txt_latitud").value = clickLat.toFixed(5);
            document.getElementById("txt_longitud").value = clickLon.toFixed(5);
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(clickLat,clickLon),
                map: map
            });
        });
    }

    window.onload = function () 
    {
    };
</script>
<style>
   div#gmap 
    {
        width: 100%;
        height: 300px;
    }
</style>

<script>
    function agregarProyectoInversion()
    {
        paginaAjaxDialogo(null, 'Registrar Proyecto de Inversión', null, base_url+'index.php/ProyectoInversion/insertar', 'GET', null, null, false, true);
    }
    function filtrarProyectoInversion()
    {
        var idUnidadEjecutora = $("#selectUnidadEjecutora").val();
        //var idGerencia = $("#selectGerencia").val();
        //var idSubGerencia = $("#selectSubGerencia").val();
        //var idOficina = $("#selectOficina").val();
        var anio = $('#txtAnioActualizarSiaf').val();
       // filtrarProyectoInversion1(idUnidadEjecutora,idGerencia,idSubGerencia,idOficina,anio);
    }

    function ImportarProyectosSiaf()
    {
        event.preventDefault();
        $('#validarActualizarSiaf').data('formValidation').validate();
        if(!($('#validarActualizarSiaf').data('formValidation').isValid()))
        {
            return;
        }
        var idUnidadEjecutora = $("#selectUnidadEjecutora").val();
        var anio = $('#txtAnioActualizarSiaf').val();
        $.ajax({
            type:"POST",
            url:base_url+'index.php/bancoproyectos/insertarProyectosSiaf',
            data:{idUnidadEjecutora:idUnidadEjecutora,anio:anio},
            cache: false,
            beforeSend: function()
            {
                renderLoading();
            },
            success:function(resp)
            {
                window.location.href=base_url+"index.php/bancoproyectos/";
            }
        });
    }

    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
    });

    $(function()
    {
        $('#validarMetaOficina').formValidation(
      {
          framework: 'bootstrap',
          excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
          live: 'enabled',
          message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
          trigger: null,
          fields:
          {
              txtAniometa:
              {
                  validators:
                  {
                      notEmpty:
                      {
                          message: '<b style="color: red;">El campo es requerido.</b>'
                      }
                  }
              },
              listarMetaO:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo es requerido.</b>'
                        }
                    }
                }
          }
      });
        $('#validarUbigeoPiPip').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields: 
            {
                cbx_provincia: 
                {
                    validators: 
                    {
                        notEmpty: 
                        {
                            message: '<b style="color: red;">Selecciones una Opción.</b>'
                        }
                    }
                },
                cbx_distrito: 
                {
                    validators: 
                    {
                        notEmpty: 
                        {
                            message: '<b style="color: red;">Selecciones una Opción.</b>'
                        }
                    }
                }
            }
        });

        $('#validarCicloPI').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields: 
            {
                Cbx_EstadoCiclo: 
                {
                    validators: 
                    {
                        notEmpty: 
                        {
                            message: '<b style="color: red;">Selecciones una Opción.</b>'
                        }
                    }
                }
            }
        });

        $('#validarActualizarSiaf').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields:
            {
                txtAnioActualizarSiaf:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Año" es requerido.</b>'
                        }
                    }
                }
            }
        });
    });

</script>
<script>
    
function MostrarSubLista(id_oficina,element)
{
  $.ajax(
  {
    type: "POST",
    url: base_url+"index.php/OficinaR/cargarNivel",
    cache: false,
    data: { id_oficina: id_oficina},
    success: function(resp)
    {
      var obj=JSON.parse(resp);

      if(obj.length==0)
      {
        return false;
      }
      var htmlTemp='<ul>';
      for(var i=0; i<obj.length; i++)
      {
        if(obj[i].hasChild == false)
        {
          htmlTemp+='<li>'+
          '<i  class="elegir btn-xs fa" style="margin-right: 10px;"></i>'+
          '<span class="nivel">'+obj[i].denom_oficina+'</span>'+
         '<div class="btn-group pull-right"><button type="button" class="btn btnm btn-primary btn-xs all pull-right" data-toggle="modal" data-target="#modal_vista_PIPs" data-id=\''+obj[i].id_oficina+'\' data-denom=\''+obj[i].denom_oficina+ '\'><i class="ace-icon fa fa-list-alt bigger-120"></i> Mostrar</button></div>'+
         '<div class="btn-group pull-right">   <button type="button" class="meta btn btnm btn-success btn-xs all pull-right" data-toggle="modal" data-target="#VentanaMetaOficina" data-id=\''+obj[i].id_oficina+'\' data-denom=\''+obj[i].denom_oficina+ '\'><i class="ace-icon fa fa-pencil bigger-120"></i> Meta</button> </div> '+
          '</li>';
        }
        else
        {
        htmlTemp+='<li>'+
        '<button type="button" class="btn btnf btn-xs fa fa-chevron-right" value="+" onclick="elegirAccion(\''+obj[i].id_oficina+'\', this);"></button>'+

        '<span class="nivel">'+obj[i].denom_oficina+'</span>'+
         '<div class="btn-group pull-right"><button type="button" class="btn btn-primary btnm btn-xs all pull-right" data-toggle="modal" data-target="#modal_vista_PIPs" data-id=\''+obj[i].id_oficina+'\' data-denom=\''+obj[i].denom_oficina+ '\'><i class="ace-icon fa fa-list-alt bigger-120"></i> Mostrar</button></div>'+
          '<div class="btn-group pull-right">   <button type="button" class="meta btnm btn btn-success btn-xs all pull-right" data-toggle="modal" data-target="#VentanaMetaOficina" data-id=\''+obj[i].id_oficina+'\'  data-denom=\''+obj[i].denom_oficina+ '\'><i class="ace-icon fa fa-pencil bigger-120"></i> Meta</button> </div> '+
        '</li>';
        }       
      }

      htmlTemp+='</ul>';
      $(element).parent().append(htmlTemp);                                         
    }
  });
}
function ContraerSubLista(element)
{
  $(element).parent().find('>ul').remove();
}
function elegirAccion(id_oficina, element)
{
  var valueButton =  $(element).attr('value');
  var clase=$(element).attr('class');
  if(valueButton == '+')
  {
    MostrarSubLista(id_oficina,element);
    $(element).attr('value','-');
    $(element).attr('class','btn btnf btn-xs fa fa-chevron-down');
  }
  else
  {
    ContraerSubLista(element);
    $(element).attr('value','+');
    $(element).attr('class','btn btnf btn-xs fa fa-chevron-right');
  }
   
}
function mostrarDeRaizPIP(codigo)
{
    paginaAjaxDialogo(null, 'Proyectos de Inver', {codigo: codigo}, base_url+'index.php/ProyectoInversion/editar', 'GET', null, null, false, true);
}

var filtrarPIPs = function(idUnidadEjecutora,OficinaR,anio) 
{
    var table = $("#table_PIPs_filtro").DataTable({
    "processing": true,
    "serverSide": false,
    destroy: true,
    "ajax": 
    {
        url: base_url + "index.php/bancoproyectos/filtrarProyectoInversion",
        type: "POST",
         data:{"idUnidadEjecutora":idUnidadEjecutora,
                "idOficina":idOficina,
                "anio":anio },
        "dataSrc":"",
    },
    "columns": [
       {"data": function (data, type) 
            {
                return "<a onclick='editarProyectoInversion("+data.id_pi+")'  class='btn btn-primary btn-xs'><i class='fa fa-edit' aria-hidden='true'></i></a>"
            }
        }, 
        { "data": "id_pi", "visible": false }, 
        { "data": "codigo_unico_pi" },
        { "data": "nombre_pi" }, 
        { "data": "costo_pi" }, 
        { "data": "nombre_estado_ciclo" }, 
        { "data": "fecha_viabilidad_pi" }, 
        { "data": function (data, type) 
            {
                return "<div class='btn-group'><button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button' aria-expanded='false'>Opciones <span class='caret'>"+
                "</span></button><ul class='dropdown-menu'>"+
                "<li><button type='button' class='ubicacion_geografica btn btn-primary btn-xs all' data-toggle='modal' data-target='#venta_ubicacion_geografica'><i class='fa fa-map-marker' aria-hidden='true'></i> Ubicación</button></li>"+
                "<li><button type='button' onclick='agregarRubro("+data.id_pi+")' class='btn btn-info btn-xs all' ><i class='fa fa-spinner' aria-hidden='true'></i> Rubro</button></li>"+
                "<li><button type='button' class='btn btn-warning btn-xs all' onclick='modalidadEjecucion("+data.id_pi+")'><i class='fa fa-flag' aria-hidden='true'> Modalidad de Ejecución</i></button></li>"+
                "<li><button type='button' class='btn btn-success btn-xs all' onclick='estadoCiclo("+data.id_pi+")'><i class='fa fa-paw' aria-hidden='true'> Ver Estado Ciclo</i></button></li>"+
                "<li><button type='button' class='btn btn-info btn-xs all' onclick='operacionMantenimieto("+data.id_pi+")'><i class='fa fa-building' aria-hidden='true'> Operación y Mantenimiento</i></button></li>"+
                "<li><button type='button' class='btn btn-primary btn-xs all' onclick='metaPresupuestal("+data.id_pi+")'><i class='fa fa-list' aria-hidden='true'> Meta</i></button></li>"+                
                "</ul></div>";
            }
        }],
       "language": idioma_espanol
    });
    AddListarUbigeo("#table_proyectos_inversion", table);
}

$(document).ready(function (e) {
  $('#modal_vista_PIPs').on('show.bs.modal', function(e) { 
    var id_uejec = document.getElementById("selectUnidadEjecutora");
    var id_unidadEjecutora = id_uejec.options[id_uejec.selectedIndex].value;
     var id_oficina = $(e.relatedTarget).data().id;
     // filtrarPIPs();
      filtrarProyectoInversion1(id_unidadEjecutora,id_oficina);
  });
});

function guardarMetaOficina()
    {
        event.preventDefault();
        $('#validarMetaOficina').data('formValidation').validate();
        if(!($('#validarMetaOficina').data('formValidation').isValid()))
        {
            return;
        }
        var formData=new FormData($("#form-MetaOficina")[0]);
        $.ajax({
            type:"POST",
            url:base_url+"index.php/OficinaR/insertarMeta",
            data: formData,
            cache: false,
            contentType:false,
            processData:false,
            beforeSend: function() 
            {
                renderLoading();
            },
            success:function(objectJSON)
            {
                objectJSON=JSON.parse(objectJSON);
                swal(objectJSON.proceso, objectJSON.mensaje, (objectJSON.proceso=='Correcto' ? 'success' : 'error'));
                $('#divModalCargaAjax').hide(); 
                $('#tablaMetaOficina').dataTable()._fnAjaxUpdate();
                $('#listarMetaO').val('');
                $('#listarMetaO').change();
                $('#txt_funcion').val('');
                $('#txt_programa').val('');
                $('#txt_sub_programa').val('');
                $('#txt_act_proy').val('');
                $('#txt_componente').val('');
                $('#txt_meta').val('');
                $('#txt_finalidad').val('');
                $('#txt_nombre_proyecto').val('');
            },
            error:function()
            {
                swal("Error", "Ha ocurrido un error inesperado", "error")
                $('#divModalCargaAjax').hide();
            }
        }); 
    }

    

  function cargarComboMetaSiaf()
    {

        anio_meta=$('#txtAniometa').val();
        id_oficina=$('#txt_id_oficina').val();
        sec_ejec=$('#txt_ue').val();
        html = "";
    $("#listarMetaO").html(html);
    event.preventDefault();
    $.ajax({
        "url": base_url + "index.php/OficinaR/listarMeta",
        type: "POST",
        data:
            {
            anio_meta : anio_meta,
            sec_ejec  : sec_ejec
            },
        success: function (respuesta) {
            // alert(respuesta);
            var registros = eval(respuesta);
            html+="<option value=''>Seleccione una opción</option>"
            for (var i = 0; i < registros.length; i++) {
                html += "<option value=" + registros[i]["sec_func"] + "> " + registros[i]["sec_func"] +" - "+  registros[i]["act_proy"] +" - "+registros[i]["nombre"] + " </option>";
            }

            $("#listarMetaO").html(html);//para modificar las entidades

            //$('select[name=listaGerenciaCM]').change();

            $('.selectpicker').selectpicker('refresh');
        }
    });
    listaMetaOficinaR(id_oficina,anio_meta);
    }

    $("#listarMetaO").change(function(){
        sec_func=$('select[id=listarMetaO]').val();
        anio_meta=$('#txtAniometa').val();
        sec_ejec=$('#txt_ue').val();
        $.ajax(
        {
            url: base_url+'index.php/OficinaR/cargarMeta',
            type: 'POST',
            data:
            {
            sec_func : sec_func,
            anio_meta : anio_meta,
            sec_ejec:sec_ejec
            },
            cache: false,
            async: true
        }).done(function(objectJSON)
        { 
            obj = JSON.parse(objectJSON);
            if(obj.flag!=0)
            {
                $('#txt_funcion').val(obj.funcion+' - '+obj.nombre_funcion);
                $('#txt_programa').val(obj.programa);
                $('#txt_sub_programa').val(obj.sub_programa);
                $('#txt_act_proy').val(obj.act_proy);
                $('#txt_componente').val(obj.componente);
                $('#txt_meta').val(obj.meta);
                $('#txt_finalidad').val(obj.finalidad);
                $('#txt_nombre_proyecto').val(obj.nombre);
            }
            else
               {
              //  swal('', 'No se asigno meta presupuestal para el año '+anio_meta, 'error');
                $('#txt_funcion').val('');
                $('#txt_programa').val('');
                $('#txt_sub_programa').val('');
                $('#txt_act_proy').val('');
                $('#txt_componente').val('');
                $('#txt_meta').val('');
                $('#txt_finalidad').val('');
                $('#txt_nombre_proyecto').val('');
            }

        }).fail(function()
        {
            swal('Error', 'Error no controlado.', 'error');
        });

  });

   var listaMetaOficinaR = function (id_oficina,anio_meta)
    {
        id_oficina=id_oficina;
        anio_meta=anio_meta;
        var table=$("#tablaMetaOficina").DataTable({
            "processing": true,
            "serverSide":false,
            destroy:true,
            "ajax":{
                url:base_url+"index.php/OficinaR/listar_metas_oficina",
                type:"POST",
                data :{id_oficina:id_oficina,
                        anio_meta:anio_meta}
            },
            "columns":
            [
                {"data":"sec_func"},
                {"data":"finalidad"},
                {"data":"act_proy"},
                {"data":"nombre"},
                {"data":"id_oficinaR_meta",
                    render: function(data, type, row)
                    {
                        return "<button type='button' class='btn btn-danger btn-xs' onclick=eliminarMetaOficina(" + data + ",this)><i class='fa fa-trash-o'></i></button>";
                    }
                }
            ],
            "language":idioma_espanol
        });
    }

     function eliminarMetaOficina(id_oficinameta, element) 
  {
    swal({
      title: "Se eliminará la Meta. ¿Realmente desea proseguir con la operación?",
      text: "",
      type: "warning",
      showCancelButton: true,
      cancelButtonText: "Cerrar",
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "SI,Eliminar",
      closeOnConfirm: false
    }, function() {
      paginaAjaxJSON({
        "id_oficinameta": id_oficinameta
      }, base_url + 'index.php/OficinaR/eliminarMeta', 'POST', null, function(objectJSON) {
        objectJSON = JSON.parse(objectJSON);
        swal({
          title: '',
          text: objectJSON.mensaje,
          type: (objectJSON.proceso == 'Correcto' ? 'success' : 'error')
        }, function() {});
        $('#tablaMetaOficina').dataTable()._fnAjaxUpdate();
      }, false, true);
    });
  }
$(document).ready(function (e) {
  $('#VentanaMetaOficina').on('show.bs.modal', function(e) { 
     var id = $(e.relatedTarget).data().id;
     var denom = $(e.relatedTarget).data().denom;
     var id_ue=$('select[id=listaUnidadEjecutoraR]').val();
    // var ue=$('select[id=listaUnidadEjecutoraR]').options[select.selectedIndex].innerText;
    // alert(ue);
      $(e.currentTarget).find('#txt_id_oficina').val(id);
      $(e.currentTarget).find('#txt_oficina').val(denom);
      $(e.currentTarget).find('#txt_ue').val('001549');
      $(e.currentTarget).find('#txt_unidad_ejecutora').val('001549 - REGION APURIMAC SEDE CENTRAL');
      cargarComboMetaSiaf();
  });
});
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1uRF6cxgwFc9DGwREFvIE6oorBaWny64"></script>

