<?php 
	/**
	* Configuracion inicial del proyecto
	*/
	class Config 
	{	
		private $_tables = [];
		private $_bd = 'mifu_bd'; /* DATABASE NAME */

		function __construct()
		{	
			/*Crear BD*/
			// $bd = 'CREATE DATABASE '.$this->_bd;
			// $enlace = new mysqli("localhost","root","");

			// if ($enlace->query($bd)) {
			// 	echo "Base de datos ".$this->_bd;
			// }else{
			// 	echo "Ya existe la base de datos ".$this->_bd;
			// }

			$tablesToDelete = [
				// 'cedulas',
				// 'testimonials_img',
				// 'testimonials_msn',
				// 'usuarios',
				// 'usuarios_direcciones',
				// 'usuarios_intentos',
				// 'usuarios_restaurar_psw',
				// 'usuario_cupon',
				// 'categorias',
				// 'categorias_sub',
				// 'mantenimiento',
				// 'mantenimiento_ip',
				// 'bolsa_compras',
				// 'productos',
				// 'productos_imagenes',
				// 'productos_imagenes_principales',
				// 'productos_cantidad',
				// 'productos_items',
				// 'productos_item',
				// 'productos_items_tipos',
				// 'productos_descuento',
				// 'productos_con_items',
				// 'estados',
				// 'ventas',
				// 'venta_detalle',
				// 'productos_publicados',
				// 'venta_token',
				// 'newsletter',
				// 'contactenos',
				// 'venta_personalizar',
				// 'tipos_cupones',
				// 'productos_cupones',
				// 'ingreso_productos_gral',
				// 'estados_pedido'
			];
			
			if ($this->deleteTable($tablesToDelete) === true) {
				echo "Tablas restauradas correctamente: ";
				echo "<br>";
				foreach ($tablesToDelete as $table) {
					echo strtoupper($table)." // ";
				}
				echo "<br>";
				echo "<br>";
			}

			$this->runTables();
			
			/*Definiendo administradores*/
			$usuarios = [
				['JUAN DAVID','LEON PONCE','jlp25@hotmail.com','M',1,'ctlb31207',1],
				['ANA LUCIA','BARONA','gifts@madeitforu.com','F',1,'anabarona2017',1]
			];

			foreach ($usuarios as $usuario) {
				$set = [
					'nombre' => $usuario[0],
					'apellido_usuario' => $usuario[1],
					'correo' => $usuario[2],
					'sexo' => $usuario[3],
					'id_rol' => $usuario[4],
					'clave' => Secure::montar_clave_verificacion($usuario[5]),
					'estado_usuario' => $usuario[6]
				];

				$unique = [
					'conditional' => 'correo = ?',
					'params' => ['s',$usuario[2]]
				];
				CRUD::insert('usuarios',$set,$unique);	
			}		

			/*#MANTENIMIENTO*/
			$mantenimiento = ['activo'];
			foreach ($mantenimiento as $mnt) {
				$set = ['estado' => $mnt, 'fecha_mantenimiento' => '2017-06-13 17:00'];
				$unique = [
					'conditional' => 'id_mantenimiento = ?',
					'params' => ['i',1]
				];
				CRUD::insert('mantenimiento',$set,$unique);
			}

			/*#MANTENIMIENTO IP's*/
			$mantenimiento_ip = ['186.83.17.60', '181.54.6.126', '::1'];
			foreach ($mantenimiento_ip as $mnt) {
				$set = ['id_mantenimiento' => 1, 'direccion_ip' => $mnt];
				$unique = [
					'conditional' => 'direccion_ip = ?',
					'params' => ['s',$mnt]
				];
				CRUD::insert('mantenimiento_ip',$set,$unique);
			}

			/*#ROLES*/
			$roles = ['ADMINISTRADOR','USUARIO'];
			foreach ($roles as $rol) {
				$set = ['rol' => $rol];
				$unique = [
					'conditional' => 'rol = ?',
					'params' => ['s',$rol]
				];
				CRUD::insert('roles',$set,$unique);
			}

			/* #CATEGORIAS */
			$categorias = [
				['CUMPLEAÑOS','BIRTHDAY','BRT'],
				['MADRES','MOTHERS DAY','MD'],
				['ANIVERSARIO','ANIVERSARY','ANI'],
				['PELUCHES Y CHOCOLATES','TEDDIES AND CHOCOLATES','CCH']
			];
			
			foreach ($categorias as $categoria) {
				$set = [ 'categoria_es' => $categoria[0],'categoria_en' => $categoria[1] ,'identificador' => $categoria[2] ];
				$unique = [
					'conditional' => 'categoria_es = ? OR categoria_en = ? OR identificador = ?',
					'params' => ['sss',$categoria[0],$categoria[1],$categoria[2]]
				];
				CRUD::insert('categorias',$set,$unique);
			}

			/* #CATEGORIAS */
			$categorias_sub = [
				[1,'PERSONA ESPECIAL','SPECIAL PERSON'],
				[1,'NIÑO','CHILD'],
				[1,'NIÑA','LITTLE GIRL']
			];
			
			foreach ($categorias_sub as $subCategoria) {
				$set = [ 'id_categoria' => $subCategoria[0], 'nombre_sub_categoria_es' => $subCategoria[1], 'nombre_sub_categoria_en' => $subCategoria[2] ];
				$unique = [
					'conditional' => 'nombre_sub_categoria_es = ? OR nombre_sub_categoria_en = ?',
					'params' => ['ss',$subCategoria[1],$subCategoria[2]]
				];
				CRUD::insert('categorias_sub',$set,$unique);
			}

			/* #OFERTAS */
			$ofertas = ['DESCUENTO','CUPONES','OFERTA DEL DIA'];

			foreach ($ofertas as $oferta) {
				$set = [ 'tipo_oferta' => $oferta ];
				$unique = [
					'conditional' => 'tipo_oferta = ?',
					'params' => ['s',$oferta]
				];
				CRUD::insert('ofertas',$set,$unique);
			}

			$ofertas_descuentos = [
				['PRODUCTO','Agrega un descuento para un producto o un conjunto de productos específicos.'],
				['COMPRAS MAYOR A','Agrega un descuento que aplique a compras con un valor mayor a un coste determinado.'],
				['ENVIO GRATIS','Establece un monto mínimo de compra para proporcionar el envio gratis de una compra.'],
			];

			foreach ($ofertas_descuentos as $oferta) {
				$set = [ 'tipo_descuento' => $oferta[0], 'descripcion_descuento' => $oferta[1] ];
				$unique = [
					'conditional' => 'tipo_descuento = ?',
					'params' => ['s',$oferta[0]]
				];
				CRUD::insert('ofertas_descuentos',$set,$unique);
			}


			/* #ESTADOS */
			$estados = [
				['Pendiente de pago','Pending payment'],
				['Verificación pago','Payment Verification'],
				['Alistamiento','Enlistment'],
				['Enviado','Shipping'],
				['Completado','Complete'],
				['Cancelado','Cancelled'],
				['Devolución','Return'],
				['Transacción rechazada','Transaction declined'],
				['Esperando respuesta del pago','Waiting for payment response'],
				['Declinada','Transaction declined']
			];

			foreach ($estados as $estado) {
				$set = [	
					'estado_es' => $estado[0],  
					'estado_en' => $estado[1]		
				];
				$unique = [
					'conditional' => 'estado_es = ?',
					'params' => ['s',$estado[0]]
				];				
				CRUD::insert('estados_pedido',$set,$unique);
			}

			/* #CUPON */
			$cupones = [
				['BASICO','Aplica porcentaje de descuento para cualquier tipo de compra sin importar producto o valor de la compra.'],
				['COMPRA MINIMA','Aplica cupón solo si el valor de la compra supera un monto mínimo.'],
				['POR PRODUCTO','Este aplicará un cupón a un produto en especifico unicamente']
			];

			foreach ($cupones as $cupon) {
				$set = [ 'tipo_cupon' => $cupon[0], 'descripcion_cupon' => $cupon[1]];
				$unique = [
					'conditional' => 'tipo_cupon = ?',
					'params' => ['s',$cupon[0]]
				];
				CRUD::insert('tipos_cupones',$set,$unique);
			}		

			$items_tipos = [
				'CONTENEDOR', 'ADORNO', 'COMIDA', 'BEBIDA', 'COMPLEMENTO'
			];

			foreach ($items_tipos as $tipoID => $tipo) {
				$set = [ 'tipo_item' => $tipo ];
				$unique = [
					'conditional' => 'tipo_item = ?',
					'params' => ['s',$tipo]
				];
				CRUD::insert('productos_items_tipos',$set,$unique);
			}

			$this->editColumn('productos','nombre_producto','nombre_producto_en','VARCHAR(60)');
			$this->addColumn('productos','nombre_producto_es','VARCHAR(60)','nombre_producto_en');
			$this->addColumn('productos_items','id_tipo_item','SMALLINT(6)','item_en');
			$this->addColumn('venta_detalle','fecha_entrega','DATE ','id_direccion_envio');
			$this->addColumn('venta_detalle','tm_delete','DATE ','fecha_entrega');
			/* #Ciudades y Departamentos */
			$this->ubicaciones();
		}

		private function cedulas()
		{
			$tiempoInicial = microtime(true);
			for ($i=0; $i <= 700000; $i++) { 
				$set = [
					'cedula' => Secure::numeroAleatoreo(9),
					'nombre' => Secure::letrasAleatoreo(9)
				];
				$insertar = CRUD::insert('cedulas',$set);
			}
			// $ar=fopen("datos.php","a") or
			//     die("Problemas en la creacion");
			// fputs($ar,'<?php [ ');
			// fputs($ar,"\n");
			// fputs($ar,'[938174725,"calJCyoHb"],');

			// foreach ($set as $key => $value) {
			// 	fputs($ar,"[".$value['cedula'].", '".$value['nombre']."'], \n");
			// }

			// fputs($ar,"\n");
			// fputs($ar," ]");
			// fputs($ar,"\n");
			// fclose($ar);

			echo (microtime(true) - $tiempoInicial) / 60;
		}

		private function runTables()
		{	
			/*
				$rows = [		
					0 => 'nameRow',
					1 => $type=VARCHAR(30),
					2 => 'unsigned=false',
					3 => 'not null = false',
					4 => 'autoincrement=false',
					5 => 'primary_key=false',
					6 => $default='data'
				]
			*/

			$tables[] = [
				'nombre' => 'cedulas',
				'filas' => [
					['id_cedula','INT(11)',true,true,true,true,''],
					['cedula','BIGINT(15)',true,true,false,false,''],
					['nombre','VARCHAR(100)',false,true,false,false,'']
				]
			];

			$tables[] = [
				'nombre' => 'mantenimiento',
				'filas' => [
					['id_mantenimiento','INT(1)',true,false,true,true,''],
					['estado','VARCHAR(60)',false,true,false,false,''],
					['fecha_mantenimiento','DATETIME',false,false,false,false,'']
				]
			];

			$tables[] = [
				'nombre' => 'mantenimiento_ip',
				'filas' => [
					['id_ip','INT(1)',true,false,true,true,''],
					['id_mantenimiento','VARCHAR(20)',false,false,false,false,''],
					['direccion_ip','VARCHAR(50)',false,true,false,false,'']
				]
			];

			$tables[] = [ 
				'nombre' => 'usuarios',
				'filas' => [
						['id_usuario','INT(6)',true,false,true,true,''],
						['nombre','VARCHAR(60)',false,true,false,false,''],
						['apellido_usuario','VARCHAR(60)',false,true,false,false,''],
						['correo','VARCHAR(50)',false,true,false,false,''],
						['sexo','VARCHAR(2)',false,true,false,false,''],
						['id_rol','TINYINT(1)',true,true,false,false,3],
						['clave','VARCHAR(50)',false,true,false,false,''],
						['fecha_nacimiento','DATE',false,false,false,false,''],
						['estado_usuario','INT(1)',true,true,false,false,9],
						['fecha_registro','DATETIME',false,false,false,false,'CURRENT_TIMESTAMP'],
						['tm_delete','DATETIME',false,false,false,false,'']
					]	
			];

			$tables[] = [
				'nombre' => 'usuarios_direcciones',
				'filas' => [
						['id_direcciones','INT(10)',true,false,true,true,''],
						['id_usuario','INT(11)',true,true,false,false,''],
						['nombre_direccion','VARCHAR(35)',false,true,false,false,''],
						['apellido_direccion','VARCHAR(35)',false,true,false,false,''],
						['id_estado_eu','SMALLINT(5)',true,true,false,false,''],
						['id_ciudad','SMALLINT(5)',true,true,false,false,''],
						['direccion','VARCHAR(40)',false,true,false,false,''],
						['telefono','BIGINT(15)',true,true,false,false,''],
						['zip_code','INT(7)',false,true,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'usuarios_intentos',
				'filas' => [
						['id_intentos','INT(10)',true,false,true,true,''],
						['correo_usuario','VARCHAR(40)',false,true,false,false,''],
						['intentos','TINYINT(2)',true,true,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'usuarios_restaurar_psw',
				'filas' => [
						['id_restaurar','INT(10)',true,false,true,true,''],
						['correo','VARCHAR(100)',false,true,false,false,''],
						['token','VARCHAR(40)',false,true,false,false,''],
						['tm_solicitud','DATETIME',false,true,false,false,'CURRENT_TIMESTAMP']
					]
			];

			$tables[] = [ 
				'nombre' => 'roles',
				'filas' => [
						['id_rol','TINYINT(2)',true,false,true,true,''],
						['rol','VARCHAR(15)',false,true,false,false,'']
					]	
			];

			$tables[] = [ 
				'nombre' => 'usuario_cupon',
				'filas' => [
						['id_usuario_cupon','INT(10)',true,false,true,true,''],
						['id_producto_cupon','INT(11)',true,true,false,false,''],
						['id_usuario','INT(11)',true,true,false,false,''],
						['tm_create','DATETIME',false,false,false,false,'CURRENT_TIMESTAMP'],
						['tm_used','DATETIME',false,false,false,false,''],
						['tm_expire','DATETIME',false,false,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,''],
					]	
			];

			$tables[] = [ 
				'nombre' => 'usuarios_lang',
				'filas' => [
						['id_usuario_lang','INT(10)',true,false,true,true,''],
						['id_usuario','INT(11)',true,true,false,false,''],
						['lang','CHAR(2)',false,true,false,false,''],
					]	
			];

			$tables[] = [ 
				'nombre' => 'bolsa_compras',
				'filas' => [
						['id_bolsa_compras','INT(11)',true,false,true,true,''],
						['id_usuario','INT(11)',true,true,false,false,''],
						['id_producto','INT(6)',true,true,false,false,''],
						['cantidad_bolsa','TINYINT(3)',true,true,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,'']
					]	
			];

			$tables[] = [ 
				'nombre' => 'categorias',
				'filas' => [
						['id_categoria','TINYINT(3)',true,false,true,true,''],
						['categoria_es','VARCHAR(35)',false,true,false,false,''],
						['categoria_en','VARCHAR(35)',false,true,false,false,''],
						['identificador','VARCHAR(4)',false,true,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,'']
					]	
			];

			$tables[] = [ 
				'nombre' => 'categorias_sub',
				'filas' => [
						['id_sub_categoria','SMALLINT(5)',true,false,true,true,''],
						['id_categoria','TINYINT(3)',true,true,false,false,''],
						['nombre_sub_categoria_es','VARCHAR(20)',false,true,false,false,''],
						['nombre_sub_categoria_en','VARCHAR(20)',false,true,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,'']
					]	
			];

			$tables[] = [
				'nombre' => 'productos',
				'filas' => [
						['id_producto','SMALLINT(6)',true,false,true,true,''],
						['serie','VARCHAR(10)',false,true,false,false,''],
						['nombre_producto','VARCHAR(60)',false,true,false,false,''],
						['id_categoria','TINYINT(3)',true,true,false,false,''],
						['id_sub_categoria','TINYINT(3)',true,true,false,false,''],
						['precio','INT(11)',true,true,false,false,''],
						['fecha_entrada','DATETIME',false,false,false,false,'CURRENT_TIMESTAMP'],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'productos_cantidad',
				'filas' => [
						['id_cantidades	','SMALLINT(6)',true,false,true,true,''],
						['id_producto','SMALLINT(6)',true,true,false,false,''],
						['cantidad_entrada','SMALLINT(5)',true,true,false,false,''],
						['cantidad_salida','SMALLINT(5)',true,true,false,false,'0']
					]
			];

			$tables[] = [
				'nombre' => 'productos_items_tipos',
				'filas' => [
						['id_tipo_item','SMALLINT(6)',true,false,true,true,''],
						['tipo_item','VARCHAR(100)',false,true,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];


			$tables[] = [
				'nombre' => 'productos_items',
				'filas' => [
						['id_item','SMALLINT(6)',true,false,true,true,''],
						['item_es','VARCHAR(100)',false,true,false,false,''],
						['item_en','VARCHAR(100)',false,true,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'productos_con_items',
				'filas' => [
						['id_prod_item','SMALLINT(6)',true,false,true,true,''],
						['id_producto','INT(10)',true,true,false,false,''],
						['id_item','SMALLINT(10)',false,true,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'productos_descuento',
				'filas' => [
						['id_promo','SMALLINT(6)',true,false,true,true,''],
						['id_producto','SMALLINT(6)',true,true,false,false,''],
						['porcentaje','TINYINT(3)',true,true,false,false,''],
						['valor_descontado','INT(8)',true,true,false,false,''],
						['fecha_inicial','DATETIME',false,true,false,false,'CURRENT_TIMESTAMP'],
						['fecha_limite','DATETIME',false,true,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'productos_cupones',
				'filas' => [
						['id_producto_cupon','INT(10)',true,false,true,true,''],
						['clave_cupon','VARCHAR(30)',false,true,false,false,''],
						['id_tipo_cupon','TINYINT(2)',true,true,false,false,''],
						['id_producto','INT(10)',true,false,false,false,''],
						['porcentaje','TINYINT(3)',true,false,false,false,''],
						['valor_descontado','INT(10)',true,false,false,false,''],
						['valor_compra_minima','INT(10)',true,false,false,false,''],
						['fecha_inicial','DATETIME',false,true,false,false,'CURRENT_TIMESTAMP'],
						['fecha_limite','DATETIME',false,false,false,false,''],
						['cupones_disponibles','SMALLINT(6)',true,false,false,false,''],
						['cupones_usados','SMALLINT(6)',true,true,false,false,'0'],
						['maximo_usuario','SMALLINT(6)',true,true,false,false,'1'],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'productos_imagenes',
				'filas' => [
						['id_p_imagenes','SMALLINT(6)',true,false,true,true,''],
						['serie','VARCHAR(20)',false,true,false,false,''],
						['ruta_img_lg','VARCHAR(120)',false,true,false,false,''],
						['ruta_img_sm','VARCHAR(120)',false,true,false,false,''],
						['ruta_img_tn','VARCHAR(120)',false,true,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'productos_imagenes_principales',
				'filas' => [
						['id_pip','SMALLINT(6)',true,false,true,true,''],
						['id_producto','SMALLINT(6)',true,true,false,false,''],
						['ruta_img_lg','VARCHAR(120)',false,true,false,false,''],
						['ruta_img_sm','VARCHAR(120)',false,true,false,false,''],
						['ruta_img_tn','VARCHAR(120)',false,true,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];


			$tables[] = [
				'nombre' => 'productos_publicados',
				'filas' => [
						['id_publicacion','INT(10)',true,false,true,true,''],
						['serie','VARCHAR(10)',false,true,false,false,''],
						['estado_publicado','CHAR(2)',false,true,false,false,''],
						['fecha_publicacion','DATETIME',false,true,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'contactenos',
				'filas' => [
						['id_contactenos','MEDIUMINT(7)',true,false,true,true,''],
						['nombre_contacto','VARCHAR(60)',false,true,false,false,''],
						['telefono_contacto','VARCHAR(60)',false,true,false,false,''],
						['correo_contacto','VARCHAR(50)',false,true,false,false,''],
						['asunto_contacto','VARCHAR(50)',false,true,false,false,''],
						['mensaje_contacto','TEXT(1000)',false,true,false,false,''],
						['fecha_contacto','DATETIME',false,true,false,false,'CURRENT_TIMESTAMP']
					]
			];


			$tables[] = [
				'nombre' => 'newsletter',
				'filas' => [
						['id_news','MEDIUMINT(7)',true,false,true,true,''],
						['correo_news','VARCHAR(60)',false,true,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'ventas',
				'filas' => [
						['id_venta','INT(11)',true,false,true,true,''],
						['serial_venta','VARCHAR(35)',false,true,false,false,''],
						['id_producto','SMALLINT(6)',true,true,false,false,''],
						['cantidad','SMALLINT(4)',true,true,false,false,''],
						['item_list','VARCHAR(200)',false,true,false,false,''],
						['precio_unitario','INT(11)',true,true,false,false,''],
						['descuento','INT(11)',true,true,false,false,''],
						['precio_total_producto','INT(11)',true,true,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'venta_detalle',
				'filas' => [
					['id_venta_detalle','INT(11)',true,false,true,true,''],
					['serial_venta','VARCHAR(35)',false,true,false,false,''],
					['id_usuario','SMALLINT(6)',true,true,false,false,''],
					['precio_productos','MEDIUMINT(8)',true,true,false,false,''],
					['precio_envio','MEDIUMINT(8)',true,true,false,false,''],
					['venta_descuento','MEDIUMINT(8)',true,true,false,false,''],
					['id_producto_cupon','SMALLINT(6)',true,false,false,false,''],
					['valor_cupon','MEDIUMINT(8)',true,false,false,false,''],
					['precio_total','MEDIUMINT(8)',true,true,false,false,''],
					['fecha_venta','DATETIME',false,true,false,false,''],
					['id_estado','TINYINT(3)',true,true,false,false,''],
					['id_direccion_envio','MEDIUMINT(6)',true,true,false,false,'']
				]
			];

			$tables[] = [
				'nombre' => 'venta_personalizar',
				'filas' => [
					['id_frase_personalizada','INT(11)',true,false,true,true,''],
					['serial_venta','VARCHAR(50)',false,false,false,false,''],
					['id_bolsa_compras','INT(10)',true,true,false,false,''],
					['id_producto','INT(10)',true,true,false,false,''],
					['id_usuario','INT(11)',true,true,false,false,''],
					['destinatario','VARCHAR(100)',false,true,false,false,''],
					['motivo','VARCHAR(20)',false,true,false,false,''],
					['frase_personalizada','VARCHAR(35)',false,true,false,false,''],
					['mensaje_tarjeta','VARCHAR(250)',false,true,false,false,''],
					['tm_delete','DATETIME',false,false,false,false,'']
				]
			];

			$tables[] = [
				'nombre' => 'venta_token',
				'filas' => [
					['id_venta_token','INT(11)',true,false,true,true,''],
					['token','VARCHAR(40)',false,true,false,false,''],
					['serial_venta','VARCHAR(40)',false,true,false,false,''],
					['tm_create','DATETIME',false,false,false,false,''],
					['tm_update','DATETIME',false,false,false,false,''],
					['tm_delete','DATETIME',false,false,false,false,'']
				]
			];

			$tables[] = [
				'nombre' => 'ofertas',
				'filas' => [
						['id_oferta','TINYINT(11)',true,false,true,true,''],
						['tipo_oferta','VARCHAR(80)',false,true,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'ofertas_descuentos',
				'filas' => [
						['id_ofertas_descuentos','TINYINT(11)',true,false,true,true,''],
						['tipo_descuento','VARCHAR(30)',false,true,false,false,''],
						['descripcion_descuento','VARCHAR(150)',false,true,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'ingreso_productos_gral',
				'filas' => [
						['id_ingreso_gral','SMALLINT(6)',true,false,true,true,''],
						['serial_compra','VARCHAR(35)',false,true,false,false,''],
						['id_producto','SMALLINT(4)',true,true,false,false,''],
						['cantidad','SMALLINT(4)',true,true,false,false,''],
						['fecha_compra','DATETIME',false,true,false,false,'CURRENT_TIMESTAMP'],
						['id_usuario','SMALLINT(6)',true,true,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'estados',
				'filas' => [
					['id_estado_eu','TINYINT(2)',true,false,true,true,''],
					['nombre_estado','VARCHAR(30)',false,true,false,false,'']
				]
			];

			$tables[] = [
				'nombre' => 'ciudades',
				'filas' => [
					['id_ciudad','SMALLINT(5)',true,true,false,true,''],
					['nombre_ciudad','VARCHAR(40)',false,true,false,false,''],
					['id_estado','TINYINT(2)',true,true,false,false,'']
				]
			];	


			$tables[] = [
				'nombre' => 'estados_pedido',
				'filas' => [
						['id_estado','SMALLINT(5)',true,false,true,true,''],
						['estado_es','VARCHAR(40)',false,true,false,false,''],
						['estado_en','VARCHAR(40)',false,true,false,false,'']
					]
			];	

			$tables[] = [
				'nombre' => 'tipos_cupones',
				'filas' => [
						['id_tipo_cupon','TINYINT(3)',true,false,true,true,''],
						['tipo_cupon','VARCHAR(25)',false,true,false,false,''],
						['descripcion_cupon','VARCHAR(250)',false,true,false,false,''],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];	

			$tables[] = [
				'nombre' => 'testimonials_img',
				'filas' => [
						['id_test_img','SMALLINT(5)',true,false,true,true,''],
						['ruta_img_test','VARCHAR(100)',false,true,false,false,''],
						['created_at','DATETIME',false,false,false,false,'CURRENT_TIMESTAMP'],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];

			$tables[] = [
				'nombre' => 'testimonials_msn',
				'filas' => [
						['id_test_msn','SMALLINT(5)',true,false,true,true,''],
						['message','TEXT(600)',false,true,false,false,''],
						['author','VARCHAR(100)',false,true,false,false,''],
						['created_at','DATETIME',false,true,false,false,'CURRENT_TIMESTAMP'],
						['tm_delete','DATETIME',false,false,false,false,'']
					]
			];

			/*
				$rows = [		
					0 => 'nameRow',
					1 => $type=VARCHAR(30),
					2 => 'unsigned=false',
					3 => 'not null = false',
					4 => 'autoincrement=false',
					5 => 'primary_key=false',
					6 => $default='data'
				]
			*/

			foreach ($tables as $table) {
				$this->createTables($table['nombre'],$table['filas']);
			}
		}

		private function ubicaciones()
		{
			$estados = [
				'Florida'
			];

			foreach ($estados as $nombre_departamento) {
				$set = ['nombre_estado' => $nombre_departamento];
				$unique = [
					'conditional' => 'nombre_estado = ?',
					'params' => ['s',$nombre_departamento]
				];
				CRUD::insert('estados',$set,$unique);
			}

			$ciudades = [ 
				[1,'Wellington',1], 
				[2,'Royal Palm Beach',1], 
				[3,'West Palm Beach',1]
			];

			foreach ($ciudades as $ciudad) {
				$set = [
					'id_ciudad' => $ciudad[0],
					'nombre_ciudad' => $ciudad[1], 
					'id_estado' => $ciudad[2]
				];
				$unique = [
					'conditional' => 'id_ciudad = ?',
					'params' => ['s',$ciudad[0]]
				];
				CRUD::insert('ciudades',$set,$unique);
			}
		}

		public function deleteTable($tables=[])
		{
			$sql = 'DROP TABLE IF EXISTS ';

			foreach ($tables as $table) {
				$sql .= $table.', ';
			}

			$sql = substr($sql, 0, -2);

			$bd = Database::getInstancia();
			$mysqli = $bd->getConnection();

			return $mysqli->query($sql);
		}

		private function createTables($tableName,$rows=[])
		{	
			/*
				$rows = [		
					0 => 'nameRow',
					1 => $type=VARCHAR(30),
					2 => 'unsigned=false',
					3 => 'not null = false',
					4 => 'autoincrement=false',
					5 => 'primary_key=false',
					6 => $default='data'
				]
			*/
			$sql = "CREATE TABLE $tableName ( ";

			foreach ($rows as $row) {
				$sql.= $row[0].' '.$row[1].' ';
				if ($row[2] == true) {
					$sql.= ' UNSIGNED ';
				}
				if ($row[3] == true) {
					$sql.= ' NOT NULL ';
				}
				if ($row[4] == true) {
					$sql.= ' AUTO_INCREMENT ';
				}
				if ($row[5] == true) {
					$sql.= ' PRIMARY KEY ';
				}
				if ($row[6] != '') {
					$sql.= " DEFAULT ".$row[6];
				}
				$sql .= ', ';
			}

			$sql = substr($sql, 0, -2);

			$sql.= ')';

			$bd = Database::getInstancia();
			$mysqli = $bd->getConnection();

			$crearTabla = $mysqli->query($sql);
			
			if ($crearTabla === true) {
				$estado = 'CREADA';
			}else{				
				$estado = 'ERROR AL CREAR LA TABLA';
			} 
			echo "<table style='width:50%; min-width: 200px; margin: 0 auto; border: 1px solid grey;'>
			  <tr>
			    <td>$tableName</td>
			    <td style='float: right;'>$estado</td> 
			  </tr>
			</table>";			
		}

		private function addColumn($tableName,$column,$type=null,$after=null)
		{
			$sql = "ALTER TABLE $tableName ADD $column ";

			if ($type !== null) {
				$sql .= $type;
			}

			if ($after !== null) {
				$sql .= "AFTER $after";
			}

			$bd = Database::getInstancia();
			$mysqli = $bd->getConnection();

			$addColumn = $mysqli->query($sql);
			var_dump($sql);
			var_dump($addColumn);
		}

		private function editColumn($table,$old_name_column,$new_name_column,$type=null)
		{
			$sql = "ALTER TABLE $table CHANGE $old_name_column $new_name_column ";

			if ($type !== null) {
				$sql .= $type;
			}

			$bd = Database::getInstancia();
			$mysqli = $bd->getConnection();

			$editColumn = $mysqli->query($sql);
			var_dump($sql);
			var_dump($editColumn);

		}
	}
?>