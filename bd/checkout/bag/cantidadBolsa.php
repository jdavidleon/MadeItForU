<?php 
	session_start();
	require "../../../config/config.php";
	require DIRECTORIO_ROOT."config/autoload.php"; 



	if (isset($_SESSION['id_usuario'])) {
		$cantidad = CRUD::numRows('bolsa_compras','*','id_usuario = ? AND tm_delete IS NULL',['i',$_SESSION['id_usuario']]);
		echo $cantidad;
	}elseif (isset($_COOKIE['bolsa'])) {		
		echo count(Cookie::readCookie('bolsa'));		
	}else{
		echo 1;
	}