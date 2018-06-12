<?php 

	/**
	* Usuarios
	*/
	class User extends Indexfilters
	{	
		// Datos Especificos
		public $userID;
		public $userName;

		public $informacion_personal = array();
		private $_cus_bag = array();
		private $_cus_wishlist = array();
		private $_cus_address = array();
		private $_cus_orders = array();
		

		static $_estados = array();
		static $ciudades = array();

		function __construct($id_usuario)
		{	
			$this->userID = $id_usuario;
		    $where = 'usuarios.id_usuario = ?';
		    $params = array("i", $id_usuario);
		    $informacion = CRUD::find('usuarios','*, usuarios.id_usuario',$where,$params);

		    while ($info = $informacion[1]->fetch_assoc()) {

		    	$this->informacion_personal = array(
		    			'nombre' => $info['nombre'],
		    			'apellido_usuario' => $info['apellido_usuario'],
		    			'id_rol' => $info['id_rol'],
		    			'correo' => $info['correo'],
		    			'sexo' => $info['sexo'],
		    			'fecha_nacimiento' => $info['fecha_nacimiento'],
		    			'estado_usuario' => $info['estado_usuario'],
		    			'fecha_registro' => $info['fecha_registro']
		    		);
		    	
		    	$this->userName = $info['nombre'];
		    }
		}

		static public function sendEmail($email,$lang = 'en',$process='register')
		{
			$mail = new PHPMailer();
		    if (!$mail->ValidateAddress($email)) {
		         $msn = "por favor ingresa un correo válido";
			     echo $msn;
				return false;
		    }

		   /*Token*/
		   $user = CRUD::all('usuarios','*','correo = ?',['s',$email]);
		   $data = Secure::decodeArray($user[0]);
		   $token = md5($data->nombre."-".$data->apellido_usuario."-".$data->correo."-".SALTREG);

		   // Configuramos el protocolo SMTP con autenticació
	       $mail->IsSMTP();  
	       $mail->SMTPAuth = true;

	       // Configuración del servidor SMTP
	       $mail->Port = 25;  
	       $mail->Host = 'mail.madeitforu.com';
	       $mail->Username   = "service@madeitforu.com";
	       $mail->Password = "ctlb31207";

	       // Configuración cabeceras del mensaje
	       $mail->From = "gifts@madeitforu.com";  
	       $mail->FromName = "MADEITFORU";
	       $mail->AddAddress($email, strtoupper($data->nombre.' '.$data->apellido_usuario));
	       $ruta = "http://www.madeitforu.com/".$lang."/pages/activate/".$email."/".$token.'/'.$process;
	       $token2 = md5($email.SALTREG);
	       $unsubscribeLink = 'http://madeitforu.com/bd/newsletter/unregister.php?correo_news='.$email.'&token='.$token2;

	       if ($lang === 'es') {
	       		$proceso = "Activación de la cuenta";
	       }else{
	       		$proceso = 'Account Activation';
	       }

	       $mail->Subject  = $proceso.' | '.$data->nombre.' '.$data->apellido_usuario;

			require DIRECTORIO_ROOT.'lang/'.$lang.'.php';
	    	require DIRECTORIO_ROOT.'inc/email/newUser.php';  

	       $mail->SetFrom("gifts@madeitforu.com", "MADEITFORU");   
	       $mail->MsgHTML($message);

	        if($mail->Send()) {         
            	return true;      
	        }else{
	            echo "An error has occurred ".$mail->ErrorInfo;
	        }
		}


		public static function estados($order=null,$where=null,$rows='*',$params=[],$join=null,$limit=null)
		{
			$estados = CRUD::find('estados',$rows,$where,$params,$join,$order);

			while ($est = $estados[1]->fetch_assoc()) {
				self::$_estados[$est['id_estado_eu']] = $est['nombre_estado'];
			}

			return Secure::decodeArray(self::$_estados);
		}

		public static function ciudades($order = null,$where=null,$rows='*',$params=[],$join=null,$limit=null)
		{
            $buscarCiudades = CRUD::find('ciudades',$rows,$where,$params,$join,$order,$limit);

            while ($ciu = $buscarCiudades[1]->fetch_assoc()) {
            	self::$ciudades[$ciu['id_ciudad']] = $ciu['nombre_ciudad'];
            }

            return Secure::decodeArray(self::$ciudades);
		}

		public function infoPersonal()
		{
			return $this->informacion_personal;
		}

		public static function addWishlist($productoID)
		{
			if (isset($_SESSION['id_usuario'])) {				
				$unique = [
					'conditional' => "id_usuario = ? AND id_producto = ? AND tm_delete IS NULL",
					'params' => ['ii',$_SESSION['id_usuario'],$productoID]
				];				
				$insert = [
					'id_producto' => $productoID,
					'id_usuario' => $_SESSION['id_usuario']
				];
				return CRUD::insert('bolsa_deseos',$insert,$unique);
			}elseif (isset($_COOKIE['wishlist'])){
				$data = [   
				    [ 'id_producto' => $productoID ]
				];
				return Cookie::insertInCookie('wishlist',$data,258000,'id_producto');
			}else{
				$data = [   
				    [ 'id_producto' => $productoID ]
				];
				return Cookie::createCookie('wishlist',$data);
			}
		}

		static public function removeWishlist($productoID)
		{
			if (isset($_SESSION['id_usuario'])) {	
				$where = 'id_usuario = ? AND id_producto = ?';
				$params = ['ii',$_SESSION['id_usuario'],$productoID];			
				return CRUD::falseDelete('bolsa_deseos',$where,$params);
			}elseif (isset($_COOKIE['wishlist'])){
				return Cookie::delValue('wishlist','id_producto',$productoID);
			}
		}

		public static function wishlist()
		{	
			if (isset($_SESSION['id_usuario'])) {
				$id_user = $_SESSION['id_usuario'];

				// Captura lista de productos deseados
	        	$where = 'id_usuario = ? AND tm_delete IS NULL';
		        $params = ['i',$id_user];
	        	$lista_deseos = CRUD::find('bolsa_deseos','id_producto',$where,$params);
	        	
	        	// Encapsula para enviar solicitud a la bd de los productos
	        	$lista = [];
			    while ($pms = $lista_deseos[1]->fetch_assoc()) {
			    	$lista[] =  $pms['id_producto'];
		    	}    

		    	// Define estructura de la consulta
		    	$where2 = '';
		    	$typeParam = '';
		    	$params = [];
		    	foreach ($lista as $producto) {
		    		$where2 .= ' productos.id_producto = ? OR';  
					$typeParam .= 'i';
		    	}

		    	if (count($lista) > 0) {
		    		$where2 = substr($where2, 0,-2);
		    		array_push($params, $typeParam); 
		    	}

		    	foreach ($lista as $producto) {
		    		array_push($params, $producto);
		    	}	

	    		if (count($lista) > 0) {
	    			return Products::cargarProductos('*',$where2,$params);
	    		}else{
	    			return [];
	    		}
	        	
	    	}elseif (isset($_COOKIE['wishlist'])){
	    		$productosCookie = Cookie::readCookie('wishlist');
	    		if (count($productosCookie) <= 0) {
	    			return [];
	    		}

	    		$where2 = '';
		    	$typeParam = '';
		    	$params = [];
		    	$productos = [];
	    		foreach ($productosCookie as $key => $value) {
	    			$where2 .= ' productos.id_producto = ? OR';
	    			$typeParam .= 'i';
	    			$productos[] = $value['id_producto'];
	    		}
	    		$where2 = substr($where2, 0,-2);
		    	array_push($params, $typeParam); 

		    	foreach ($productos as $producto) {
		    		array_push($params, $producto);
		    	}

	       		return Products::cargarProductos('*, productos.serie',$where2,$params);
	    	}else{
	    		return [];
	    	}
		}

		public static $usuarios_direcciones = [];
		public static function address($usuarioID)
		{
            $params = ['i',$usuarioID];
            $join = [
            	['INNER','estados','estados.id_estado_eu = usuarios_direcciones.id_estado_eu'],
            	['INNER','ciudades','ciudades.id_ciudad = usuarios_direcciones.id_ciudad'],
            ];
            $order = 'usuarios_direcciones.id_direcciones DESC';
            $where = 'usuarios_direcciones.id_usuario = ? AND usuarios_direcciones.tm_delete IS NULL';
            $direcciones_usuario = CRUD::find('usuarios_direcciones','*',$where,$params,$join,$order);
            while ($dir = $direcciones_usuario[1]->fetch_assoc()) {
            	self::$usuarios_direcciones[] = [
        			'id_direcciones' => $dir['id_direcciones'],
        			'nombre_direccion' => $dir['nombre_direccion'],
        			'apellido_direccion' => $dir['apellido_direccion'],
        			'id_estado_eu' => $dir['id_estado_eu'],
        			'nombre_estado' => $dir['nombre_estado'],
        			'id_ciudad' => $dir['id_ciudad'],
        			'nombre_ciudad' => $dir['nombre_ciudad'],
        			'direccion' => $dir['direccion'],
        			'telefono' => $dir['telefono'],
        			'zip_code' => $dir['zip_code'],
        			'tm_delete' => $dir['tm_delete'],
        		];
            }
            return self::$usuarios_direcciones;
		}

		public function addAddress()
		{
			if (isset($_SESSION['id_usuario'])) {
				
			}
		}


		public static function orders($id_user)
		{
	        $params = array("i",$id_user);
	        $join = [
	        	['INNER','estados_pedido','estados_pedido.id_estado = venta_detalle.id_estado']
	        ];
	        $order = ' fecha_venta DESC';
	        $pedidos = CRUD::find('venta_detalle','*','venta_detalle.id_usuario = ?',$params,$join,$order);

	        $ordenes = [];
	        while ($ped = $pedidos[1]->fetch_assoc()) {
	    		$ordenes[] = array(
	    			'id_venta_detalle' => $ped['id_venta_detalle'],
	    			'serial_venta' => $ped['serial_venta'],
	    			'precio_productos' => $ped['precio_productos'],
	    			'precio_envio' => $ped['precio_envio'],
	    			'venta_descuento' => $ped['venta_descuento'],
	    			'precio_total' => $ped['precio_total'],
	    			'fecha_venta' => $ped['fecha_venta'],
	    			'id_estado' => $ped['id_estado'],
	    			'nombre_envio' => $ped['nombre_envio'],
	    			'direccion_envio' => $ped['direccion_envio'],
	    			'barrio_envio' => $ped['barrio_envio'],
	    			'id_ciudad_envio' => $ped['id_ciudad_envio'],
	    			'id_departamento_envio' => $ped['id_departamento_envio'],
	    			'telefono_envio' => $ped['telefono_envio']
	    		);     	
	        }
	        return $ordenes;
		}

		static public function usersList()
		{	
			$join = [
				['INNER','roles','roles.id_rol = usuarios.id_rol'],
			];
			$order = 'usuarios.fecha_registro DESC';
			$usuarios = CRUD::find('usuarios','*, usuarios.id_usuario, usuarios.tm_delete',null,[],$join,$order);

			$users = [];
	        while ($ped = $usuarios[1]->fetch_assoc()) {
	    		$users[] = array(
	    			'id_usuario' => $ped['id_usuario'],
	    			'nombre' => $ped['nombre'],
	    			'apellido_usuario' => $ped['apellido_usuario'],
	    			'correo' => $ped['correo'],
	    			'sexo' => $ped['sexo'],
	    			'rol' => $ped['rol'],
	    			'fecha_nacimiento' => $ped['fecha_nacimiento'],
	    			'estado_usuario' => $ped['estado_usuario'],
	    			'fecha_registro' => $ped['fecha_registro'],
	    			'tm_delete' => $ped['tm_delete']
	    		);     	
	        }
	        return $users;
		}

	}







 ?>