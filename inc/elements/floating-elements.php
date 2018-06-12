<?php 
	$precio_total = 0;
?>
		
<!-- *** CART PREVIEW *** -->
<div id="previewCart" class="hide">
    <h4 class="text-center logo-name"><b><?php echo $cartPopover->header; ?></b></h4>
    <ul class="media-list">
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
    		<?php $precio_total = $precio_total + $prd->precio_total; ?>
    		<li class="media">
			    <div class="media-left">
			      	<a href="#">
			        	<img class="media-object" width="60px" height="60px" src="<?php echo URL_PAGE.'/img_productos/'.$prd->serie.'/thumbnail/'.$prd->ruta_img_tn; ?>"  alt="...">
			      	</a>
			    </div>
			    <div class="media-body">
			      	<h4 class="media-heading ">
			      		<?php $nombre_idioma = 'nombre_producto_'.$lang; ?>
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
	</ul> 
	<p class="text-center"><?php echo $cartPopover->resume; ?> <span class="totalPagar"><?php echo number_format($precio_total,0,',','.'); ?></span> USD</p>
	<a href="<?php echo URL_BASE.$lang.'/checkout/basket' ?>" class="btn btn-mifu-modal btn-block"><?php echo $cartPopover->btn; ?></a>
</div> 
<!-- *** CART PREVIEW END *** -->


<!-- *** ALERT COOKIES POLICY *** -->
<?php if (Cookie::readCookie('msn_coo_pol') === false): ?>	
	<div class="container-fluid coo_pol">
		<div class="alert alert-danger alert-dismissible text-center" id="alertCookiePol" role="alert">
		  	<button type="button" class="close"  data-dismiss="alert" aria-label="Close">
		  		<span aria-hidden="true">&times;</span>
		  	</button>
		  	<br>
		  	<p class="text-center">
		  		<?php echo $cookieAlert->content; ?>
		  	</p>
		  	<a class="btn btn-danger btn-sm" data-dismiss="alert" aria-label="Close">
		  		<?php echo strtoupper($cookieAlert->btn); ?>
		  	</a>
		</div>
	</div>
<?php endif ?>
<!-- *** END ALERT COOKIES POLICY *** -->
	


	
<!-- *** ALERT SUCCESS *** -->
<div class="container-fluid container-alert-success">
	<div class="container">
		<div class="alert alert-success-mifu alert-dismissible text-center" role="alert">
		  	<button type="button" class="close"  data-dismiss="alert" aria-label="Close">
		  		<span aria-hidden="true">&times;</span>
		  	</button>
		  	<b>
		  	<p class="text-center" id="successAlertTxt">
		  		<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
		  	</p>
		  	</b>
		</div>
	</div>
</div>
<!-- *** END ALERT SUCCESS *** -->
	
	
<!-- *** ALERT ERROR *** -->
<div class="container-fluid container-alert-wrong">
	<div class="container">
		<div class="alert alert-wrong-mifu alert-dismissible text-center" role="alert">
		  	<button type="button" class="close"  data-dismiss="alert" aria-label="Close">
		  		<span aria-hidden="true">&times;</span>
		  	</button>
		  	<b>
		  	<p class="text-center" id="wrongAlertTxt">
		  		<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
		  	</p>
		  	</b>
		</div>
	</div>
</div>
<!-- *** END ALERT ERROR *** -->
