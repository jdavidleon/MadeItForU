	<?php 
	require "../../../config/config.php";
	require DIRECTORIO_ROOT."config/autoload.php"; 

	$data = Secure::recibirRequest('POST');
	
	if (!$data) {
		Secure::errorRequest();
		return false;
	}

	$infoPedido = Orders::orderDetail($data['serial_venta']);
	// var_dump($infoPedido);
	$cliente = Orders::$_dataClient;
	// var_dump($cliente);
?>


	<h3 class="text-center text-uppercase"><b>Pedido # <?php echo $cliente->serial_venta; ?></b></h3>
	<br>
	<div class="table-responsive">
	  	<table class="table table-bordered">
	  		<tr class="text-center">
			  <td colspan="3" class="text-uppercase"  style="padding: 5px 30px;"><b>Cliente</b></td>
			</tr>
			<tr class="text-center">
			  <td class="">Nombre</td>
			  <td class="">Correo</td>
			  <td class="">Teléfono</td>
			</tr>
			<tr class="text-center">
			  <td class=""><?php echo $cliente->nombre.' '.$cliente->apellido_usuario; ?></td>
			  <td class=""><?php echo $cliente->correo; ?></td>
			  <td class=""><?php echo $cliente->telefono; ?></td>
			</tr>
	  	</table>
	</div>
	<div class="table-responsive ">
	  	<table class="table table-bordered">
			<tr class="text-center">
			  <td colspan="4" class="text-uppercase" style="padding: 5px 30px;"><b>Productos</b></td>
			</tr>
			<tr class="text-center">
			  <td class="" style="width: 120px;">Imagen</td>
			  <td class="">Producto</td>
			  <td class="">Cantidad</td>
			  <td class="">Precio</td>
			</tr>
			<?php foreach ($infoPedido as $producto): ?>
				<?php 
					$arrayItems = explode('-', $producto['item_list']); 
					$listItems = '';
					foreach ($arrayItems as $item) {
						$rItem = CRUD::all('productos_items','*','id_item = ?',['i',$item]);
						if (count($rItem) > 0) {
							$listItems .= ucfirst($rItem[0]['item_es']).', ';
						}						
					}
				?>
				<tr class="text-center">
					<td class="text-center">
					  	<img class="img-responsive text-center" width="120px" src="<?php echo URL_BASE.'img_productos/'.$producto['serie'].'/thumbnail/'.$producto['ruta_img_tn']; ?>">
					</td>
					<td class="" style="vertical-align: middle;"><?php echo $producto['nombre_producto_es']; ?></td>
					<td class="" style="vertical-align: middle;"><?php echo $producto['cantidad']; ?></td>
					<td class="" style="vertical-align: middle;">$ <?php echo number_format($producto['precio_total_producto'],0,',','.'); ?></td>
				</tr>
				<tr class="text-center">
					<td>Contenido</td>
					<td colspan="3">
						<?php echo substr($listItems,0,-2).'.'; ?>
					</td>
				</tr>
				<tr class="text-center">
					<td>Destinatario</td>
					<td colspan="3">
						<?php echo $cliente->destinatario; ?>
					</td>
				</tr>
				<tr class="text-center">
					<td>Motivo del regalo</td>
					<td colspan="3">
						<?php echo $cliente->motivo; ?>
					</td>
				</tr>
				<tr class="text-center">
					<td>Frase personalizada</td>
					<td colspan="3">
						<?php echo $cliente->frase_personalizada; ?>
					</td>
				</tr>
				<tr class="text-center">
					<td>Mensaje de la tarjeta</td>
					<td colspan="3">
						<?php echo $cliente->mensaje_tarjeta; ?>
					</td>
				</tr>
			<?php endforeach ?>			  

	  	</table>
	  	<div class="table-bordered">
	  		<h4 class="text-center"><b>INFORMACIÓN DE ENVÍO</b></h4><br>
		  	<address class="text-center">
			  	<strong>
			  		<?php echo $cliente->nombre_direccion.' '.$cliente->apellido_direccion; ?>
			  	</strong>
			  	<br>
			  	<?php echo $cliente->direccion; ?>
			  	<br>
			  	<?php echo $cliente->nombre_estado; ?>, 
			  	<?php echo $cliente->nombre_ciudad; ?> 
			  	<?php echo $cliente->zip_code; ?>
			  	<br>
			  	<span title="Phone">Teléfono: </span> 
			  	<?php echo $cliente->telefono; ?>
			  	<br>
			  	<br>
			  	<b class="text-uppercase"><span>Fecha de entrega</span>
			  	<?php echo $cliente->fecha_entrega ?></b>
			</address>
		  	</div>
		</div>
		<br>
		
		<div class="col-sm-6 col-sm-offset-3 text-center">
			<h4 class="text-center text-uppercase"><b>Actualizar Estado</b></h4>
			<small class="text-center">Selecciona del siguiente menú el nuevo estado del pedido y luego oprime cambiar estado</small>
			
			<form class="text-center" action="<?php echo URL_BASE.'admin/bd/pedidos/actualizarPedidos.php'; ?>" method="POST">
				<input type="hidden" name="serial_venta" value="<?php echo $data['serial_venta']; ?>">
				<select class="form-control" name="id_estado" style="border: 1px solid grey; background-image: none;">
					<?php 
						$estadosPedido = CRUD::all('estados_pedido'); 
						$estadoActual = CRUD::all('venta_detalle','id_estado','serial_venta = ?', ['s',$data['serial_venta']]);
						$actualEstado = $estadoActual[0]['id_estado'];						
					?>
					<?php foreach ($estadosPedido as $estado): ?>
						<?php if ($estado['id_estado'] === $actualEstado): ?>
							<option value="<?php echo $estado['id_estado']; ?>">
								<?php echo $estado['estado_es'] ?>
							</option>
						<?php endif ?>
					<?php endforeach ?>			  
					<?php foreach ($estadosPedido as $estado): ?>
						<?php if ($estado['id_estado'] !== $actualEstado): ?>
							<option value="<?php echo $estado['id_estado']; ?>">
								<?php echo $estado['estado_es'] ?>
							</option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
				<br>
				<input type="submit" class="btn btn-warning btn-md" value="Cambiar estado">
			</form>
		</div>

		<?php if ($actualEstado === 3 || $actualEstado === 4): ?>
		<div class="text-center col-sm-6 col-sm-offset-3">
			<form action="<?php echo ADMIN.'bd/pedidos/enviar_confirmacion_pedido.php' ?>" method="POST">
				<br>
				<input type="hidden" name="empt_val">
				<input type="hidden" name="id_usuario" value="<?php echo $cliente->id_usuario; ?>">
				<input type="hidden" name="id_venta_detalle" value="<?php echo $cliente->id_venta_detalle; ?>">
				<input type="hidden" name="nombre_usuario" value="<?php echo strtoupper($cliente->nombre.' '.$cliente->apellido_usuario); ?>">

				<div class="form-group">
					<label for ="usuario_email">Envía un correo de confirmación al cliente, con la información de la compra y fecha de entrega.</label>
					<input type="mail" class="form-control text-center" style="border: 1px solid grey; background-image: none;" name="usuario_email" value="<?php echo $cliente->correo; ?>">
				</div>
				
				<input type="submit" class="btn btn-success" value="Enviar Correo">
			</form>
		</div>
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		<?php endif ?>
		<br><br>
		<br><br>
		<br><br>
		
