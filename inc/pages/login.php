 
    <h3 class="text-center logo-name" style="margin-top: 40px; font-size: 35px;">
        <?php echo $titleLogIn; ?>
    </h3>    

    <h3 class="text-center">              
        <?php if (isset($_GET['result']) AND $_GET['result'] === 'error'): ?>

            <small class="text-danger text-center">
                <?php echo $error->$_GET['msn']; ?>
            </small>

        <?php endif ?>
    </h3><br>    



    <form method="post" action="<?php echo URL_BASE.'bd/users/login.php' ?>">
            
        <?php include DIRECTORIO_ROOT.'inc/form/login.php'; ?>
        
        <button type="submit" class="btn btn-mifu-modal btn-block">
            <?php echo 'Enviar'; ?>    
        </button>            

    </form><br><br>

    <p class="text-center">
        <a href="<?php echo URL_BASE.$lang.'/pages/forgotpassword/'; ?>">
            <?php echo $loginM->forgot; ?>
        </a> 
        <a style="" href="" data-toggle="modal" data-target="#signUpModal">
            <br> 
            <?php echo $loginM->btnSignUp; ?>
        </a>
    </p>
