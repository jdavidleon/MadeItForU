<?php 
	session_start();
	require "../../../config/config.php";
	require DIRECTORIO_ROOT."config/autoload.php"; 

	$data = Secure::peticionRequest();

	if (!$data) {
		echo "ERROR_DATA_REQUEST";
		return false;
	}

	$permitido = [ 'clave_cupon' ];
	$datos = Secure::parametros_permitidos($permitido,$data);

	$nuevoCupon = new Coupon;
	
	if ($nuevoCupon->newUserCoupon($datos['clave_cupon'])) {
		echo "cupon agregado";
	}else{
		echo "Cupón inválido";
	}

	return true;

