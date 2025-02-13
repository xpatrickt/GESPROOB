<?php
function mostrarAnidado($meta, $expedienteTecnico)
{
	$htmlTemp='';

	$htmlTemp.='<tr class="elementoBuscar">'.
		'<td><b><i>'.$meta->numeracion.'</i></b></td>'.
		'<td style="text-align: left;text-transform:uppercase;"><b><i>'.html_escape($meta->desc_meta).'</i></b></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>';		
	$htmlTemp.='</tr>';
	if(count($meta->childMeta)==0)
	{		
		foreach($meta->childPartida as $key => $value)
		{
			$htmlTemp.='<tr class="elementoBuscar">'.
				'<td>'.$value->numeracion.'</td>'.
				'<td style="text-align: left;text-transform:uppercase;">'.html_escape($value->desc_partida).'</td>'.
				'<td>'.html_escape($value->descripcion).'</td>'.
				'<td style="text-align: right;">'.$value->cantidad.'</td>'.
				'<td style="text-align: right;">S/.'.$value->precio_unitario.'</td>'.
				'<td style="text-align: right;">S/.'.number_format($value->cantidad*$value->precio_unitario, 2).'</td>';
				if($value->especificacion_tecnica=="")
				{
					$htmlTemp.='<td style="text-align: center;"><a id=btnDetallePartida'.$value->id_detalle_partida.' class="btn btn-info btn-xs"  onclick="agregarEspecificacion('.$expedienteTecnico->id_et.','.$value->id_detalle_partida.');"><i class="fa fa-plus"></i> Registrar</a></td>';
				}
				else
				{
					$htmlTemp.='<td style="text-align: center;"><a id=btnDetallePartida'.$value->id_detalle_partida.' class="btn btn-success btn-xs"  onclick="agregarEspecificacion('.$expedienteTecnico->id_et.','.$value->id_detalle_partida.');"><i class="fa fa-plus"></i> Registrar</a></td>';
				}
				$htmlTemp.='</tr>';
		}		
	}
	foreach($meta->childMeta as $key => $value)
	{
		$htmlTemp.=mostrarAnidado($value, $expedienteTecnico);
	}
	return $htmlTemp;
}
?>
<style>
    #tablaRegistro thead 
    {
        background-color: #f2f5f7;
    }
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    	padding: 4px;
	}
	.dataTables_filter {
		width: 100%;
	}
</style>
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
                <div class="x_content">                    
                    <div class="row">
                    	<div class="col-md-12 col-sm-12 col-xs-12">
                    		<div>
                    			<textarea rows="2" class="form-control" readonly="readonly"><?=trim($expedienteTecnico->nombre_pi)?></textarea>
                    			<br>
                    		</div>
                    	</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
                    		<input  type="button" onclick="agregarGeneralidad();" value="Agregar Generalidades" class="btn btn-warning btn-xs">
							<input  type="hidden" value="<?=$expedienteTecnico->id_et?>" name="hdIdExpedienteTecnico" id="hdIdExpedienteTecnico">
							
						</div>
					</div>
					<div class="table-responsive">
						<table id="tablaRegistro" style="font-size: 11px;width:100%" class="table table-sm" >
							<thead>
								<tr>
									<th>ÍTEM</th>
									<th>DESCRIPCIÓN</th>
									<th>UND.</th>
									<th style="text-align: right;">CANT.</th>
									<th style="text-align: right;">P.U.</th>
									<th style="text-align: right;">TOTAL</th>
									<th style="text-align: center;"> OPCIONES</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($expedienteTecnico->childComponente as $key => $value){ ?>
									<tr class="elementoBuscar">
										<td><b><i><?=$value->numeracion?></i></b></td>
										<td style="text-align: left;text-transform:uppercase;"><b><i><?=html_escape($value->descripcion)?></i></b></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<?php foreach($value->childMeta as $index => $item) { ?>
										<?= mostrarAnidado($item, $expedienteTecnico)?>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
                </div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</div>
<script>
	$(document).ready(function()
	{
		$('#tablaRegistro').DataTable(
		{
			"language":idioma_espanol,
			//"pageLength": 25,
			"ordering":  false,
		});

	});
	function agregarEspecificacion(idEt,codigo)
	{
		paginaAjaxDialogo('otherModalEspecificacionTecnica', 'Especificación Técnica',{ idExpediente: idEt, id_DetallePartida: codigo }, base_url+'index.php/ET_EspecificacionTecnica/Guardar', 'GET', null, null, false, true);
	}

	function agregarGeneralidad()
	{
		var idEt=$('#hdIdExpedienteTecnico').val();

		paginaAjaxDialogo('modalGeneralidad', 'Agregar Generalidades',{ idExpediente: idEt }, base_url+'index.php/ET_EspecificacionTecnica/AgregarGeneralidad', 'GET', null, null, false, true);	
	}
</script>
