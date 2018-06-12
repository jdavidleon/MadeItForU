<?php 
	session_start();
	require "../../../config/config.php";
	require DIRECTORIO_ROOT."config/autoload.php"; 


	$data = Secure::peticionRequest();

	if (!$data) {
		echo "Ha ocurrido un error";
		return false;
	}


	$url = urldecode(Sqlconsult::escape($data['url']));
	unset($data['url']);

	$update = CRUD::update('usuarios_direcciones',$data,'id_direcciones = ?',['i',$data['id_direcciones']]);

	
	header('Location: '.$url);
	return false;