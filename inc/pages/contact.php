 
    <h3 class="text-center logo-name" style="margin-top: 40px; font-size: 35px;">
        <?php echo $textContact->titlePage; ?>
    </h3>
                               
    <h4 class="text-center">    
        <?php if (isset($_GET['result'])): ?>
            
            <?php if ($_GET['result'] === 'success'): ?>
                
                <span class="text-success">
                    <?php echo $success->$_GET['msn']; ?>
                </span>

            <?php elseif ($_GET['result'] === 'error'): ?>

                <span class="text-danger">
                    <?php echo $error->$_GET['msn']; ?>
                </span>

            <?php endif ?>

        <?php endif ?>
    </h4><br>

    <form method="post" action="<?php echo URL_BASE.'bd/users/contact.php' ?>">
        <?php include DIRECTORIO_ROOT.'inc/form/contact.php'; ?>
        <button type="submit" class="btn btn-mifu-modal btn-block">
            <?php echo $textContact->btn; ?>  
        </button>            
    </form><br><br>

    <p class="text-center">
        <?php echo $textContact->alternative; ?>
    </p>