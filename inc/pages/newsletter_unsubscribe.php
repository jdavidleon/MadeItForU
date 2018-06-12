<?php 
    


    $data = Secure::recibirRequest('GET');
    
    if (!$data) {
        echo "Ha ocurrido un error";
        return false;
    }

    $permitidos = [ 'token', 'mail' ];

    $datos = Secure::parametros_permitidos($permitidos,$data);

    $where = 'correo_news = ?';
    $params = ['s',$datos['mail']];
    $buscar = CRUD::numRows('newsletter','*',$where,$params);

    if ($buscar === 1) {
        $token = md5($datos['mail'].SALTREG);
        if ($datos['token'] === $token) {
            CRUD::falseDelete('newsletter',$where,$params);
            $unsubscribeNews = true;
            $msn = $success->success_newsletter_unsubscribe;        
        }else{  
            $unsubscribeNews = false;
            $msn = $error->ERROR_NEWSLETTER_UNSUBSCRIBE;
        }
    }else{      
        $unsubscribeNews = false;
        $msn = $error->ERROR_NEWSLETTER_COUNT_LOST;
    }

?>
    <h3 class="text-center logo-name" style="margin-top: 40px; font-size: 35px;">
        <?php echo $titleUnsubscribeNews; ?>
    </h3>
        <br>                       
    
    <?php if ($unsubscribeNews): ?>
        <h4 class="text-center text-success">  
            <?php echo $msn; ?>
        </h4><br>
    <?php else: ?>
        <h4 class="text-center text-danger">  
            <?php echo $msn; ?>
        </h4><br>
    <?php endif ?>


    <p class="text-center">
        <?php echo $success->btn_contact_us; ?>
    </p>