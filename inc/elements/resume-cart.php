<?php 
	$newCoupon = new Coupon;
	$userCoupon = $newCoupon->findUserCoupon();
	$cupon = 0;

	if ($userCoupon !== false) {
		$cupon = $newCoupon->calculateCoupon($userCoupon);
	}
	
?>

<!-- RESUME CHECKOUT -->
<div class="col-md-3 col-md-offset-0 col-sm-6 col-sm-offset-3" id="resumeCart">
	<h4 class="text-center logo-name text-capitalized"  style="font-size: 2em">
		<b><?php echo ucfirst($resumeCheck->title); ?></b>
	</h4>
	<hr>
	<table class="table-resume">
		<tr>
			<td class="text-capitalized">
				<?php echo ucfirst(strtolower($resumeCheck->subtotal)); ?>
			</td>
			<td>
				<span class="pull-right"><span class="totalPagar">
					<?php echo $precio_total; ?>
				</span>  USD</span>
			</td>
		</tr>
		<tr>
			<td class="text-capitalized">
				<?php echo ucfirst(strtolower($resumeCheck->coupon)); ?>
			</td>
			<td>
				<span class="pull-right">
					-<span class="cupon"><?php echo $cupon; ?></span> USD
				</span>
			</td>
		</tr>
		<tr>
			<td style="padding-left: 10px;" class="text-capitalized"><?php echo ucfirst(strtolower($resumeCheck->shipping)); ?></td>
			<td style=""><span class="pull-right"><span class="envio">0</span> USD</span></td>
		</tr>
		<tr>
			<td colspan="2">
				<hr style="border-color: grey; margin: 5px 0;">
			</td>
		</tr>
		<tr>
			<td style="padding-left: 10px;" class="text-uppercase">
				<b>
					<?php echo ucfirst(strtolower($resumeCheck->total)); ?>
				</b>
			</td>
			<td>
				<span class="pull-right">
					<b>
						<span class="total-final">
							<?php echo $precio_total - $cupon; ?>
						</span> USD
					</b>
				</span>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="text-center text-uppercase area-cupon-val" style="padding-top: 20px; font-size: 13px;">
				<?php if ($userCoupon !== false): ?>
					<?php if ($newCoupon->validate($userCoupon)): ?>					
						<i class="fa fa-check-circle  text-success" aria-hidden="true"> 
							<?php echo $cartPopover->resume_coupon; ?> <?php echo $userCoupon; ?> <?php echo $cartPopover->resume_valid; ?> 
						</i>
					<?php else: ?>
						<i class="fa fa-times-circle-o text-danger" aria-hidden="true"></i> 
						<span class="text-danger">
							<?php echo $cartPopover->resume_coupon; ?> <b><?php echo $userCoupon; ?></b> <?php echo $cartPopover->resume_invalid; ?> 
						</span>
						<a href="#" style="color: black; font-size: 15px;" data-toggle="	tooltip" data-placement="top" title="El cupón pudo haber expirado o no es aplicable a los productos de tu cesta" class="tooltip-element"><i class="fa fa-question-circle" aria-hidden="true"></i></a>						
					<?php endif ?>					
				<?php endif ?>
			</td>
			<td colspan="2" class=" hide text-center text-success text-uppercase area-cupon-success" style="padding-top: 20px; font-size: 13px;">
				<i class="fa fa-check-circle" aria-hidden="true"></i>
				<?php echo $cartPopover->resume_coupon; ?> <?php echo $cartPopover->resume_valid; ?> 
			</td>
			<td colspan="2" class=" hide text-center text-danger text-uppercase area-cupon-error" style="padding-top: 20px; font-size: 13px;">
				<i class="fa fa-times-circle-o" aria-hidden="true"></i> 
				<?php echo $cartPopover->resume_coupon; ?> <?php echo $cartPopover->resume_invalid; ?> 
				<a href="#" style="color: black; font-size: 15px;" data-toggle="	tooltip" data-placement="top" title="El cupón pudo haber expirado o no es aplicable a los productos de tu cesta" class="tooltip-element"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
			</td>
		</tr>
		<tr class="coupon-container">
			<td colspan="2" class="text-center">
				<form action="<?php echo URL_BASE.'bd/order/coupon/new.php' ?>" id="add_coupon" class="" method="POST"> 
				      	<div class="input-group">
				      		<input type="hidden" name="empt_val">
					      	<input type="text" class="form-control" name="clave_cupon" placeholder="<?php echo ucfirst($resumeCheck->coupon); ?>" required>
					      	<span class="input-group-btn">
					        	<button class="btn btn-mifu-reverse" type="submit"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span></button>
					      	</span>
					    </div><!-- /input-group -->
                </form>
			</td>
		</tr>
		<tr class="paypal-info-container">
			<td colspan="2" class="text-center">
				<img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_100x26.png" alt="PayPal Logo">
				<div class="alert alert-paypal " role="alert">
				  <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
				  <strong>PayPal Express Checkout</strong>
				  <br><small><?php echo $resumeCheck->paypal; ?></small><br>

			</td>						
		</tr>
		<tr>
			<td colspan="2">
				<img width="100%" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppmcvdam.png" alt="Credit Card Badges"><br><br>
			</td>
		</tr>
		<?php if ($pagePay == 'address'): ?>
			<?php if ($countDirs > 0): ?>
				<?php $valueDir = $dirs[0]['id_direcciones']; ?>
				<tr>
					<td colspan="2">
						<!-- Paypal Form -->
						<form role='form' method="POST" action="<?php echo URL_BASE.'bd/order/nueva.php' ?>">
							<input type="hidden" name="empt_val">
							<input type="hidden" name="fecha_entrega" value="<?php echo $fechaEntrega; ?>">
							<input type="hidden" name="lang" value="<?php echo $lang; ?>" required>
							<input type="hidden" name="precio_envio" value="0" required>
							<input type="hidden" name="id_direccion" id="id_direccion_paypal" value="<?php echo $valueDir; ?>" required>
							<input type="submit" style="font-size: 20px;" class="btn btn-sm btn-block btn-mifu-modal" value="PAGAR">
						</form><br><br>
						<!-- #Paypal Form -->
					</td>
				</tr>
			<?php else: ?>
				<tr class="">
		        	<td colspan="2" class="text-center">
			            <p class="text-center text-danger">
			                <b><?php echo $resumeCheck->alert_address_order; ?></b>
			            </p> 
			            <br><br>	        		
		        	</td>           
		        </tr>	
			<?php endif ?>
		<?php else: ?>	

	        <?php if (isset($generalValidateMsn) AND $generalValidateMsn): ?>			
			<tr class="hidden-lg hidden-md">
				<td colspan="2" class="text-center">
					<a style="font-weight: 900; font-size: 1.25em;" href="<?php echo $urlContinuar; ?>" <?php echo $modal; ?> class="btn btn-sm btn-block btn-mifu-modal">
					<?php echo $resumeCheck->btn; ?>
					</a><br><br>
				</td>
			</tr>
	    	<?php else: ?>
	        <tr class="hidden-lg hidden-md">
	        	<td colspan="2" class="text-center">
		            <p class="text-center text-danger">
		                <b><?php echo $resumeCheck->alert_personal_order; ?></b>
		            </p> 
		            <br><br>	        		
	        	</td>           
	        </tr>		    		
	        <?php endif ?> 

		<?php endif ?>
	</table>
</div>
<!-- END RESUME CHECKOUT -->