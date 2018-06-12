<?php
	
	include '../../config/config.php';
	include DIRECTORIO_ROOT.'config/autoload.php';

	$data = Secure::peticionRequest();

	$lang = $_REQUEST['lang'];
	if (!$data) {
		$msn = 'INCONMPLETE_FORM';
		location($msn);
		return false;
	}

	$urlOrigen = $data['url'];
	$lang = $data['lang'];
	$mail = $data['correo'];

	if (!isset($data['accept_terms']) || $data['accept_terms'] != 'on') {	
		$msn = 'ERROR_ACCEPT_TERMS';
		location($msn);
		return false;
	}

	$permitidos = [ 'nombre', 'apellido_usuario', 'correo', 'sexo', 'clave', 'fecha_dia', 'fecha_mes', 'fecha_ano', ];

	$datos = Secure::parametros_permitidos($permitidos,$data);

	if ($datos === false) {
		$msn = 'INCONMPLETE_FORM';
		location($msn);
		return false;
	}

	$datos['id_rol'] = 2; /*Usuario Estandar*/

	if (!checkdate($datos['fecha_mes'], $datos['fecha_dia'],$datos['fecha_ano'])) {
		$msn = 'ERROR_DATE_EXIST';
		location($msn);
		return false;
	}

	$datos['fecha_nacimiento'] = $datos['fecha_ano'].'-'.$datos['fecha_mes'].'-'.$datos['fecha_dia'];

	unset($datos['fecha_dia']);
	unset($datos['fecha_mes']);
	unset($datos['fecha_ano']);	

	function location($msn)
	{	
		header('Location: '.URL_PAGE.'/'.$GLOBALS['lang'].'/pages/signup/'.$msn.'/'.$GLOBALS['mail']);
	}

	if(!Secure::tiene_longitud($datos['clave'], ['minimo' => 8, 'maximo' => 20])) {
      	$msn = "LENGHT_PASSWORD";
      	location($msn);
		return false;
    } 

    if (!Secure::validar_correo($datos['correo'])) {
       	$msn = "INVALID_MAIL";
       	location($msn);
		return false;
    }

   //Verificacion de no existencia de cuenta
    if (CRUD::numRows('usuarios','*','correo = ?',['s',$data['correo']]) > 0) {
      	$msn = "MAIL_PREV_REG";
      	location($msn);
		return false;
	}

	$unique = [
		'conditional' => 'correo = ?',
		'params' => ['s',$datos['correo']]
	];
    $datos['clave'] = Secure::montar_clave_verificacion($datos['clave']);
	$insertar = CRUD::insert('usuarios',$datos,$unique);

	if ($insertar[0]->affected_rows !== 1) {
		$msn = 'ERROR_GLB_SIGNUP';
		location($msn);
		return false;
	}else{		
		if ($urlOrigen == 'http://www.madeitforu.com/'.$lang.'/checkout/basket/') {
			$process = 'basket-checkout';
		}else{
			$process = 'register';
		}
		if (User::sendEmail($data['correo'],$lang,$process)) {
			location('success');  		
		}else{
			$msn = 'ERROR_GLB_SIGNUP';
			location($msn);
			return false;
		}  	
	}
