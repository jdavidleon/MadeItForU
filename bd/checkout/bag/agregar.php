<?php 
	session_start();
	require "../../../config/config.php";
	require DIRECTORIO_ROOT."config/autoload.php"; 

	$data = Secure::peticionRequest();

	if (!$data) {
		echo "Ha ocurrido un error";
		return false;
	}

	echo Checkout::agregarCarrito($data);;
