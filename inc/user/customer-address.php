<?php 
	$addresses = User::address($_SESSION['id_usuario']);
	$countAddress = count($addresses);
	$address = Secure::decodeArray($addresses);
?>

<div class="col-md-8" id="infoAddress">
    <h3 class="text-center logo-name">
    	<?php echo $secUser->address_title; ?>
    </h3>
	<hr>
    <?php if ($countAddress === 0): ?>
    <ul style="padding-left: 0;">
    	<li class="media">
			<div class="media-body text-center text-uppercase">
				<i class="fa fa-5x fa-truck" aria-hidden="true" style="color: #d5dadc;"></i>
				<br>
				<br>
					<?php echo $addressCheck->empty; ?>
				<br>
				<br>
				<a data-toggle="modal" data-target="#addAddressModal" class="btn btn-mifu-reverse">
					<?php echo $addressCheck->btn_add_address; ?>
				</a>
			</div>
		</li>
    </ul>
    <?php elseif($countAddress > 0): ?>
	<?php foreach ($address as $dir): ?>
    	<blockquote style="border: 1px solid grey;">				    	
    		<address>
			  	<strong>
			  	<?php echo ucwords(strtolower($dir->nombre_direccion.' '.$dir->apellido_direccion));	?>
			   	</strong><br>
			  <?php echo $dir->direccion; ?><br>
			  <?php echo $dir->nombre_ciudad; ?>, <?php echo $dir->nombre_estado; ?> <?php echo $dir->zip_code; ?><br>
			  <span title="Phone">Phone:</span> <?php echo $dir->telefono; ?>
			</address>				
			<div class="pull-right text-center" style="position: relative; bottom: 40px;">
				<form action="<?php echo URL_BASE.'bd/users/address/delete.php' ?>" method="post" role="form" id="formDeleteAddress<?php echo $dir->id_direcciones; ?>">
					<input type="hidden" name="empt_val">
					<input type="hidden" name="url" value="<?php echo $urlOrigen; ?>">
					<input type="hidden" name="id_direcciones" value="<?php echo $dir->id_direcciones; ?>">
					<a onclick="editAddress(<?php echo $dir->id_direcciones; ?>,<?php echo "'".$lang."'"; ?>,<?php echo "'".$urlOrigen."'"; ?>)" class="btn btn-default btn-sm" style="border-radius: 0;">
						<i class="fa fa-pencil" aria-hidden="true">
							<span class="hidden-xs"><?php echo $addressCheck->btn_edit; ?></span>
						</i>
					</a>
					<a onclick="deleteAddress(<?php echo $dir->id_direcciones; ?>)" class="btn btn-danger btn-sm" style="border-radius: 0;">
						<i class="fa fa-trash" aria-hidden="true">
							<span class="hidden-xs"><?php echo $addressCheck->btn_delete; ?></span>
						</i>
					</a>								
				</form>
			</div>
		</blockquote>
	<?php endforeach ?>
	<a data-toggle="modal" data-target="#addAddressModal" class="btn btn-mifu-reverse pull-right" style="border-radius: 0;">
		<?php echo $addressCheck->btn_add_address; ?>
	</a>
	<br><br>
<?php endif ?>
</div>