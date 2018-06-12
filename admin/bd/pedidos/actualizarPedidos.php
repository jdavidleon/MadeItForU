<?php 
	require "../../../config/config.php";
	require DIRECTORIO_ROOT."config/autoload.php"; 

	$data = Secure::recibirRequest('POST');

	if (!$data) {
		Secure::errorRequest();
		return false;
	}

	if (CRUD::update('venta_detalle',['id_estado' => $data['id_estado']],'serial_venta = ?', ['s',$data['serial_venta']])) {

		$estados = CRUD::all('estados_pedido','estado_es','id_estado = ?',['i',$data['id_estado']]);
		$estado = $estados[0]['estado_es'];

		$msn = 'El pedido '.$data['serial_venta'].' ha actualizado su estado a '.$estado;
		header('Location: '.URL_BASE.'admin/pages/pedidos.php?bd=success&msn='.$msn);
	}else{
		$msn = 'Ha ocurrido un error no se ha actualizado el pedido';
		header('Location: '.URL_BASE.'admin/pages/pedidos.php?bd=error&msn='.$msn);
	}
	