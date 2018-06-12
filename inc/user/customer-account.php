<div class="col-md-8" id="infoAccount">
    <h3 class="text-center logo-name"><?php echo $secUser->account_info_title; ?></h3>
    <hr>
    <?php if (isset($_GET['bd'])): ?>
        <?php if ($_GET['bd'] === 'success'): ?>
            <p class="text-center">
                <?php echo $success->$_GET['msn']; ?>
            </p>
        <?php elseif($_GET['bd'] === 'error'): ?>
            <p class="text-center text-danger">
                <?php echo $error->$_GET['msn']; ?>
            </p>
        <?php endif ?>
    <?php endif ?>

    <form action="<?php echo URL_BASE."bd/users/update/personal_info.php"; ?>" id="form_datos_personales" method="post">
        <!-- hide -->
        <input type="hidden" name="empt_val">
        <input type="hidden" name="lang" value="<?php echo $lang; ?>">
        <div class="form-group">
            <label for="nombre"><?php echo $secUser->account_name; ?></label>
            <input type="text" class="form-control text-uppercase" id="nombre" name="nombre" value="<?php echo $informacion['nombre']; ?>" required>
        </div>
        <div class="form-group">
            <label for="apellido_usuario"><?php echo $secUser->account_lastname; ?></label>
            <input type="text" class="form-control text-uppercase" id="apellido_usuario" name="apellido_usuario" value="<?php echo $informacion['apellido_usuario']; ?>" required>
        </div>
        <div class="form-group">
            <label for="correo"><?php echo $secUser->account_mail; ?></label>
            <input type="text" class="form-control" id="correo" name="correo" value="<?php echo $informacion['correo']; ?>" required>
        </div>
        <div class="form-group">
            <label for="fecha_nacimiento"><?php echo $secUser->account_birthday; ?></label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $informacion['fecha_nacimiento']; ?>" required>
        </div>
        <p id="respond_person_data" class="respuesta-ajax text-center"></p>
        <div class="text-center" style="margin-top: 40px;">
            <button type="submit" class="btn btn-mifu-reverse " style="border-radius: 0;"><i class="fa fa-save"></i> <?php echo $secUser->account_info_btn; ?></button>
        </div>
    </form>
    <br><br>
    <h3 class="text-center logo-name"><?php echo $secUser->account_psw_title; ?></h3>
    <hr style="border-color: #4DB4A5;">
    <form action="<?php echo URL_BASE."bd/users/update/clave.php"; ?>" method="post" id="form_clave_usuario">
        <input type="hidden" name="empt_val">
        <input type="hidden" name="lang" value="<?php echo $lang; ?>">
        <div class="form-group">
            <label for="password_old"><?php echo $secUser->account_psw_last; ?></label>
            <input type="password" class="form-control" id="password_old" name="password_old" required>
        </div>
        <div class="form-group">
            <label for="password_new"><?php echo $secUser->account_psw_new; ?></label>
            <input type="password" class="form-control" id="password_new" name="password_new" required>
        </div>
        <div class="form-group">
            <label for="password_new2"><?php echo $secUser->account_psw_new2; ?></label>
            <input type="password" class="form-control" id="password_new2" name="password_new2" required>
        </div>
        <p id="respond_person_psw" class="respuesta-ajax text-center"></p>
        <div class="text-center" style="margin-top: 40px;">
            <button type="submit" class="btn btn-mifu-reverse" style="border-radius: 0;"><i class="fa fa-save"></i> <?php echo $secUser->account_psw_btn; ?></button>
        </div>
    </form>
</div><!-- infoAccount -->