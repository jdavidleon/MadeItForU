<?php 
	session_start();
	require "../../../config/config.php";
	require DIRECTORIO_ROOT."config/autoload.php"; 

	$url = urldecode(Sqlconsult::escape($_REQUEST['url']));
	

	$data = Secure::peticionRequest();
	unset($data['url']);
	var_dump($data);
	if (!$data) {
		$result = 'error';
		$msn = 'ERROR_DATA_REQUEST';
		location($result,$msn);
		return false;
	}

	

	if (!Secure::es_numero($data['zip_code'])) {
		$result = 'error';
		$msn = 'BAD_FORMAT_ZIP_CODE';
		location($result,$msn);
		return false;
	}

	if (!Secure::es_numero($data['telefono'])) {
		$result = 'error';
		$msn = 'BAD_FORMAT_PHONE';
		location($result,$msn);
		return false;
	}

	$nueva = CRUD::insert('usuarios_direcciones',$data);

	if ($nueva[0]->affected_rows === 1) {
		$result = 'success';
		$msn = 'success_address_added';
		location($result,$msn);
		return false;
	}

	
	function location($result,$msn)
	{
		header('Location: '.$GLOBALS['url'].$result.'/'.$msn.'/');
	}
