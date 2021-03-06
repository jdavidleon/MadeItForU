<?php 
	session_start();
	require '../../../config/config.php';
	require DIRECTORIO_ROOT.'config/autoload.php';

	$data = Secure::peticionRequest();
	$lang = $_REQUEST['lang'];
	unset($data['lang']);

	if (!$data) {
		$bd = 'error';
		$msn = "ERROR_DATA_REQUEST";
		location();
		exit();
	}


	$where = 'id_usuario <> ? AND correo = ?';
	$params = ['is',$_SESSION['id_usuario'],$data['correo']];

	if (CRUD::numRows('usuarios','*',$where,$params) > 0) {		
		$bd = 'error';
		$msn = "ERROR_MAIL_USED";
		location();
		exit();
	}

	var_dump($data);
   	$update_datos = CRUD::update('usuarios',$data,'id_usuario = ?',['i',$_SESSION['id_usuario']]);

	if ($update_datos[0]->affected_rows > 0) {
		$bd = 'success';
		$msn = "success_info_updated";
		location();
		exit();
	}else{
		$bd = 'error';
		$msn = "ERROR_UPDATE_DATA";
		location();
		exit();
	}

	function location()
	{
		header('Location: '.URL_BASE.$GLOBALS['lang'].'/user/customer-account/'.$GLOBALS['bd'].'/'.$GLOBALS['msn'].'/');
	}
	
 ?>