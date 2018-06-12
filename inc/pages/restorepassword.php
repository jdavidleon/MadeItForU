<?php 
    $process_restore_psw = false;
    if (isset($_GET['token']) AND isset($_GET['mail'])) {
        $process_restore_psw = Secure::checkTokenRestorePsw($_GET['mail'],$_GET['token']);
    }  
?>


    <h3 class="text-center logo-name" style="margin-top: 40px; font-size: 35px;">
        <?php echo $titleRestore; ?>
    </h3>
    
    <?php if ($process_restore_psw): ?>                                  
                                                       
        <h4 class="text-center">
            <?php echo $restartForm->subtitle; ?>
            <br><br>
        </h4>

        <form action="<?php echo URL_BASE.'bd/users/password/restore.php' ?>" method="POST">

            <input type="hidden" name="empt_val">
            <input type="hidden" name="lang" value="<?php echo $lang; ?>">
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
            <input type="hidden" name="correo" value="<?php echo $_GET['mail']; ?>">
            
            <div class="form-group">
              <input type="password" class="form-control" placeholder="<?php echo $restartForm->psw1; ?>" name="psw1" required autocomplete="off" autofocus>
            </div>

            <div class="form-group">
              <input type="password" class="form-control" placeholder="<?php echo $restartForm->psw2; ?>" name="psw2" required autocomplete="off" autofocus>
            </div>

            <button type="submit" class="btn btn-mifu-modal btn-block">
              <?php echo $restartForm->btn_restore; ?>
            </button>

        </form>

    <?php else: ?>
        <br>
        <h4 class="text-center text-danger">
            <?php echo $error->ERROR_DATA_RESTORE; ?>
        </h4>
        <br>
        <a href="<?php echo URL_BASE.$lang.'/pages/forgotpassword/' ?>" class="btn btn-mifu-modal btn-block">
            <?php echo $restartForm->btn_restore; ?>
        </a>

    <?php endif ?> 

    <br><br>
    <p class="text-center">
        <?php echo $success->btn_contact_us; ?>
    </p>