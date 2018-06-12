<?php 
	
	if ($countCart === 0) {
		$msn = 'Debes agregar productos a tu cesta';
		echo '<script type="text/javascript">
			window.location.assign("'.URL_BASE.$lang.'/checkout/index.php?bd=error&msn='.$msn.'");
		</script>';
	}

	if ($countCart <> $_GET['ctptpay']) {
		$msn = 'Debes revisar tu cesta nuevamente';
		echo '<script type="text/javascript">
			window.location.assign("'.URL_BASE.$lang.'/checkout/index.php?bd=error&msn='.$msn.'");
		</script>';
	}else{
		foreach ($bolsaAgotados as $bag) {
			CRUD::delete('bolsa_compras','id_bolsa_compras = ?',['i',$bag->id_bolsa_compras]);
		}
	}


	$dirs = User::address($_SESSION['id_usuario']);
	$countDirs = count($dirs);
	$direcciones = Secure::decodeArray($dirs);
	$urlContinuar = '';
	$modal = '';

	$d=strtotime("+2 Days");
	$fechaEntrega = date("Y-m-d",$d);

?>

<h4 class="text-center logo-name text-capitalized" style="font-size: 30px; color: #4DB4A5;"><b><?php echo $addressCheck->titleAddress; ?></b></h4>
<hr style="border-color: #4DB4A5;">
<p class="text-center"><?php echo $addressCheck->subTitleAddress; ?></p>

<?php if (isset($_GET['bd'])): ?>
	<?php if ($_GET['bd'] === 'success'): ?>
		<p class="text-center">
			<?php echo $success->$_GET['msn']; ?>
		</p>
	<?php elseif ($_GET['bd'] === 'error'): ?>
		<p class="text-danger text-center">
			<?php echo $error->$_GET['msn']; ?>
		</p>
	<?php endif ?>
<?php endif ?>

<?php if ($countDirs > 0): $contar = 1; ?>
	<?php foreach ($direcciones as $dir): ?>
		<label for="direccion_<?php echo $dir->id_direcciones; ?>" style="width: 100%;">
			<input type="radio" style="display: none;" onclick="selectDir(<?php echo $dir->id_direcciones; ?>);" name='direccion' id="direccion_<?php echo $dir->id_direcciones; ?>" value="<?php echo $dir->id_direcciones; ?>" checked>
			
			<blockquote class="block-dir block-dir-<?php echo $dir->id_direcciones; ?>" id="<?php echo 'dorder_'.$contar; ?>" style="border: 1px solid grey; position: relative;">				    	
	    		<address>
				  	<strong>
				  	<?php 
				  	echo ucwords(strtolower($dir->nombre_direccion.' '.$dir->apellido_direccion));	?>
				   	</strong>
				   	<br>
				  	<?php echo $dir->direccion; ?>
				  	<br>
				  	<?php echo $dir->nombre_ciudad; ?>, 
				  	<?php echo $dir->nombre_estado; ?> <?php echo $dir->zip_code; ?>
				  	<br>
				  	<span title="Phone">Phone:</span> 
				  	<?php echo $dir->telefono; ?>
				</address>		
				<!-- Checked -->
					<i class="fa fa-check-square-o hide icon-selected-<?php echo $dir->id_direcciones; ?>" id="icon_select_<?php echo 'dorder_'.$contar; ?>" style="position: absolute; top: 12px; right: 17px; color: #4DB4A5;" aria-hidden="true"></i>
					<i class="fa fa-square-o" id="icon_not_select_<?php echo 'dorder_'.$contar; ?>" style="position: absolute; top: 12px; right: 19px; color: grey;" aria-hidden="true"></i>
				<!-- Checked -->		
				<div class="pull-right text-center" style="position: relative; bottom: 40px; padding-top: 0;">

					<form action="<?php echo URL_BASE.'bd/users/address/delete.php' ?>" method="post" role="form" id="formDeleteAddress<?php echo $dir->id_direcciones; ?>">

						<input type="hidden" name="empt_val">
						<input type="hidden" name="url" value="<?php echo $urlOrigen; ?>">
						<input type="hidden" name="id_direcciones" value="<?php echo $dir->id_direcciones; ?>">

						<!-- Edit -->
						<a onclick="editAddress(<?php echo $dir->id_direcciones; ?>,<?php echo "'".$lang."'"; ?>,<?php echo "'".$urlOrigen."'"; ?>)" class="btn btn-default btn-sm" style="border-radius: 0;">							
							<i class="fa fa-pencil" aria-hidden="true">
								<span class="hidden-xs">
									<?php echo $addressCheck->btn_edit; ?>
								</span>
							</i>
						</a>
						<!-- #Edit -->

						

						<a onclick="deleteAddress(<?php echo $dir->id_direcciones; ?>)" class="btn btn-mifu btn-sm" style="border-radius: 0;">
							<i class="fa fa-trash" aria-hidden="true">
								<span class="hidden-xs"><?php echo $addressCheck->btn_delete; ?></span>
							</i>
						</a>	

					</form>
				</div>
			</blockquote>	

		</label>
		<?php $contar++; ?>
	<?php endforeach ?>		
	<div class="col-md-12 text-center">				
		<a data-toggle="modal" data-target="#addAddressModal" class="btn btn-mifu-reverse" style="border-radius: 0;"><?php echo $addressCheck->btn_add_address; ?>
		</a>				
	</div>


	<div class="col-md-12" style="color: black">
		<br>
		<br>
		<h3 class="text-center logo-name" style="color: #4DB4A5; font-size: 2.1em;"><!-- <?php echo $addressCheck->subTitleAddress; ?> -->
			Fecha de Entrega
		</h3>
		<hr style="border-color: #4DB4A5;">
		<p style="line-height: 1.4;" class="text-justify"> Por favor selecciona una fecha de entrega de tu pedido, Recuerda que el tiempo de entrega es mínimo 2 dias despues de realizada la compra.</p>
		<br>
	</div>
	<div class="col-sm-4 col-sm-offset-4" >
		<input type="date" name="dia_entrega" class="form-control text-center" style="border: 1px solid black; background-image: none; color: black;" value="<?php echo $fechaEntrega; ?>" min="<?php echo $fechaEntrega; ?>">
	</div>
	<div class="col-md-12" style="color: black">
		<br>
		<p class="text-center"> Horarios de entrega: <br> lunes a domingo de 6:30 am - 11:00 am.</p>
	</div>
<?php else: ?>
	<br>
	<p class="media">
		<div class="media-body text-center text-uppercase">
			<i class="fa fa-5x fa-truck" aria-hidden="true" style="color: #d5dadc;"></i>
			<br>
			<br>
				<?php echo $addressCheck->empty; ?>
			<br>
			<br>
			<a data-toggle="modal" data-target="#addAddressModal" class="btn btn-mifu-modal">
			<?php echo $addressCheck->btn_add_address; ?>
			</a>
		</div>
	</p>

<?php endif ?>