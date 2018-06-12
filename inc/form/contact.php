    <input type="hidden" name="empt_val">
    <input type="hidden" name="lang" value="<?php echo $lang; ?>">
    <input type="hidden" name="url" value="<?php echo $urlOrigen; ?>"> 

    <div class="form-group">
        <label><?php echo $contactTXT->name; ?></label>
        <input type="text" name="nombre_contacto" class="form-control" required />  
        <span class="hide required text-danger">
            <i class="fa fa-times-circle" aria-hidden="true">
                <?php echo $formTXT->required; ?></i><br>
        </span> 
    </div>  


    <div class="form-group">
        <label><?php echo $contactTXT->email; ?></label>
        <input type="email" class="form-control" name="correo_contacto" required />  
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
        <label><?php echo $contactTXT->phone; ?></label>
        <input type="text" class="form-control" name="telefono_contacto" required /> 
        <span class="hide required text-danger">
            <i class="fa fa-times-circle" aria-hidden="true">
                <?php echo $formTXT->required; ?></i><br>
        </span> 
        <span class="hide validate_val text-danger">
            <i class="fa fa-times-circle" aria-hidden="true">
                <?php echo $formTXT->invalid_phone; ?></i><br>
        </span> 
    </div>


    <div class="form-group">
        <label><?php echo $contactTXT->subject; ?></label>
        <input type="text" class="form-control" name="asunto_contacto" required /> 
        <span class="hide required text-danger">
            <i class="fa fa-times-circle" aria-hidden="true">
                <?php echo $formTXT->required; ?></i><br>
        </span> 
    </div>

    
    <div class="form-group">
        <label><?php echo $contactTXT->message; ?></label>
        <textarea class="form-control" name="mensaje_contacto" rows="5" rows="3" required></textarea> 
        <span class="hide required text-danger">
            <i class="fa fa-times-circle" aria-hidden="true">
                <?php echo $formTXT->required; ?></i><br>
        </span> 
    </div>  