<?php 

    $tokenChek = true;

    $data = Secure::recibirRequest('GET');
    if (!$data) {
        $msn = $error->ERROR_DATA_REQUEST;
        $tokenChek = false;
    }

	$permitidos = [ 'state', 'token', 'serial' ];
    $datos = Secure::parametros_permitidos($permitidos,$data);

    // Respuesta de Paypal Desclinada
    if ($datos['state'] === 'declined') {
    	$tokenChek = false;
    }

    // Si la respuesta es pago aprovado
    if ($tokenChek) {
	    $where = 'serial_venta = ? AND token = ? AND tm_delete IS NULL AND tm_update IS NULL';
	    $params = ['ss',$datos['serial'],$datos['token']];
	    $validarToken = CRUD::all('venta_token','*',$where,$params);

	    if (count($validarToken) !== 1) {
	    	$tokenChek = false;
	    }else{
            CRUD::update('venta_token',['tm_update' => date('Y-m-d H:m:s')],$where,$params);
        }
    }

    if ($tokenChek AND $datos['state'] === 'recieved') {
    	CRUD::update('venta_detalle',['id_estado' => 2],'serial_venta = ?',['i',$datos['serial']]);
    	$detallesPedido = Orders::orderDetail($datos['serial']);
    }

?>



<h4 class="text-center logo-name" style="font-size: 2.5em;"><?php echo $titlePage; ?></h4>
<br>	

<p class="text-center" style="color: black; font-size: 1.5em;">
    
    <?php if ($tokenChek AND $datos['state'] === 'recieved'): ?>
    	   
        Hemos recibido confirmación de PayPal de tu compra.
        <br>
        Resultado de la transacción: APROBADA.
        <br><br>
        Espera un correo de confirmación con un resumen de tu compra.
    <?php endif ?>

    <?php if (!$tokenChek): ?>
    	
        <?php if ($datos['state'] === 'declined'): ?>
            
            No se ha podido procesar el pago por parte de PayPal.
            <br>
            Resultado de la transacción: DECLINADA.
            <br>
            <br>
            Si realizaste el pago comunicate con PayPal o ingresa a <a href="https://www.paypal.com/us/selfhelp/home">https://www.paypal.com/us/selfhelp/home</a>, para ayuda.

        <?php else: ?>

            <?php if ( $datos['state'] === 'recieved' AND count($validarToken) === 0 ): ?>
                
               No hemos podido comprobar la integridad de tu información del pago. 
                <br>
                <br>
                Si realizaste el pago comunicate con PayPal o ingresa a <a href="https://www.paypal.com/us/selfhelp/home">https://www.paypal.com/us/selfhelp/home</a>, para ayuda.


            <?php endif ?>

        <?php endif ?>

    <?php endif ?>

</p>
<br><br>
<p class="text-center">
        <?php echo $mailTXT->paragraf_3; ?> <a href="mailto:gifts@madeitforu.com">gifts@madeitforu.com</a>
</p>
