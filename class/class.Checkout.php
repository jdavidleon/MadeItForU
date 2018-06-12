<?php 
	/**
	* Gestion de datos para facturación 
	*/
	class Checkout{

		public $cantidad_bolsa = 0;
		public $cantidad_bolsa_agotados = 0;
		private $_idUser;
		private $_consultaBolsa = [];
		private $_consultaBolsaAgotados = [];

		// Calculo precios carrito Compras
		public $_totalPagar = 0;
	    public $_totalDescuento = 0;
	    public $_totalAntesDeDescuento = 0;
	    public $precioFinal = 0;
	    public $costoEnvio = 0;
	    public $cupon = 0;

	    // Resume
	    public $totalDescuento = 0;
	    public $totalAntesDeDescuento = 0;
	    public $totalProductos = 0;
	    
	    // productos Bolsa
	    public $productosBolsa = [];
	    public $productosBolsaAgotados = [];

		function __construct(){	
			if (isset($_SESSION['id_usuario'])) {
				$this->_idUser = $_SESSION['id_usuario'];
				/*Validacion Bolsa*/
				$rows = '*, (productos_cantidad.cantidad_entrada - productos_cantidad.cantidad_salida) as disponibles';
		        $where = 'bolsa_compras.id_usuario = ? AND bolsa_compras.tm_delete IS NULL AND productos_publicados.estado_publicado = ?';
		        $params = array("is",$this->_idUser,'SI');	
		        $join = [
		        	['INNER','productos','productos.id_producto = bolsa_compras.id_producto'],
		        	['INNER','productos_cantidad','productos_cantidad.id_producto = productos.id_producto'],
		            ['INNER','categorias','categorias.id_categoria = productos.id_categoria'],
		            ['LEFT','categorias_sub','categorias_sub.id_sub_categoria = productos.id_sub_categoria'],
		        	['INNER','productos_imagenes_principales','productos_imagenes_principales.id_producto = productos.id_producto'],
		        	['LEFT','productos_publicados','productos_publicados.serie = productos.serie']
		        ];
		        $consulta_bolsa = CRUD::find('bolsa_compras',$rows,$where,$params,$join,'productos.serie');        

		        while ($consultaB = $consulta_bolsa[1]->fetch_assoc() ) {
		        	// if ($consultaB['disponibles'] < 1) {
		        	// 		$consultaB['disponibles'] = 1;
		        	// }
		        	if ($consultaB['disponibles'] < $consultaB['cantidad_bolsa']) {
		        		$set = ['cantidad_bolsa' => $consultaB['disponibles'] ];
		        		$where = 'id_bolsa_compras = ?';
		        		$params = ['i',$consultaB['id_bolsa_compras']];
		        		$actualizar = CRUD::update('bolsa_compras',$set,$where,$params);
		        		$cantidad_bolsa = $consultaB['disponibles'];
		        	}else{
		        		$cantidad_bolsa = $consultaB['cantidad_bolsa'];
		        	}
		        	if ($consultaB['disponibles'] > 0) {
		        		$this->productosBolsa[] = self::arrayProductosBolsa($consultaB,$consultaB['id_bolsa_compras'],$cantidad_bolsa);
		        		$this->cantidad_bolsa++;
		        	}elseif ($consultaB['disponibles'] == 0) {
		        		$this->productosBolsaAgotados[] = self::arrayProductosBolsa($consultaB,$consultaB['id_bolsa_compras'],0);
		        		$this->cantidad_bolsa_agotados++;
		        	}		        	
		        }
			}elseif (isset($_COOKIE['bolsa'])) {
		        $aCarrito = Cookie::readCookie('bolsa');

		        foreach ($aCarrito as $value) {
		         	//Productos Disponibles
		         	$rows = '*, (productos_cantidad.cantidad_entrada - productos_cantidad.cantidad_salida) as disponibles';
			        $where = 'productos.id_producto = ?';
			        $params = ['i',$value['id_producto']];	
			        $join = [
			        	['INNER','productos_cantidad','productos_cantidad.id_producto = productos.id_producto'],
			            ['INNER','categorias','categorias.id_categoria = productos.id_categoria'],
			            ['LEFT','categorias_sub','categorias_sub.id_sub_categoria = productos.id_sub_categoria'],
			        	['INNER','productos_imagenes_principales','productos_imagenes_principales.id_producto = productos.id_producto'],
		        		['LEFT','productos_publicados','productos_publicados.serie = productos.serie'],
			        ];
		         	$consulta_bolsa = CRUD::find('productos',$rows,$where,$params,$join,'productos.serie');
		         	
		         	while ($consultaB = $consulta_bolsa[1]->fetch_assoc() ) {
			        	if ($consultaB['disponibles'] < $value['cantidad_bolsa']) {
			        		$key = [
			        			'id_producto' => $value['id_producto']
			        		];
			        		$data = [
			        			'cantidad_bolsa' => $consultaB['disponibles']
			        		];
			        		$actualizar = Cookie::updateCookie('bolsa',$key,$data);

			        		$cantidad_bolsa = $consultaB['disponibles'];
			        	}else{
			        		$cantidad_bolsa = $value['cantidad_bolsa'];
			        	}
			        	if ($consultaB['disponibles'] > 0) {
			        		$this->productosBolsa[] = self::arrayProductosBolsa($consultaB,'null',$cantidad_bolsa);
			        		$this->cantidad_bolsa++;
			        	}elseif ($consultaB['disponibles'] == 0) {
			        		$this->productosBolsaAgotados[] = self::arrayProductosBolsa($consultaB,null,0);
			        		$this->cantidad_bolsa_agotados++;
			        	}		        	
			        }
		        }

		        $this->cantidad_bolsa = count($this->productosBolsa);
		    }else {
		        $this->cantidad_bolsa = 0;
		    }   
		}/*Constructor*/

		public static function arrayProductosBolsa($pms,$bolsaID = 'null',$cantidadBolsa=0)
		{
			$datoDescuento = Indexfilters::buscarDescuento($pms['id_producto'],$pms['precio']);

          	$arrayProductos = array(
          		'id_bolsa_compras' => $bolsaID,
                'id_producto' =>  $pms['id_producto'],
                'cantidad_bolsa' =>  $cantidadBolsa,
                'serie' =>  $pms['serie'],
                'nombre_producto_es' =>  $pms['nombre_producto_es'],
                'nombre_producto_en' =>  $pms['nombre_producto_en'],
                'categoria_es' => $pms['categoria_es'],
                'categoria_en' => $pms['categoria_en'],
                'nombre_sub_categoria_es' => $pms['nombre_sub_categoria_es'],
                'cantidad_entrada' => $pms['cantidad_entrada'],
                'cantidad_salida' => $pms['cantidad_salida'],
                'disponibles' => $pms['disponibles'],
                'ruta_img_lg' =>  $pms['ruta_img_lg'],
                'ruta_img_sm' =>  $pms['ruta_img_sm'],
                'ruta_img_tn' =>  $pms['ruta_img_tn'],
                'precioAntesDescuento' => $pms['precio'],
                'porcentajeDescuento' => $datoDescuento['porcentaje'],
                'descuentoPorUnidad' => $datoDescuento['valorDescuento'],
                'descuentoPorProducto' => $datoDescuento['valorDescuento'] * $cantidadBolsa,
                'precio' => $datoDescuento['precio_final'],
                'precio_total' => $datoDescuento['precio_final']*$cantidadBolsa,
          	);
          	return $arrayProductos;
		}

	   		
   		public function resumenCarrito()
   		{	
   			foreach ($this->productosBolsa as $producto) {
   				// Descuentos
	            $datoDescuento = Indexfilters::buscarDescuento($producto['id_producto'],$producto['precio'] );  

	            $this->totalDescuento += $producto['descuentoPorProducto'];
	            $this->totalAntesDeDescuento += $producto['precio'] * $producto['cantidad_bolsa'];
	            $this->totalProductos += $producto['precio_total'];
	   		}

            /*PRECIO FINAL*/
            $this->precioFinal = $this->totalAntesDeDescuento + $this->costoEnvio - $this->totalDescuento - $this->cupon;
            /*PRECIO FINAL*/	
   		}

   		static public function disponibilidad($bolsaID)
   		{	
   			$join = [
   				['INNER','productos_cantidad','productos_cantidad.id_producto = bolsa_compras.id_producto']
   			];
   			$where = 'bolsa_compras.id_bolsa_compras = ?';
   			$params = ['i',$bolsaID];
   			$rows = '(productos_cantidad.cantidad_entrada - productos_cantidad.cantidad_salida) as disponibles, cantidad_bolsa';
   			$buscar = CRUD::all('bolsa_compras',$rows,$where,$params,$join);

   			return $buscar;
   		}

   		// Used to migrate products from Cookies to DB of a Logged in User
   		public function migrarProductos()
   		{	
   			if (isset($_COOKIE['bolsa']) AND isset($_SESSION['id_usuario'])) {
   				$bolsa = Cookie::readCookie('bolsa');
   				foreach ($bolsa as $producto) {
	   				$dataProducto = [
	   					'id_producto' => $producto['id_producto']
	   				];
	   				self::agregarCarrito($dataProducto,$producto['cantidad']);
	   			}
	   			Cookie::deleteCookie('bolsa');
   			} 		
   		}

   		public static function agregarCarrito($data)
   		{	
   			/*Validar Cantidad disponible*/
   			$rows = '(cantidad_entrada - cantidad_salida) as disponibles';
   			$where = 'id_producto = ?';
   			$params = ['i',$data['id_producto']];
   			$disponibilidad = CRUD::all('productos_cantidad',$rows,$where,$params);

   			if (count($disponibilidad) < 1) {
   				echo "No existe el producto";
   				return false;
   			}

   			$disp = $disponibilidad[0]['disponibles'];

   			if ($disp === 0) {
   				echo 'No hay suficientes unidades del producto que solicitaste';
				return false;
   			}elseif ($disp < $data['cantidad_bolsa'] ) {
   				$data['cantidad_bolsa'] = $disp;
   			}
   			/*Validar Cantidad disponible*/


   			if (isset($_SESSION['id_usuario'])) {	

				$data['id_usuario'] = $_SESSION['id_usuario'];	
				$data = [
					'id_usuario' => $data['id_usuario'], 
					'id_producto' => $data['id_producto'],
					'cantidad_bolsa' => $data['cantidad_bolsa']
				];
				$unique = [
					'conditional' => 'id_usuario = ? AND id_producto = ? AND tm_delete IS NULL',
					'params' => ['ii',$data['id_usuario'], $data['id_producto']]
				];

				if (CRUD::insert('bolsa_compras',$data,$unique) === false) {
					echo 'BAG_ERROR_EXIST';
					return false;
				}else{
					echo 'success_product_add';
					return false;
				}
			}elseif (isset($_COOKIE['bolsa'])) {
				$data = [ 
					[
						'id_producto' => (int) $data['id_producto'],
						'cantidad_bolsa' => (int) $data['cantidad_bolsa'],
						'destinatario' => '',
						'motivo' => '',
						'frase_personalizada' => '',
						'mensaje_tarjeta' => '',
					]
				];

				$insertar = Cookie::insertInCookie('bolsa',$data,258000,'id_producto');

				if ($insertar == false) {
					echo 'BAG_ERROR_EXIST';
					return false;
				}else{
					echo 'success_product_add';
					return false;					
				}
			}else{
				$bolsa[0]['id_producto'] = (int) $data['id_producto'];
				$bolsa[0]['cantidad_bolsa'] = (int) $data['cantidad_bolsa'];
				$bolsa[0]['destinatario'] = '';
				$bolsa[0]['motivo'] = '';
				$bolsa[0]['frase_personalizada'] = '';
				$bolsa[0]['mensaje_tarjeta'] = '';

				if (Cookie::createCookie('bolsa',$bolsa)) {
					echo 'success_product_add';
					return false;
				}
				return false;
			}	
	   	}
	}

		


 ?>