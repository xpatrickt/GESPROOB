<div class="right_col" role="main">
	<div class="x_panel">
		<div class="x_title">
			<h2><b>Cronograma valorizado de Ejecución</b></h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">   
			<form class="form-horizontal" id="frmCronogramaValorizado">
				<div class="row" id="divBusquedaCronograma">
					<input type="hidden" name="hdIdExpedienteTecnico" id="hdIdExpedienteTecnico" value="<?=@$idExpedienteTecnico?>">						
					<div class="col-md-3 col-sm-6 col-xs-12">
						<label class="control-label">Tipo:</label>
						<div>
						<select id="selectTipoEstado" name="selectTipoEstado" class="form-control">
							<option value="">--Seleccionar--</option>
							<option value="EXPEDIENTETECNICO">Expediente Técnico</option>
							<option value="ADICIONAL">Adicionales de Obra</option>
						</select>
						</div>	
					</div>
					<div class="col-md-2 col-sm-6 col-xs-12">
						<label class="control-label">Año:</label>
						<div>
							<input type="text" name="txtAnio" id="txtAnio" class="form-control" value="<?=date('Y')?>">
						</div>	
					</div>	
					<div class="col-md-2 col-sm-2 col-xs-12">
						<label class="control-label">.</label>
						<div>       
							<input style="width:100%;" type="button" class="btn btn-default" value="Buscar" onclick="busquedaCronograma();">
						</div>		
					</div>
				</div>
			</form>
			<br>
			<div id="contenedorItem">
			</div>
		</div>
	</div>
</div>
<script>
	$(function()
	{
		$('#divBusquedaCronograma').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectTipoEstado:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Tipo" es requerido.</b>'
						}
					}
				},
				txtAnio:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Año" es requerido.</b>'
						},
						regexp:
						{
							regexp: /^([0-9]){4}$/,
							message: '<b style="color: red;">El campo "Año" debe ser un número de 4 dígitos.</b>'
						}
					}
				}	
			}
		});
	});

	function busquedaCronograma()
	{	
		event.preventDefault();
        $('#divBusquedaCronograma').data('formValidation').validate();
		if(!($('#divBusquedaCronograma').data('formValidation').isValid()))
		{
			return;
		}
		var idExpedienteTecnico=$('#hdIdExpedienteTecnico').val();
		var tipo=$('#selectTipoEstado').val();
		var anio=$('#txtAnio').val();
        $.ajax({
            type:"POST",
            url:base_url+"index.php/ET_Cronograma_Ejecucion/cronograma",
            data: 
			{
				idExpedienteTecnico:idExpedienteTecnico,
				tipo:tipo,
				anio:anio
			},
            cache: false,
            beforeSend:function() 
			{
            	renderLoading();
		    },
            success:function(objectJSON)
            {
				$('#divModalCargaAjax').hide();
				$('#contenedorItem').html(objectJSON);
			},
			error:function ()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
        });
	}
</script>