 
    <h3 class="text-center logo-name" style="margin-top: 40px; font-size: 35px;">
        <?php echo $titlePage; ?>
    </h3><br>

    <?php if ($_GET['result'] === 'success'): ?>
        
        <h4 class="text-center text-success">
            <?php echo $success->$_GET['msn']; ?>
        </h4> <br>
        <a href="<?php echo URL_BASE.$lang.'/pages/login/'; ?>" class="btn btn-mifu-modal btn-block">
            <?php echo $loginM->title; ?>
        </a>

    <?php elseif ($_GET['result'] === 'error'): ?>
        
        <h4 class="text-center text-danger">
            <?php echo $error->$_GET['msn']; ?>
        </h4><br>
        <a href="<?php echo URL_BASE.$lang.'/pages/restore/'.$_GET['token'].'/'.$_GET['mail'] ?>" class="btn btn-mifu-modal btn-block">
            <?php echo $restartForm->btn_error; ?>
        </a>
        
    <?php endif ?>


    <br><br>    
    <p class="text-center">
      <?php echo $success->btn_contact_us; ?>
    </p>

