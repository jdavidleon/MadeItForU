<?php 

	session_start();
	require "../../../config/config.php";
	require DIRECTORIO_ROOT."config/autoload.php"; 

	$data = Secure::peticionRequest();

	if (!$data) {
		$result = 'error';
		$msn = 'ERROR_PRODUCT_DELETE';
		location($result,$msn);
		return false;
	}

	if ( isset($_SESSION['id_usuario']) ) {
		$borrar = CRUD::falseDelete('bolsa_compras','id_bolsa_compras = ?',['i',$data['id_bolsa_compras']]);
		var_dump($borrar[0]->affected_rows);
		if ($borrar[0]->affected_rows > 0) {
			$result = 'success';
			$msn = 'success_product_delete';
			location($result,$msn);
			return false;
		}else{
			$result = 'error';
			$msn = 'ERROR_PRODUCT_DELETE';
			location($result,$msn);
			return false;
		}
	}elseif (isset($_COOKIE['bolsa']))  {
		if (Cookie::delValue('bolsa','id_producto',(int) $data['id_producto'])) {		
			$result = 'success';
			$msn = 'success_product_delete';
			location($result,$msn);
			return false;
		}else{
			$result = 'error';
			$msn = 'ERROR_PRODUCT_DELETE';
			location($result,$msn);
			return false;
		}
	}

	function location($result,$msn)
	{
		header('Location: '.URL_BASE.$GLOBALS['data']['lang'].'/checkout/basket/'.$GLOBALS['result'].'/'.$GLOBALS['msn'].'/');
	}


