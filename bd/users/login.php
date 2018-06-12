<?php
	
	include '../../config/config.php';
	include '../../config/autoload.php';

	$user = new Login;

	if (!isset($user->url_origin) OR $user->url_origin == '') {
		$idRol = CRUD::all('usuarios','id_rol','id_usuario = ?',['i',$_SESSION['id_usuario']]);
	    foreach ($idRol as $rol) {
	    	$rolID = $rol['id_rol'];
	    }

	    if ($rolID == 1) { 
	    	header('Location: '.$user->url_admin);
	    }else{ 
			header('Location: '.$user->url_user);	}
	}else{ 
		header('Location: '.$user->url_origin);
	}
    
    
?>

	<script type="text/javascript">
    	window.location.assign('<?php echo $user->url_user; ?>');
    </script>
