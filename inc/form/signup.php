

<input type="hidden" name="empt_val">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="url" value="<?php echo $urlOrigen; ?>">  


<label><?php echo $signUpM->gender; ?></label><br>
<div class="radio-inline" style="margin-left: 10px;">
  <label>
    <input type="radio" name="sexo"  value="F" required>
    <?php echo $signUpM->gender_woman; ?>
  </label>
</div>
<div class="radio-inline">
  <label>
    <input type="radio" name="sexo" value="M" required>
    <?php echo $signUpM->gender_man; ?>
  </label>
</div>

<div class="form-group">
  <label><?php echo $signUpM->name; ?></label>
  <input type="text" class="form-control" name="nombre" required>
  <span class="hide required text-danger">
  	<i class="fa fa-times-circle" aria-hidden="true">
  		<?php echo $formTXT->required; ?></i>
  </span>
</div>

<div class="form-group">
  <label><?php echo $signUpM->last_name; ?></label>
  <input type="text" class="form-control" name="apellido_usuario" required>
  <span class="hide required text-danger">
  	<i class="fa fa-times-circle" aria-hidden="true">
  		<?php echo $formTXT->required; ?></i>
  </span>
</div>

<div class="form-group">
  <label><?php echo $signUpM->mail; ?></label>
  <input type="email" class="form-control" name="correo" required>  
  <span class="hide required text-danger">
  	<i class="fa fa-times-circle" aria-hidden="true">
  		<?php echo $formTXT->required; ?></i><br>
  </span>
  <span class="hide validate_val text-danger">
  	<i class="fa fa-times-circle" aria-hidden="true">
  		<?php echo $formTXT->invalid_email; ?></i>
  </span>
</div>

<div class="form-group">
  <label><?php echo $signUpM->psw; ?></label>
  <input type="password" class="form-control" name="clave" required>
  <span class="hide required text-danger">
  	<i class="fa fa-times-circle" aria-hidden="true">
  		<?php echo $formTXT->required; ?></i><br>
  </span>  
  <span class="hide psw-lenght text-danger">
  	<i class="fa fa-times-circle" aria-hidden="true">
  		<?php echo $formTXT->invalid_psw_lenght; ?> </i><br>
  </span>
  <span class="hide psw-number text-danger">
  	<i class="fa fa-times-circle" aria-hidden="true">
  		<?php echo $formTXT->invalid_psw_number; ?></i><br>
  </span>
  <span class="hide psw-letter text-danger">
  	<i class="fa fa-times-circle" aria-hidden="true">
  		<?php echo $formTXT->invalid_psw_letter; ?> </i><br>
  </span>
</div>



<label><?php echo $signUpM->born; ?></label><br>
	<div class="col-xs-3" style="padding: 0 3px;">
	  <div class="form-group">
	  	<label><small><?php echo $signUpM->born_day; ?></small></label>
	    <select class="form-control" name="fecha_dia" required>
	      <option></option>
	      <?php for ($i=1; $i <= 31; $i++) { ?>
	        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
	      <?php } ?>
	    </select>
	  </div>
	</div>

	<div class="col-xs-6" style="padding: 0 3px;">
	  <div class="form-group">
	  	<label><small><?php echo $signUpM->born_month; ?></small></label>
	    <select class="form-control" name="fecha_mes" required>
	      <option></option>
	      <?php 
	        $meses = [
	            1 => ['es' => 'enero', 'en' => 'January'],
	            2 => ['es' => 'febrero', 'en' => 'February'],
	            3 => ['es' => 'marzo', 'en' => 'March'],
	            4 => ['es' => 'abril', 'en' => 'April'],
	            5 => ['es' => 'mayo', 'en' => 'May'],
	            6 => ['es' => 'junio', 'en' => 'June'],
	            7 => ['es' => 'julio', 'en' => 'July'],
	            8 => ['es' => 'agosto', 'en' => 'August'],
	            9 => ['es' => 'septiembre', 'en' => 'September'],
	            10 => ['es' => 'octubre', 'en' => 'October'],
	            11 => ['es' => 'noviembre', 'en' => 'November'],
	            12 => ['es' => 'diciembre', 'en' => 'December']
	        ]; 
	      ?>
	      <?php foreach ($meses as $key => $mes): ?>
	        <option value="<?php echo $key; ?>"><?php echo ucfirst($mes[$lang]); ?></option>
	      <?php endforeach ?>

	    </select>
	  </div>
	</div>
	<div class="col-xs-3" style="padding: 0 3px;">
	  <div class="form-group">
	    <label><small><?php echo $signUpM->born_year; ?></small></label>
	    <select class="form-control" name="fecha_ano" required style="padding: 6px 4px;">
	      	<option></option>
	      	<?php for ($i=2005; $i > 1920 ; $i--) { ?>
	        	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
	      	<?php } ?>
	    </select>
	  </div>
	</div>
	<label class="anim">
	    <input type="checkbox" class="checkbox" name="accept_terms" required>
	    <span><?php echo $signUpM->terms; ?></span>
	</label>