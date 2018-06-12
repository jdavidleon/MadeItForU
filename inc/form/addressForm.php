
<?php $estados = User::estados(); ?>

		
			
		<input type="hidden" name="empt_val">

		<div class="form-group">
			<label for="nombre_direccion"><?php echo $addressCheck->form_name; ?></label>
			<input type="text" class="form-control" id="nombre_direccion" name="nombre_direccion" value="<?php echo $user->nombre; ?>" required>
		</div>

		<div class="form-group">
			<label for="apellido_direccion"><?php echo $addressCheck->form_last_name; ?></label>
			<input type="text" class="form-control" id="apellido_direccion" name="apellido_direccion" value="<?php echo $user->apellido_usuario; ?>" required>
		</div>

		<div class="form-group">
			<label for="id_estado_eu"><?php echo $addressCheck->form_state; ?></label>
			<select class="form-control estado_eu" name="id_estado_eu" id="id_estado_eu" required>
				<option></option>
				<?php foreach ($estados as $ID => $estado): ?>
					<option value="<?php echo $ID; ?>" ><?php echo $estado; ?></option>
				<?php endforeach ?>

			</select>
		</div>

		<div class="form-group">
			<label for="id_ciudad"><?php echo $addressCheck->form_city; ?></label>
			<select class="form-control ciudades" name="id_ciudad" id="id_ciudad" required>
			</select>
		</div>

		<div class="form-group">
			<label for="direccion"><?php echo $addressCheck->form_address; ?></label>
			<input type="text" class="form-control" id="direccion" name="direccion" required>
		</div>
		
		<div class="form-group">
			<label for="zip_code"><?php echo $addressCheck->form_zip_code; ?></label>
			<input type="text" class="form-control" id="zip_code" name="zip_code" required>
		</div>

		
		<div class="form-group" style="padding-left: 5px;">
			<label for="telefono"><?php echo $addressCheck->form_phone; ?></label>
			<input type="text" class="form-control" id="telefono" name="telefono" required>
		</div>


