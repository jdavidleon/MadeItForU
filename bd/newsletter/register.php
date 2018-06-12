<?php 
	sleep(2);
 	require "../../config/config.php";
	require DIRECTORIO_ROOT."config/autoload.php"; 

	$data = Secure::peticionRequest();
	
	if (!$data) {
		echo "Ha ocurrido un error";
		return false;
	}

	if (!Secure::validar_correo($data['correo_news'])) {
		echo "Ingresa un correo válido";
		return false;
	}

	$buscar = CRUD::all('newsletter','*','correo_news = ?',['s',$data['correo_news']]);

	if (count($buscar) === 0) {
		$set = [ 'correo_news' => $data['correo_news'] ];
		$unique = [
			'conditional' => 'correo_news = ?',
			'params' => ['s',$data['correo_news']]
		];
		$subscribe = CRUD::insert('newsletter',$set,$unique);
		if ($subscribe['0']->affected_rows === 1) {
			$bd = 'success';
			$msn = 'Te has registrado al newsletter';
		}else{
			$bd = 'error';
			$msn = 'Ha ocurrido un error. por favor intentalo nuevamente';			
		}
	}else{
		if ($buscar[0]['tm_delete'] === null) {
			$msn = 'El correo '.$data['correo_news'].' ya se encuetra registardo';
		}else{
			$update = CRUD::update('newsletter',['tm_delete' => NULL],'correo_news = ?',['s',$data['correo_news']]);
			if ($update['0']->affected_rows === 1) {
				$bd = 'success';
				$msn = 'Te has registrado al newsletter';
			}else{
				$bd = 'error';
				$msn = 'Ha ocurrido un error. por favor intentalo nuevamente';			
			}
		}
	}
	echo $msn;