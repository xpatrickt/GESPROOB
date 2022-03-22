
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
  background-color: #fdfdfd;
}
.trElement li:hover {
  background: #f9f9f9;
}
.nivel
{
  color: #73879C;
    font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
    font-size: 8px;
    font-weight: 100;
 }
 ul{
  padding-left: 30px;
  padding-top: 0px;
  padding-bottom: 0px;

 }
.btnf{
    padding-top: 1px;
    border-top-width: 0px;
    border-bottom-width: 0px;
    padding-bottom: 1px;
    font-size: 11px;
 }
 .btnm{
    padding-right: 2px;
    padding-left: 2px;
    background-color: transparent;
 }
 .all 
    {
      margin-bottom: 0;
      margin-right: 0;
      width: 100%;
    }
.colPage1 
    {
      margin-bottom: 0;
      margin-right: 0;
	  padding : 0;
      width: 30%;
	  height :100%
    }
.colPage2 
    {
      margin-bottom: 0;
      margin-right: 0;
	  padding : 0;
      width: 70%;
	  height :100%
	  border: 1px solid #D8D8D8;
    }
.subpresupuesto{
	padding:0 !important;
}
.ocultar{
display:none;
}
.mostrar{
display:block;
}
</style>
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>PRESUPUESTOS</b></h2>
					<div class="clearfix"></div>
				</div>
				<div class="item form-group">
					<label class="control-label">Proyectos:</label>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<select id="listaProyectoBD"  class="selectpicker show-tick form-control" data-live-search="true">
							<option value="0" selected="true" disabled>Seleccione</option>
						<?php foreach ($listaBds10 as $row) { ?>
							<option value="<?=trim($row->CodigoUnico)?>" <?php echo (trim($codigo)==trim($row->CodigoUnico) ? 'selected' : ''); ?> ><?=$row->CodigoUnico?> - <?=$row->Proyecto?></option>
						<?php  } ?>
						</select>
					</div>
                </div>


				<div class="x_content">
					<div class="row" style="height: 500px; margin-top:5px;padding-top:10px; overflow: scroll; background-color: transparent;">
                    
					<div class="col-md-2 col-sm-2 col-xs-2 colPage1">
					<h4 class="center">Presupuestos</h4>
						<ul class="trElement" style="padding-left: 10px";>
                     </ul>
                  </div>
				  <div class="col-md-10 col-sm-10 col-xs-10 colPage2">
					  <h4 class="center">Hoja de Presupuesto</h4>
					  <div id="hojaPresupuesto"></div>
                  </div>
				</div>
				
			</div>
		</div>
	</div>
</div>
<!--Modal Meta Oficina-->
<div class="modal fade" id="VentanaPresupuestoDesc" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
				<span id="nameProy"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<ul id="myTab" class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#tab_general"  id="home-tab" role="tab" data-toggle="tab" >GENERAL</a>
					</li>
					<li role="presentation">
						<a href="#tab_moneda"  id="profile-tab" role="tab" data-toggle="tab" aria-expanded="false">MONEDA PRINCIPAL</a>
					</li>
				</ul> 
			<!--General</h4-->
			<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="tab_general" aria-labelledby="home-tab">
									<div class="form-horizontal" id="form-MetaOficina">
											<div class="row">
												<div class="col-md-3 col-sm-3 col-xs-3">
													<label class="control-label">Codigo :</label>
												</div>
												<div class="col-md-8 col-sm-9 col-xs-9">
													<input id="txtCodigo" name="txtCodigo" class="form-control" readonly="readonly" required="required" type="text" >
												</div>	
											</div>
											<div class="row">
												<div class="col-md-3 col-sm-3 col-xs-3">
													<label class="control-label">Descripcion :</label>
												</div>
												<div class="col-md-8 col-sm-9 col-xs-9">
													<textarea id="txtDescripcion" name="txtDescripcion" class="form-control" readonly="readonly" required="required" rows="4" type="text" ></textarea>
												</div>	
											</div>
											<div class="row">
												<div class="col-md-3 col-sm-3 col-xs-3">
													<label class="control-label">Cliente :</label>
												</div>
												<div class="col-md-8 col-sm-9 col-xs-9">
													<input id="txtCliente" name="txtCliente" class="form-control" readonly="readonly" required="required" type="text" >
												</div>	
											</div>
											<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Lugar :</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<input id="txtLugar" name="txtLugar" class="form-control" readonly="readonly" required="required" type="text" >
											</div>	
										</div>
										<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Fecha :</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<input id="txtFecha" name="txtFecha" class="form-control" readonly="readonly" required="required" type="text" >
											</div>	
										</div>
										<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Plazo :</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<input id="txtPlazo" name="txtPlazo" class="form-control" readonly="readonly" required="required" type="text" >
											</div>	
										</div>
										<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Jornada :</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<input id="txtJornada" name="txtJornada" class="form-control" readonly="readonly" required="required" type="text" >
											</div>	
										</div>
										<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Fecha Proceso	:</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<input id="txtFecha_Proceso" name="txtFecha_Proceso" class="form-control" readonly="readonly" required="required" type="text" >
											</div>	
										</div>  
									</div>            
									
								</div>
								<div role="tabpanel" class="tab-pane fade" id="tab_moneda" aria-labelledby="home-tab">
									<div class="form-horizontal" id="form-MetaOficina">
											<div class="row">
												<div class="col-md-3 col-sm-3 col-xs-3">
													<label class="control-label">Costo Directo Base S/ :</label>
												</div>
												<div class="col-md-8 col-sm-9 col-xs-9">
													<input id="txtCosto_Directo_Base" name="txtCosto_Directo_Base" class="form-control" readonly="readonly" required="required" type="text" >
												</div>	
											</div>
											<div class="row">
												<div class="col-md-3 col-sm-3 col-xs-3">
													<label class="control-label">Costo Indirecto Base S/ :</label>
												</div>
												<div class="col-md-8 col-sm-9 col-xs-9">
												<input id="txtCosto_Indirecto_Base" name="txtCosto_Indirecto_Base" class="form-control" readonly="readonly" required="required" type="text" >
												</div>	
											</div>
											<div class="row">
												<div class="col-md-3 col-sm-3 col-xs-3">
													<label class="control-label">Costo Base S/ :</label>
												</div>
												<div class="col-md-8 col-sm-9 col-xs-9">
													<input id="txtCosto_Base" name="txtCosto_Base" class="form-control" readonly="readonly" required="required" type="text" >
												</div>	
											</div>
											<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Costo Directo Oferta S/ :</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<input id="txtCosto_Directo_Oferta" name="txtCosto_Directo_Oferta" class="form-control" readonly="readonly" required="required" type="text" >
											</div>	
										</div>
										<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Costo Indirecto Oferta S/ :</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<input id="txtCosto_Indirecto_Oferta" name="txtCosto_Indirecto_Oferta" class="form-control" readonly="readonly" required="required" type="text" >
											</div>	
										</div>
										<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Costo Oferta S/ :</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<input id="txtCosto_Oferta" name="txtCosto_Oferta" class="form-control" readonly="readonly" required="required" type="text" >
											</div>	
										</div>
										<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Costo Directo Oferta Total S/ :</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<input id="txtCosto_Directo_Oferta_Total" name="txtCosto_Directo_Oferta_Total" class="form-control" readonly="readonly" required="required" type="text" >
											</div>	
										</div>
										<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Costo Indirecto Oferta Total S/	:</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<input id="txtCosto_Indirecto_Oferta_Total" name="txtCosto_Indirecto_Oferta_Total" class="form-control" readonly="readonly" required="required" type="text" >
											</div>	
										</div>  
										<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Costo Oferta Total S/	:</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<input id="txtCosto_Oferta_Total" name="txtCosto_Oferta_Total" class="form-control" readonly="readonly" required="required" type="text" >
											</div>	
										</div> 
									</div>            
									
								</div>

						</div>
				<div class="row" style="text-align: right; padding-top:10px">
					<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
		</div>
		
	</div>
<!-- mondal end-->
<script>
	var presupuesto=[];
	$(document).ready(function (e) {
		var ue=$('select[id=listaProyectoBD]');
		var maxLength = 130;
		$('#listaProyectoBD > option').text(function(i, text) {
			if (text.length > maxLength) {
				return text.substr(0, maxLength) + '...';  
			}
		});
		if(ue.val()!==null){mostrarPresupuesto(ue.val(),ue);}
  $('#VentanaPresupuestoDesc').on('show.bs.modal', function(e) { 
     var id = $(e.relatedTarget).data().id;
     var denom = $(e.relatedTarget).data().denom;
	 var proyecto=$("#listaProyectoBD :selected").text();
	 $(e.currentTarget).find('#nameProy').text(proyecto);
      const result=presupuesto.find(element => element.Codigo==id);
      	$(e.currentTarget).find('#txtCodigo').val(result.Codigo);
		$(e.currentTarget).find('#txtCliente').val(result.Cliente);
		$(e.currentTarget).find('#txtCosto_Base').val(result.Costo_Base);
		$(e.currentTarget).find('#txtCosto_Directo_Base').val(result.Costo_Directo_Base);
		$(e.currentTarget).find('#txtCosto_Directo_Oferta').val(result.Costo_Directo_Oferta);
		$(e.currentTarget).find('#txtCosto_Directo_Oferta_Total').val(result.Costo_Directo_Oferta_Total);
		$(e.currentTarget).find('#txtCosto_Indirecto_Base').val(result.Costo_Indirecto_Base);
		$(e.currentTarget).find('#txtCosto_Indirecto_Oferta').val(result.Costo_Indirecto_Oferta);
		$(e.currentTarget).find('#txtCosto_Indirecto_Oferta_Total').val(result.Costo_Indirecto_Oferta_Total);
		$(e.currentTarget).find('#txtCosto_Oferta').val(result.Costo_Oferta);
		$(e.currentTarget).find('#txtCosto_Oferta_Total').val(result.Costo_Oferta_Total);
		$(e.currentTarget).find('#txtDescripcion').val(result.Descripcion);
		$(e.currentTarget).find('#txtFecha').val(result.Fecha);
		$(e.currentTarget).find('#txtFecha_Proceso').val(result.Fecha_Proceso);
		$(e.currentTarget).find('#txtJornada').val(result.Jornada);
		$(e.currentTarget).find('#txtLugar').val(result.Lugar);
		$(e.currentTarget).find('#txtPlazo').val(result.Plazo);
  });
});
	
	 function mostrarPresupuesto(CodigoUnico,element){
    $.ajax(
		{
			type: "POST",
			url: base_url+"index.php/Expediente_Tecnico/listarBds10",
			cache: false,
			data: { CodigoUnico: CodigoUnico},
			success: function(resp)
			{
				var obj=JSON.parse(resp);
				presupuesto=obj;
				if(obj.length==0)
				{
					$(element).parent().parent().parent().parent().parent().find('.trElement').html('No ....');
					return false;
				}
			
				var htmlTemp='';
			
				for(var i=0; i<obj.length; i++)
				{
					if(obj[i].SubPresupuesto == "subpresupuesto")
					{
					htmlTemp+='<li>'+
					'<i  class="elegir btn-xs fa"  style="margin-right: 8px;"></i>'+
							'<a href="" class="nivel" data-toggle="modal" data-target="#VentanaPresupuestoDesc" data-id=\''+obj[i].Codigo+'\'  data-denom=\''+obj[i].Descripcion+'\'>'+obj[i].Descripcion+'</a>'+     
							"</div>"+
					'</li>';
					}
					else
					{
					htmlTemp+='<li>'+
					'<i  class="elegir btn btnm btn-xs fa fa-chevron-right" id="btnAccion" name="Accion" value="+" onclick="elegirAccion(this);"></i>'+  
							'<a href="" class="nivel" data-toggle="modal" data-target="#VentanaPresupuestoDesc" data-id=\''+obj[i].Codigo+'\'  data-denom=\''+obj[i].Descripcion+'\'>'+obj[i].Descripcion+'</a>'+       
							"</div><ul class='ocultar'>";
					for(var j=0; j<obj[i].SubPresupuesto.length; j++){
						htmlTemp+='<li onclick="hojaPresupuesto(\''+CodigoUnico+'\',\''+obj[i].Codigo+'\',\''+obj[i].SubPresupuesto[j].CodSubpresupuesto+'\', this);" class="subpresupuesto">'+
					'<i  class="elegir btn-xs fa fa-file-text-o"  style="margin-right: 2px;"></i>'+
							'<a class="nivel">'+obj[i].SubPresupuesto[j].Descripcion+"</a>"+     
							"</div>"+
					'</li>';
					}
					htmlTemp+='</ul></li>';
					}       
				}

			htmlTemp+='';
			$(element).parent().parent().parent().parent().parent().find('.trElement').html(htmlTemp);                                         
			}
		});
  }
  function elegirAccion(element)
{
  var valueButton =  $(element).attr('value');
  var clase=$(element).attr('class');
  if(valueButton == '+')
  {
    $($(element).parent().find('ul')[0]).attr('class','mostrar'); 
    $(element).attr('value','-');
    $(element).attr('class','elegir btn btnm btn-xs fa fa-chevron-down');
  }
  else
  {
    $($(element).parent().find('ul')[0]).attr('class','ocultar'); 
    $(element).attr('value','+');
    $(element).attr('class','elegir btn btnm btn-xs fa fa-chevron-right');
  } 
}
  $("#listaProyectoBD").change(function(){
	  
        var ue=$('select[id=listaProyectoBD]').val()
        mostrarPresupuesto(ue,this);

  });
  function hojaPresupuesto(CodigoUnico,CodigoPresupuesto,CodigoSubPresupuesto,element){
	$.ajax(
  {
    type: "POST",
    url: base_url+"index.php/Expediente_Tecnico/HojaPresupuesto",
    cache: false,
    data: { CodigoUnico: CodigoUnico,CodigoPresupuesto:CodigoPresupuesto,CodigoSubPresupuesto:CodigoSubPresupuesto},
    success: function(resp)
    {
      var obj=JSON.parse(resp);
	  var htmlTemp='<table id="TableUbigeoProyectoInv" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%" >'+
                           ' <thead >'+
                               ' <tr>'+
                                   ' <th style="width: 20%" >Item</th>'+
                                   ' <th style="width: 20%" >Descripcion</th>'+
                                   ' <th style="width: 20%" >Und.</th>'+
                                   ' <th style="width: 20%" >Metrado</th>'+
                                   ' <th style="width: 20%" >Precio(S/.)</th>'+
                                   ' <th style="width: 20%" >Parcial(S/.)</th>'+
                               ' </tr>'+
                           ' </thead>'+
                           ' <tbody>';
						   obj.forEach(element => {
							   htmlTemp+='<tr><td>'+element.orden+'</td>';
							   
							   if(element.titulos!="REGISTRO RESTRINGIDO"){
									htmlTemp+='<td>'+element.titulos+'</td>';
							   }
							   else{
								htmlTemp+='<td>'+element.partida+'</td>';
							   }
							   htmlTemp+='<td>'+(isNaN(element.simbolo)? element.simbolo:'')+'</td>';
								htmlTemp+='<td>'+(isNaN(parseFloat(element.metrado))? '':parseFloat(element.metrado))+'</td>'+
							   '<td>'+(isNaN(parseFloat(element.Precio))? '':parseFloat(element.Precio))+'</td>'+
							   '<td>'+(isNaN(parseFloat(element.Parcial))? '':parseFloat(element.Parcial))+'</td>';
							   htmlTemp+='</tr>';
						   });

						   htmlTemp+=' </tbody>'+
                       ' </table>';

	  $('#hojaPresupuesto').html(htmlTemp);
                                           
    }
  });
  }
</script>