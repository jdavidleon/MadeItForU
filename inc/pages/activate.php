<?php 
	$data = Secure::recibirRequest('GET');
    
    $consulta_usuario = CRUD::all('usuarios','*','correo = ?',['s',$data['mail']]);


    if (count($consulta_usuario) !== 1) {
        $mensaje = $error->COUNT_LOST;
    }

    if (!isset($mensaje)) {
        $datosUsuario = $consulta_usuario[0];
        if ($datosUsuario['estado_usuario'] == 1) {
            $mensaje = $error->COUNT_ALREADY_VALIDATED;
        }
        $tokenCreado = md5($datosUsuario['nombre']."-".$datosUsuario['apellido_usuario']."-".$datosUsuario['correo']."-".SALTREG);
    }
    
    if (!isset($mensaje)) {       
        if ($data['token'] === $tokenCreado) {
            $estado = 1;
            $set = [
                'estado_usuario' => $estado
            ];
            $where = 'correo = ?';
            $params = ['s',$datosUsuario['correo']];
            $activar_cuenta = CRUD::update('usuarios',$set,$where,$params);

            if ($activar_cuenta[0]->affected_rows === 1) {
                $mensaje = $success->success_validate_account;
            }else{
                $mensaje = $error->COUNT_ERROR_VALIDATE;
            }
        }else{
            $mensaje = $error->COUNT_ERROR_VALIDATE;
        }
    }
?>

    <h3 class="text-center logo-name" style="margin-top: 40px; font-size: 35px;">      
        <?php echo $success->activate_title; ?>
    </h3>
    <h4 class="text-muted text-center"><?php echo $data['mail']; ?></h4>

    <h4 class="text-center"><?php echo $mensaje; ?></h4>

    <p class="buttons text-center" style="margin: 35px 0;">

        <?php if (Cookie::readCookie('bolsa')): ?>
            <a  href="" data-toggle="modal" data-target="#logInModal" class="btn btn-mifu-reverse" style="border-radius: 0;">
                <?php echo $success->success_continue_basket; ?>
            </a>
        <?php else: ?>
            <a href="#" class="btn btn-mifu-reverse" style="border-radius: 0;">
                <i class="fa fa-home"></i> HOME
            </a> 
        <?php endif ?>

        
    </p>
    <p class="text-center">
        <?php echo $success->btn_contact_us; ?>
    </p>
                            