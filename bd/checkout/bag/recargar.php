<?php 
	session_start();
	require "../../../config/config.php";
	require DIRECTORIO_ROOT."config/autoload.php"; 

	$carrito = new Checkout;
	$bolsa = $carrito->productosBolsa;
	$countCart = count($bolsa);	
	$bolsa  = Secure::decodeArray($bolsa);
	$precio_total = 0;
	
?>


<?php if ($countCart < 1): ?>
	<li class="media" style="padding: 20px;">
		<div class="media-body text-center text-uppercase">
			<i class="fa fa-3x fa-shopping-basket" aria-hidden="true" style="color: #d5dadc;"></i>
			<br>
			<br>
			<?php echo $cartPopover->empty; ?>
		</div>
	</li>
<?php endif ?>
<?php foreach ($bolsa as $prd): ?>
	<?php $precio_total = number_format($precio_total + $prd->precio_total,0,',','.'); ?>
	<li class="media">
	    <div class="media-left">
	      	<a href="#">
	        	<img class="media-object" width="60px" height="60px" src="<?php echo URL_PAGE.'/img_productos/'.$prd->serie.'/thumbnail/'.$prd->ruta_img_tn; ?>"  alt="...">
	      	</a>
	    </div>
	    <div class="media-body">
	      	<h4 class="media-heading ">
	      		<?php $nombre_idioma = 'nombre_producto_'.$_GET['lang']; ?>
	      		<small class="text-uppercase"><b><?php echo $prd->$nombre_idioma; ?></b></small>
	      		<small class="pull-right"><?php echo $prd->precio; ?> USD</small>
	      	</h4>
	      	<small class="describeCart"><?php echo $prd->categoria_es; ?></small>
      		<div class="input-group pull-right">
			    <i class="fa fa-minus-circle" aria-hidden="true" onclick="restCart(<?php echo $prd->id_bolsa_compras; ?>,<?php echo $prd->id_producto; ?>)"></i>
			    <input style="background-color: white;" type="text" disabled class="cantidadBolsa<?php echo $prd->id_producto; ?>" value="<?php echo $prd->cantidad_bolsa; ?>"  min="1" max="10">
      			<i class="fa fa-plus-circle" aria-hidden="true" onclick="sumCart(<?php echo $prd->id_bolsa_compras; ?>,<?php echo $prd->id_producto; ?>)"></i>
			</div>
	    </div>
	</li>
<?php endforeach ?>