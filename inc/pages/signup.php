   <h3 class="text-center logo-name" style="margin-top: 40px; font-size: 35px;">
        <?php echo $signUpM->title; ?> 
    </h3>
                               
    <h4 class="text-center text-danger">
        <?php if ( isset($_GET['msn']) AND $_GET['msn'] !== 'success' ): ?>
            <?php echo $error->$_GET['msn']; ?>
        <?php endif ?>
    </h4>
    <br>
   
    <?php if ( !isset($_GET['msn']) OR $_GET['msn'] !== 'success' ): ?>    

        <form class="form-modals" action="<?php echo URL_BASE.'bd/users/nuevo.php' ?>" method="POST" role="form">
            
            <?php include DIRECTORIO_ROOT.'inc/form/signup.php'; ?>
        
            <button type="submit" class="btn btn-mifu-modal btn-block">
                <?php echo $signUpM->btnSignUp; ?>
            </button>

        </form>

        <p class="text-center" style="margin-top: 20px;">
            <?php echo $signUpM->already; ?> <br>
            <a style="color: black; text-decoration: underline;" href="" data-toggle="modal" data-target="#logInModal"><?php echo $signUpM->btnLogIn; ?> </a>
        </p>

    <?php endif ?>

    <?php if ( isset($_GET['msn']) AND $_GET['msn'] === 'success' ): ?>

        <h3 class="text-center">
            <b>
                <?php echo $success->success_signup_title; ?>                
            </b>
        </h3>
        <p class="text-center">
            <?php echo $success->success_signup_p1; ?>
        </p>
        <br>
        <p class="text-center">
            <?php echo $success->success_signup_p2; ?>
        </p>
        <br><br>
    <?php endif ?>