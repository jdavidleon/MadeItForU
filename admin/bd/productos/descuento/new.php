<?php 
	require "../../../config/config.php";
	require DIRECTORIO_ROOT."config/autoload.php"; 

	$data = Secure::recibirRequest();
	
	if (!$data) {
		Secure::errorRequest();
		return false;
	}

	$where = 'id_producto = ?';
	$params = ['i',$data['id_producto']];
	$consultar = CRUD::numRows('productos_descuento','*',$where,$params);


	if ($consultar === 1) {
		CRUD::update('productos_descuento',$set,$where,$params);
	}elseif ($consultar === 0) 
		$unique = [
			'conditional' => 'id_producto = ?',
			'params' => $params
		];
		CRUD::insert('productos_descuento',$data,$unique);
	}