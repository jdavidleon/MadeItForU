<?php 
/**
* 
*/
class Login extends Secure
{	

	public $url_user;
	public $url_admin;
	public $url_origin;
	static public $lang;
	private $_data = [];
	
	function __construct()
	{
		// URL DE ORIGEN PARA RELIZAR RETORNO
	    $this->url_user = urldecode(URL_BASE);
	    $this->url_admin = urldecode(ADMIN);
	    self::$lang = $_REQUEST['lang'];
		if (isset($_REQUEST['url'])) {
			$this->url_origin = urldecode(Sqlconsult::escape($_REQUEST['url']));
		}

		if (isset($_REQUEST['payment_continue'])) {
			$this->url_origin = URL_PAGE.'/'.self::$lang.'/checkout/basket';
			unset($_REQUEST['payment_continue']);
		}

	    if ($this->validaciones()) {
	    	$loguear = $this->logIn();

	    	if ($loguear == true) {
	    		$this->ajusteBolsa();
	    	}
	    }else{	    	
	    	parent::retornoError('ERROR_VAL_LOG_MAIL_PSW');
	    }
	}

	private function validaciones()
	{
		$this->_data = parent::peticionRequest();

		if ($this->_data === false) {
			return parent::retornoError('ERROR_DATA_REQUEST');
		}

		if (!parent::validar_correo($this->_data['correo'])) {
			return parent::retornoError('INVALID_MAIL');
		}

	    if (!parent::camposVacios()) {
	    	parent::retornoError('INCONMPLETE_FORM');
	    }

	    $buscarUsuario = CRUD::find('usuarios','correo','correo = ?',['s',$this->_data['correo']]);
		if ($buscarUsuario[1]->num_rows < 1) {
			return parent::retornoError('COUNT_LOST');
		}

		if(!parent::tiene_longitud($this->_data['clave'], ['minimo' => 8, 'maximo' => 25])) {
			return parent::retornoError('LENGHT_PASSWORD');
		} 
		return true;
	}


	public static function validarPermisos($rol = 'ADMINISTRADOR')
	{	
		switch ($rol) {
			case 'ADMINISTRADOR':
				$rolID = 1;
				break;
			
			case 'VENDEDOR':
				$rolID = 2;
				break;
			
			case 'USUARIO':
				$rolID = 3;
				break;
			
			default:
				$rolID = 0;
				break;
		}

		if (isset($_SESSION['id_usuario'])) {
			$buscar = CRUD::all('usuarios','id_rol','id_usuario = ?',['i',$_SESSION['id_usuario']]);

			if (array_search($rolID, array_column($buscar, 'id_rol')) === false) {
				header('Location: '.URL_BASE.'?permition=without_credentials');
			}
			return true;
		}
	}

	private function logIn()
	{
		/*Conteo de los intentos de sesion*/
		$intentosLogueo = Secure::verificarIntentos($this->_data['correo']);

		if ($intentosLogueo[1]->num_rows > 0) {
			$logueos = $intentosLogueo[1]->fetch_assoc();
			if ($logueos['intentos'] > 10) {
				parent::retornoError('ERR_LOG_CUENTA_BLOQUEADA');
			}
		}
		
		/*Verificar contraseña en la BD*/
		$clave2 = parent::montar_clave_verificacion($this->_data['clave']);
		$params = ["ss",$this->_data['correo'],$clave2];
		$loguear = CRUD::find('usuarios','*','correo = ? AND clave = ?',$params);

		/*Validacion retornada por la BD*/
		$fila = $loguear[1]->fetch_assoc();
		

		if ($loguear[1]->num_rows == 1) {
			unset($fila['clave']);
			parent::resetIntentos($this->_data['correo']);/*Reset Intentos de LogIn*/
			if ($fila['estado_usuario'] != 1) {
				parent::retornoError('ERROR_VALIDACION_USUARIOS_P_V');
			}
			if($fila['estado_usuario'] == 1){
				if (isset($this->_data['recordar']) AND $this->_data['recordar'] == "true") {

					if (isset($_COOKIE['log_in'])) {
						$verDatos = Cookie::readCookie('log_in');

						foreach ($verDatos as $dato) {							
							if ($this->_data['correo'] == $dato['user']) {
								if ($this->_data['clave'] != $dato['clv']) {
									$key = [
					        			'key' => 'user',
					        			'value' => $this->_data['correo']
					        		];
					        		$data = [
					        			'update' => 'clv',
					        			'data' => $this->_data['clave'],
					        		];
					        		$actualizar = Cookie::updateCookie('log_in',$key,$data);
					        		$data2 = [
					        			'update' => 'tm_log',
					        			'data' => date("Y-m-d h:i:sa")
					        		];
					        		$actualizar = Cookie::updateCookie('log_in',$key,$data2);
								}
							}else{
								$data = [ 
									[
									'user' => $this->_data['correo'],
									'clv' => $this->_data['clave'],
					        		'tm_log' => date("Y-m-d h:i:sa")
									]
								];
								$insertar = Cookie::insertInCookie('log_in',$data,258000,'user');
							}
						}
					}else{
						$aLogin[0]['user'] = $this->_data['correo'];
					    $aLogin[0]['clv'] = $this->_data['clave'];
					    $aLogin[0]['tm_log'] = date("Y-m-d h:i:sa");
						Cookie::createCookie('log_in',$aLogin);
					}					
				}
				// if (!isset($this->_data['recordar']) AND isset($_COOKIE['log_in'])) {
				// 	Cookie::deleteCookie('log_in');
				// }
				session_start();				
				$_SESSION['user'] = Sqlconsult::escape($fila['nombre']);
				$_SESSION['id_usuario'] = $fila['id_usuario'];
			  	$_SESSION['csrf_token'] = parent::crear_csrf_token();
			 	$_SESSION['csrf_token_time'] = time();
				$id_usuario = Sqlconsult::escape($_SESSION['id_usuario']);

				// Coupon
				if (isset($_COOKIE['coupon'])) {
					$cupon = Cookie::readCookie('coupon');
					$agregarCupon = new Coupon;
					$agregarCupon->newUserCoupon($cupon['clave_cupon']);
				}
			}	
		}else{
			parent::intentosSesion($this->_data['correo']);
			parent::retornoError('ERROR_VAL_LOG_MAIL_PSW');
		}
		return true;
	}

	private function ajusteBolsa()
	{
		$aCarrito = Cookie::readCookie('bolsa');

		if ($aCarrito == false) {
			$aCarrito = [];
		}
		foreach ($aCarrito as $producto) {
			$data = [
				'id_usuario' => $_SESSION['id_usuario'],
				'id_producto' => $producto['id_producto'],
				'cantidad_bolsa' => $producto['cantidad_bolsa']
			];
			$unique = [
				'conditional' => 'id_producto = ? AND id_usuario= ? AND tm_delete IS NULL',
				'params' => ['ii',$producto['id_producto'],$_SESSION['id_usuario']]
			];
			CRUD::insert('bolsa_compras',$data,$unique);

			$where = 'id_usuario = ? AND id_producto = ? AND tm_delete IS NULL';
			$params = ['ii',$_SESSION['id_usuario'],$producto['id_producto']];
			$buscarBolsaID = CRUD::all('bolsa_compras','id_bolsa_compras',$where,$params);
			$bolsaID = $buscarBolsaID[0]['id_bolsa_compras'];


			/*find personal msn*/
			$where = 'id_bolsa_compras = ?';
			$params = ['i',$bolsaID];
			$findPersonalMsn = CRUD::numRows('venta_personalizar','*',$where,$params);
			/*#find personal msn*/

			if ($findPersonalMsn === 0) {
				$set = [
					'id_bolsa_compras' => $bolsaID,
					'id_producto' => $producto['id_producto'],
					'id_usuario' => $_SESSION['id_usuario'],
					'destinatario' => $producto['destinatario'],
					'motivo' => $producto['motivo'],
					'frase_personalizada' => $producto['frase_personalizada'],
					'mensaje_tarjeta' => $producto['mensaje_tarjeta'],
				];
				$unique = [
					'conditional' => $where,
					'params' => $params
				];
				CRUD::insert('venta_personalizar',$set,$unique);
			}elseif($findPersonalMsn === 1){
				$update = [
					'destinatario' => $producto['destinatario'],
					'motivo' => $producto['motivo'],
					'frase_personalizada' => $producto['frase_personalizada'],
					'mensaje_tarjeta' => $producto['mensaje_tarjeta'],
				];
				CRUD::update('venta_personalizar',$update,$where,$params);
			}
		}
		Cookie::deleteCookie('bolsa');
	}

	private function cargarWishlist()
	{
		$wishlist = Cookie::readCookie('wishlist');

		if ($wishlist == false) {
			$wishlist = [];
		}

		foreach ($wishlist as $producto) {
			User::addWishlist($producto['id_producto']);
		}

		$consulta = CRUD::all('bolsa_deseos','id_producto','id_usuario = ? AND tm_delete = ?',['is',$_SESSION['id_usuario'],NULL]);

		foreach ($consulta as $producto) {
			$data = [
				'id_producto' => $producto['id_producto']
			];
			Cookie::insertInCookie('wishlist',$data,258000,$data);
		}
	}

}