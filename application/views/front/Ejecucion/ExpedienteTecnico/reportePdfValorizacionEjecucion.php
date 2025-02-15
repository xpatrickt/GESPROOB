<?php
$sumatoriaCostoDirecto=0;
$sumatoriasTotales=[];
function mostrarMetaAnidada($meta, $expedienteTecnico,&$sumatoriasTotales,&$sumatoriaCostoDirecto)
{
	$htmlTemp='';

	$htmlTemp.='<tr>'.
		'<td><b><i>'.$meta->numeracion.'</i></b></td>'.
		'<td style="text-align: left;"><b><i>'.$meta->desc_meta.'</i></b></td>'.
		'<td>---</td>'.
		'<td>---</td>';	
		
	if($expedienteTecnico->num_meses!=null)
	{
		for($i=0; $i<$expedienteTecnico->num_meses; $i++)
		{
			$htmlTemp.='<td>---</td>';
		}
	}

	$htmlTemp.='</tr>';

	if(count($meta->childMeta)==0)
	{
		
		foreach($meta->childPartida as $key => $value)
		{
			$sumatoriaCostoDirecto+=($value->cantidad*$value->precio_unitario);
			$htmlTemp.='<tr>'.
				'<td>'.$value->numeracion.'</td>'.
				'<td style="text-align: left;">'.$value->desc_partida.'</td>'.
				'<td>'.$value->descripcion.'</td>'.
				'<td>'.number_format($value->cantidad*$value->precio_unitario, 2).'</td>';

			if($expedienteTecnico->num_meses!=null)
			{
				for($i=0; $i<$expedienteTecnico->num_meses; $i++)
				{
					if(!isset($sumatoriasTotales[$i]))
					{
						$sumatoriasTotales[]=0;
					}

					$precioTotalMesValorizacionTemp=0;
					$cantidadMesValorizacionTemp=0;

					foreach($value->childDetallePartida->childMesValorizacion as $index => $item)
					{
						if($item->id_detalle_partida==$value->childDetallePartida->id_detalle_partida && $item->numero_mes==($i+1))
						{
							$sumatoriasTotales[$i]+=$item->precio;

							$precioTotalMesValorizacionTemp=$item->precio;

							$cantidadMesValorizacionTemp=$item->cantidad;

							break;
						}
					}
					$htmlTemp.='<td>'.number_format($precioTotalMesValorizacionTemp, 2).'</td>';
				}
			}

			$htmlTemp.='</tr>';
		}
		
	}

	foreach($meta->childMeta as $key => $value)
	{
		$htmlTemp.=mostrarMetaAnidada($value, $expedienteTecnico, $sumatoriasTotales, $sumatoriaCostoDirecto);
	}

	return $htmlTemp;
}
?>
<html>
<head>
	<title>VALORIZACIÓN DE EJECUCIÓN</title>
	<meta charset="utf-8">
	<style>
		@page { margin: 100px 50px;  }
		#header { position: fixed; left: 0px; top: -100px; right: 0px; height: 100px;text-align: center; }
		#footer { position: fixed; left: 0px; bottom: -100px; right: 0px; height: 100px; }
		#footer .page:after { content: counter(page, upper-roman); }
		body
		{
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		}
		#tableValorizacion td, #tableValorizacion th
		{
			border: 1px solid black;
			font-size: 8px;
			padding: 5px 2px;
			text-align: center;
			vertical-align: middle;
			text-transform: uppercase;
			
		}
		#tableValorizacion th
		{
			color:white;
			background-color:#337ab7;
			font-weight: bold;
			padding:2px 5px;
			font-size:9px;
		}
		table
		{
			border-collapse: collapse;
		}

		#tableValorizacionResumen td, #tableValorizacionResumen th
		{
			border: 1px solid black;
			color:white;
			background-color:#337ab7;
			font-size: 8px;
			padding: 5px 2px;
			text-align: center;
			vertical-align: middle;
			text-transform: uppercase;
			font-weight:bold;			
		}
	</style>
</head>
<body>
	<div id="header">
    	<table style="width: 100%;margin-top: 15px">
			<tr>
				<td style="width: 75px;">
					<img style="width: 60px;" src="./assets/images/peru.jpg">
				</td>
				<td id="header_texto">
					<div style="text-align: center; font-size: 13px;"><b>UNIVERSIDAD NACIONAL INTERCULTURAL DE QUILLABAMBA</b></div>
					<div style="text-align: center; font-size: 12px;">"Año del Fortalecimiento de la Soberanía Nacional"</div>					
				</td>
				<td style="width:75px;">
					<img style="width:60px;" src="./assets/images/logoUniq.png">
				</td>
			</tr>
		</table>
  	</div>
  	<div id="footer">
  	</div>
	<div id="content">
		<div style="text-align: center; font-size: 13px;"><b>FORMATO FF-15</b></div>
		<div style="text-align: center; font-size: 13px; padding-bottom:10px;"><b>CRONOGRAMA VALORIZADO DE EJECUCIÓN DEL PROYECTO</b></div>
		<div style="text-align: center;font-size: 11px;margin-bottom: 15px;"><b>"<?=@$expedienteTecnico->nombre_pi;?>"</b></div>		
		<table id="tableValorizacion" style="width: 100%;">
			<thead>
				<tr>
					<th style="width:3%;">ÍTEM</th>
					<th style="width:25%;">DESCRIPCIÓN</th>
					<th style="width:5%;">UND.</th>
					<th style="width:6%;">PARCIAL S/.</th>
					<?php if($expedienteTecnico->num_meses!=null){
						for($i=0; $i<$expedienteTecnico->num_meses; $i++){ ?>
							<th>M<?=($i+1)?> S/.</th>
						<?php }
					} ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach($expedienteTecnico->childComponente as $key => $value){ ?>
					<tr>
						<td><b><i><?=$value->numeracion?></i></b></td>
						<td style="text-align: left;"><b><i><?=$value->descripcion?></i></b></td>
						<td>---</td>
						<td>---</td>
						<?php if($expedienteTecnico->num_meses!=null){
							for($i=0; $i<$expedienteTecnico->num_meses; $i++){ ?>
								<td>---</td>
							<?php }
						} ?>
					</tr>
					<?php foreach($value->childMeta as $index => $item){ ?>
						<?= mostrarMetaAnidada($item, $expedienteTecnico, $sumatoriasTotales,$sumatoriaCostoDirecto)?>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>
		<br>
		<table id="tableValorizacionResumen" style="width: 100%;">
			<tr>
				<td style="text-align: left;width:33%;"><b>COSTO DIRECTO TOTAL</b></td>
				<td style="text-align: center;width:6%;"><?=a_number_format($sumatoriaCostoDirecto, 2, '.',",",3);?></td>
				<?php if($expedienteTecnico->num_meses!=null){
					for($i=0; $i<$expedienteTecnico->num_meses; $i++){ ?>
						<td><b><?=a_number_format(@$sumatoriasTotales[$i], 2, '.',",",3);?></b></td>
					<?php }
				}?>
			</tr>
		</table>
	</div>
</body>
</html>