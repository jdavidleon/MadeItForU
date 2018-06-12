   <h3 class="text-center logo-name" style="margin-top: 40px; font-size: 35px;">
        <?php echo $forgotForm->title; ?>
    </h3>
                               
  <?php if (!isset($_GET['result']) OR $_GET['result'] === 'error'): ?>

    <?php if (isset($_GET['msn'])): ?>
      <h4 class="text-center text-danger">
        <?php echo $error->$_GET['msn']; ?>
      </h4>
    <?php endif ?>

    <h4 class="text-center">
          <?php echo $forgotForm->subtitle; ?>
    </h4>


    <form action="<?php echo URL_BASE.'bd/users/password/remember.php' ?>" method="POST">
        <input type="hidden" name="empt_val">
        <input type="hidden" name="lang" value="<?php echo $lang; ?>">
        
        <div class="form-group">
          <label></label>
          <input type="email" class="form-control" placeholder="<?php echo $forgotForm->email; ?>" name="correo" required autocomplete="off" autofocus>
          <br>
          <button type="submit" class="btn btn-mifu-modal btn-block">
          <?php echo $forgotForm->btn_restore; ?></button>

        </div>
    </form>

  <?php endif ?>


  <?php if (isset($_GET['result']) AND $_GET['result'] === 'success'): ?>
      <br>
      <h4 class="text-center text-success">
          <?php echo $success->$_GET['msn']; ?>
      </h4>
      <br><br>
  <?php endif ?>



    <p class="text-center">
      <?php echo $success->btn_contact_us; ?>
    </p>
