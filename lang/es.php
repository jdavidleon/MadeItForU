<?php 
  
/************************************************
 -------------------GLOBAL-----------------------
************************************************/
  
  /*TITLES*/
  $titleIndex = 'Inicio';
  $titleCheckout = 'Pagos';
  $title404 = 'Pagina no encontrada';
  $titleLogIn = 'Iniciar Sesión';
  $titleRestore = 'Restablecer Contraseña';
  $titleUnsubscribeNews = 'Newsletter';
  $titleTerms = 'Términos y Condiciones';
  $titleAboutUs = 'Nosotros';
  $titleBasket = 'Cesta';
  $titleBasketAddress = 'Dirección de envío';
  $titleUsers = 'Usuarios';
  $titlePayment = 'Pagos';
  
  /*CONTENT*/
  $contentDescription = 'Sorprende a esa persona especial con un desayuno sorpresa';

/************************************************
 -------------------HEADER-----------------------
************************************************/
  
  /*Index*/
  $btnUser = 'Ingresa';
 
  /*Principal nav*/
  $out = 'url_out';
  $menu = [
      [ 'btn' => 'inicio', 'url' => URL_BASE.$lang, 'url_out' => URL_BASE.$lang, 'icon' => 'fa-home' ],
      [ 'btn' => 'Nosotros', 'url' => URL_BASE.$lang.'/bussiness/about_us', 'url_out' => URL_BASE.$lang.'/bussiness/about_us', 'icon' => 'fa-hand-o-right' ],
      [ 'btn' => 'productos', 'url' => '#menu-list', 'url_out' => URL_BASE.$lang.'/#menu-list', 'icon' => 'fa-cutlery' ],
      [ 'btn' => 'testimonios', 'url' => '#testimonials', 'url_out' => URL_BASE.$lang.'/#testimonials', 'icon' => 'fa-users' ],
      [ 'btn' => 'contacto', 'url' => '#contact', 'url_out' => URL_BASE.$lang.'/#contact', 'icon' => 'fa-paper-plane' ]
  ];

  $convert = json_encode($menu);    
  $principalNav  = (object)json_decode($convert); 


  /*User Menu*/
  if (isset($_SESSION['user'])) {  
    $menuUser =  [

    (object) [ 'btn' => 'Mi Cuenta', 'url' => URL_BASE.'es/user/customer-account/', 'icon' => 'fa-user-circle' ],
    (object) [ 'btn' => 'Mis Pedidos', 'url' => URL_BASE.'es/user/customer-orders/', 'icon' => 'fa-list' ],
    (object) [ 'btn' => 'Mi Cesta', 'url' => URL_BASE.'es/checkout/basket', 'icon' => 'fa-shopping-basket' ],
    (object) [ 'btn' => 'Mis Direcciones', 'url' => URL_BASE.'es/user/customer-address', 'icon' => 'fa-truck' ],
    (object) [ 'btn' => 'Salir',  'url' => URL_BASE.'bd/users/logout.php?csrf='.$_SESSION['csrf_token'],  'icon' => 'fa-sign-out' ]

          ];

    // $convert = json_encode($userMenu);    
    // $menuUser  = (object)json_decode($convert); 
    // var_dump($userMenu);

  }

  /*User Menu*/
  $logMenu = [

   [ 'btn' => 'Ingresar', 'icon' =>  'fa-sign-in', 'modal' => '#logInModal' ],
   [ 'btn' => 'Registrarse', 'icon' => 'fa-sign-out', 'modal' => '#signUpModal' ]

        ];

  $convert = json_encode($logMenu);    
  $menuLog  = (object)json_decode($convert); 

  
/************************************************
 ------------------MODALS----------------------
************************************************/
  
  $modalLogIn = [
    'title' => 'Iniciar Sesión',
    'user' => 'Correo',
    'psw' => 'Contraseña',
    'save' => 'Recordar',
    'btn' => 'Ingresar',
    'remember' => 'Recordar',
    'forgot' => 'Olvide mi contraseña',
    'btnSignUp' => 'Regístrate'
  ];

  $convert = json_encode($modalLogIn);    
  $loginM  = (object)json_decode($convert); 
  
  $modalSignUp = [
    'title' => 'Registro',
    'gender' => 'Como deberiamos tratarte?',
    'gender_woman' => 'Sra.',
    'gender_man' => 'Sr.',
    'name' => 'Nombre',
    'last_name' => 'Apellido',
    'mail' => 'Correo',
    'psw' => 'Contraseña',
    'born' => 'Fecha de Nacimiento',
    'born_day' => 'DIA',
    'born_month' => 'MES',
    'born_year' => 'AÑO',
    'btn' => 'Registrar',
    'already' => 'Ya te encuentras registrado?',
    'btnLogIn' => 'Iniciar Sesión',    
    'btnSignUp' => 'Registrarme',
    'terms' => 'Al registrarte aceptas los <a style="color:#6DC0B4;" href="'.URL_BASE.$lang.'/bussiness/terms">términos y condiciones</a>.',
  ];

  $convert = json_encode($modalSignUp);    
  $signUpM  = (object)json_decode($convert); 
  
/************************************************
 ---------------PRINCIPAL INDEX------------------
************************************************/
 $indexPrincipal = [
    'pharse' => 'Regala Desayunos de Amor',
    'sentence' => 'El regalo especial que estabas buscando',
    'btn_principal' => 'Comprar Ahora',
    'how_shop' => '¿Como Comprar?',
    'btn_how_to' => 'Ver Desayunos'
  ];

  $convert = json_encode($indexPrincipal);    
  $principalIndex  = (object)json_decode($convert); 

/************************************************
 ------------------CUSTOMER----------------------
************************************************/
  $userSection = [
    'account_info_title' => 'Datos Personales',
    'account' => 'Cuenta',
    'account_name' => 'Nombre',
    'account_lastname' => 'Apellido',
    'account_mail' => 'Correo',
    'account_birthday' => 'Fecha de Nacimiento',
    'account_info_btn' => 'Guardar Cambios',
    'account_psw_title' => 'Cambiar Clave',
    'account_psw_last' => 'Clave Actual',
    'account_psw_new' => 'Nueva clave',
    'account_psw_new2' => 'Digita nuevamene tu clave',
    'account_psw_btn' => 'Cambiar contraseña',
    'order_title' => 'Mis pedidos',
    'order_empty' => 'No has realizado ningún pedido aún',
    'order_prf1' => 'A continuación encontrarás información detallada sobre tu pedido. Si tienes alguna duda por favor <a href="'.URL_BASE.$lang.'/pages/contact">contáctanos</a> ',
    'order_tb_product' => 'Producto',
    'order_tb_quanity' => 'Cantidad',
    'order_tb_price' => 'Precio',
    'order_tb_address' => 'Dirección de Envío',
    'address_title' => 'Mis Direcciones',
    'address_phone' => 'Teléfono',  ];

  $convert = json_encode($userSection);    
  $secUser  = (object)json_decode($convert); 

/************************************************
 ------------------PRODUCTS----------------------
************************************************/
  
  $secProducts = [
    'title' => 'Lista de Productos',
    'footTitle' => 'El regalo ideal para cada ocasión, un aniversario, cumpleaños o si unicamente quieres expresar tu amor.',
    'btnAll' => 'Mostrar Todo',
    'details' => 'detalles',
    'quantity' => 'cantidad',
    'addCart' => 'Añadir a la Cesta',
    'testimonials' => 'Nuestros Clientes Dicen',
    'include' => 'Incluye',
    'content' => 'Contenido de la cesta',
    'other_products' => 'Más Opciones para Sorprender',
  ];

  $convert = json_encode($secProducts);    
  $productSec  = (object)json_decode($convert); 

/************************************************
 ------------------BANNERS----------------------
************************************************/
  $secBanners = [
    'shipping' => 'ENVIO GRATIS',
    'shipping_content' => 'Todos los pedidos con envío gratis. Revisa nuestra cobertura.',
    'shipping_modal' => '',
    'payment' => 'COMPRA SEGURA',
    'payment_content' => 'Tus datos y dinero están protegidos gracias a PayPal PAGO SEGURO.',
    'payment_modal' => '',
    'guaranty' => 'SATISFACCION GARANTIZADA',
    'guaranty_content' => 'Devolución del 100% de la compra si no cumplimos con tus espectativas',
    'guaranty_modal' => '',
  ];

  $convert = json_encode($secBanners);    
  $bannerSec  = (object)json_decode($convert); 

/************************************************
 -------------------CONTACT US----------------------
************************************************/

  $map = [
    'title' => 'ENVIO GRATIS',
    'subTitle' => 'Cobertura en Wellington, West Palm Beach y Royal Palm Beach. FL.',
    'delivery' => 'Horarios de envío <br> Lunes a Viernes </br> 6:30 am a 11:00 am',
    'btn' => 'ORDENAR AHORA',
  ];


  $convert = json_encode($map);    
  $textMap  = (object)json_decode($convert); 

/************************************************
 -------------------CONTACT US----------------------
************************************************/
  $contact = [
    'title' => 'Contáctanos',
    'titlePage' => 'Contacto',
    'subTitle' => '',
    'name' => 'Tu Nombre',
    'email' => 'Tu Correo',
    'phone' => 'Tu Teléfono',
    'subject' => 'Asunto',
    'message' => 'Mensaje',
    'btn' => 'Enviar',
    'alternative' => 'Tambien nos puedes escribir a  <a href="mailto:gifts@madeitforu.com">gifts@madeitforu.com</a>.',
    'confirm' => 'Hemos recibido tu mensaje. Nos pondremos en contacto contigo pronto . Gracias!'
  ];


  $convert = json_encode($contact);    
  $textContact  = (object)json_decode($convert); 

/************************************************
 -------------------CART----------------------
************************************************/
  $popoverCart = [
    'header' => 'Cesta',
    'address' => 'Dirección de Envio',
    'resume' => 'Subtotal',
    'empty' => 'No has agregado ningún producto',
    'btn' => 'Continuar',
    'btnEmpty' => 'Ir de compras',
    'resume_coupon' => 'Cupón',
    'resume_valid' => 'aplicado',
    'resume_invalid' => 'Inválido',
  ];
  
  $convert = json_encode($popoverCart);    
  $cartPopover  = (object)json_decode($convert); 

/************************************************
 ----------------- CHECKOUT --------------------
************************************************/
  $checkOutTable = [
    'product' => 'producto',
    'price' => 'precio',
    'quantity' => 'cantidad',
    'total' => 'total',
    'delete' => 'eliminar',
    'subtotal' => 'subtotal',
    'delBtn' => 'quitar del carrito',
    'alert_msn_empty' => 'Personaliza el mensaje para la cesta y la tarjeta de regalo',
    'btn_alert_empty' => 'PERSONALIZAR',
    'alert_msn_ok' => 'Ya personalizaste los mensajes de tu pedido',
    'btn_alert_ok' => ' VER / EDITAR ',
    'form_who' => '¿A quien lo vas a obsequiar?',
    'form_why' => 'Motivo del regalo',
    'form_basket' => 'Frase de la cesta',
    'form_basket_lenght' => ' Caracteres disponibles',
    'form_basket_lenght_error' => 'Demasiado largo',
    'form_target' => 'Mensaje de la tarjeta',
    'form_btn_save' => 'Guardar'

  ];
  
  $convert = json_encode($checkOutTable);    
  $tableCheck  = (object)json_decode($convert); 

  $checkOutAddress = [
    'titleAddress' => 'Dirección de Envío',
    'subTitleAddress' => 'Selecciona la dirección donde deseas recibir el envío',
    'btn_add_address' => 'Agregar Nueva Dirección',
    'empty' => 'No has agregado ninguna dirección aún',
    'btn_edit' => 'Editar',
    'btn_delete' => 'Eliminar',
    'form_name' => 'Nombre',
    'form_last_name' => 'Apellido',
    'form_state' => 'Estado',
    'form_city' => 'Ciudad',
    'form_address' => 'Dirección',
    'form_zip_code' => 'Codigo Zip',
    'form_phone' => 'Teléfono',
    'form_submit' => 'Agregar',
  ];
  
  $convert = json_encode($checkOutAddress);    
  $addressCheck  = (object)json_decode($convert); 

  $checkOutResume = [
    'title' => 'resumen',
    'subtotal' => 'subtotal',
    'coupon' => 'cupón',
    'shipping' => 'envio',
    'total' => 'total',
    'paypal' => 'Paga via PayPal; puedes pagar con tu tarjeta de crédito o débito si no tienes cuenta en PayPal.',
    'btn' => 'continuar',
    'alert_personal_order' => 'DEBES PERSONALIZAR TU PEDIDO PARA CONTINUAR',
    'alert_address_order' => 'Debes ingresar una dirección para continuar',
    
  ];
  
  $convert = json_encode($checkOutResume);    
  $resumeCheck  = (object)json_decode($convert); 

/************************************************
 -------------------Cookies----------------------
************************************************/
  $alertCookies = [
    'title' => 'Cookies', 
    'content' => 'Este sitio utiliza cookies para brindarte una mejor experiencia. Al navegar por nuestro sitio acepta su uso. <a href="'.URL_BASE.$lang.'/bussiness/terms/#cookies'.'" style="color: white; text-decoration: underline;"> Mas información</a>',
    'btn' => 'Entendido'
  ];

  $convert = json_encode($alertCookies);    
  $cookieAlert  = (object)json_decode($convert); 
  
/************************************************
 ------------------ABOUT US---------------------
************************************************/
  $aboutUsSection = [
      'title' => 'Nosotros',
      'extract' => 'En una fecha especial para tu ser querido, te has preguntado esto?: Qué puedo regalar?,  ¿Qué le gustará?,  ¿Qué sorpresa puedo dar?, Si quieres algo diferente <b>Made it for U</b> te ayudará en este día para que seas el primero en sorprender regalando un desayuno de amor.',
      'btn' => 'Leer Más'
  ];

  $convert = json_encode($aboutUsSection);    
  $aboutUs  = (object)json_decode($convert); 


/************************************************
 ------------------SPECIAL---------------------
************************************************/
  $specialSection = [
      'title' => 'Oferta Especial',
      'footTitle' => 'Algun Texto',
      'subTitle' => 'title',
      'extract' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore eos suscipit earum voluptas aliquam recusandae, quae iure adipisci, inventore quia, quos delectus quaerat praesentium id expedita nihil illo accusantium, tempora.',
      'btn' => 'Ver Más'
  ];

  $convert = json_encode($specialSection);    
  $special  = (object)json_decode($convert); 


/************************************************
 -------------------MAIL-----------------------
************************************************/

  $dataMail = [
    'subjet' => 'Activacion de cuenta',
    'title' => 'Bienvenido(a) a ',
    'paragraf_1_1' => 'Gracias por registrarte. <br> Ya casi hemos terminado tu registro solo debes ingresar',
    'btnHere' => 'Aquí',
    'paragraf_1_2' => 'y nosotros nos encargaremos de validar tu cuenta.',
    'paragraf_2' => 'Si no puedes abrir el enlace copia y pega en tu navegador: ',
    'paragraf_3' => 'Si tienes alguna duda puedes contactarnos a ',
    'btnNewsletter' => 'Desinscribirme</font> del newsletter.</a>',
  ];
  
  $convert = json_encode($dataMail);    
  $mailTXT  = (object)json_decode($convert); 

  $mailRestorePassword = [
    'subjet' => 'Restaurar contraseña',
    'title' => 'Restaurar cuenta ',
    'paragraf_1_1' => 'Has solicitado restaurar tu cuenta. Solo debes ingresar',
    'btnHere' => 'Aquí',
    'paragraf_1_2' => 'y podras restablecer tu contraseña. El enlace solo se encuentra disponible por 24 horas, después de este tiempo debes solicitar nuevamente restaurar tu cuenta.',
    'paragraf_2' => 'Si no puedes abrir el enlace copia y pega en tu navegador: ',
    'paragraf_3' => 'Si tienes alguna duda puedes contactarnos a ',
    'btnNewsletter' => 'Desinscribirme</font> del newsletter.</a>',
  ];
  
  $convert = json_encode($mailRestorePassword);    
  $mailResPass  = (object)json_decode($convert); 

/************************************************
 -------------------FOOTER-----------------------
************************************************/


/************************************************
 -------------------FORMS-----------------------
************************************************/

  $validateForm = [
    'required' => 'Campo requerido',
    'invalid_email' => 'Dirección de correo invalido.',
    'invalid_psw_lenght' => 'La contraseña debe tener mímino 8 caracteres.',    
    'invalid_psw_number' => 'La contraseña debe tener al menos 1 numero.',    
    'invalid_psw_letter' => 'La contraseña debe tener al menos 1 letra.',    
    'invalid_phone' => 'Numero de teléfono invalido.',    
  ];

  $convert = json_encode($validateForm);    
  $formTXT  = (object)json_decode($convert); 


  $contactForm = [
    'name' => 'Nombre',
    'email' => 'Correo.',
    'phone' => 'Teléfono',    
    'subject' => 'Asunto',    
    'message' => 'Mensaje',    
  ];

  $convert = json_encode($contactForm);    
  $contactTXT  = (object)json_decode($convert); 


  $forgotpasswordForm = [
    'title' => 'Restablecer Cuenta',
    'subtitle' => 'Ingresa la dirección de correo registrada con nosotros',
    'email' => 'Correo',    
    'btn_restore' => 'Restaurar' 
  ];

  $convert = json_encode($forgotpasswordForm);    
  $forgotForm  = (object)json_decode($convert); 

  $restartpasswordForm = [
    'subtitle' => 'Ingresa la nueva contraseña',
    'psw1' => 'Contraseña',    
    'psw2' => 'Repite Contraseña',
    'btn_restore' => 'Restaurar',
    'btn_error' => 'Solicitar restaurar cuenta',  
  ];

  $convert = json_encode($restartpasswordForm);    
  $restartForm  = (object)json_decode($convert); 

/************************************************
 -------------------ERRORS-----------------------
************************************************/

  $errors = [
    'ERROR_DATA_REQUEST' => 'Ha ocurrido un error al recibir los datos, por favor intentalo nuevamente',
    'PAGE_NOT_FOUND' => 'Al parecer la página a la que intentar ingresar se ha movido o ya no existe. Por favor verifica la dirección url ingresada.',
    'INCONMPLETE_FORM' => 'Debes completar todos los campos.',
    'ERR_LOG_CUENTA_BLOQUEADA' => 'La cuenta se encuentra bloqueada debido a varios intentos fallidos de iniciar sesión. Puedes restaurarla facilmente <a href="'.URL_BASE.$lang.'/pages/forgotpassword/"><b class="text-danger">AQUI</b></a>.',
    'ERROR_VAL_LOG_MAIL_PSW' => 'El usuario y contraseña ingresada no coinciden.',
    'LENGHT_PASSWORD' => 'La contraseña debe tener mínimo 8 caracteres.',
    'INVALID_MAIL' => 'Debes ingresar un correo válido.',
    'MAIL_PREV_REG' => 'El correo ingresado ya se encuentra registrado si no recuerdas tu contraseña, puedes restablecerla <a href="'.URL_BASE.$lang.'/pages/forgotpassword/">aquí</a>.',
    'ERROR_GLB_SIGNUP' => 'Ha ocurrido un problema con la creación de tu cuenta por favor inténtalo, nuevamente.',
    'COUNT_LOST' => 'No hemos encontrado tu cuenta. debes registrarte',
    'COUNT_ALREADY_VALIDATED' => 'Esta cuenta ya ha sido validada. No requiere ninguna accion adicional',
    'COUNT_ERROR_VALIDATE' => 'Ocurrio un error al activar tu cuenta. por favor intentalo nuevamente o contactenos',
    'ERROR_VALIDACION_USUARIOS_P_V' => 'Tu cuenta aun no ha sido validada después al momento de registrarte. Debes restaurarla <a href="'.URL_BASE.$lang.'/pages/forgotpassword/">aquí</a>',
    'ERROR_DATA_RESTORE' => 'No hemos podido establecer la integridad de tus datos. Recuerda que el link de validación enviado a tu correo se habilita solo por 24 horas a partir del momento que solicitaste restaurar tu cuenta. Si deseas puedes solicitar nuevamente una nueva contraseña',
    'ERROR_DIFERENT_PASSWORD' => 'Las contraseñas no coinciden',
    'ERROR_NEWSLETTER_UNSUBSCRIBE' => 'No se pa podido establecer la autenticidad de tu subscripción. por favor intentalo nuevamente.',
    'ERROR_NEWSLETTER_COUNT_LOST' => 'No se encuentra registrado tu correo al newsletter.',
    'ERROR_PRODUCT_ADD' => 'No hemos podido agregar el producto, por favor vuelve a intentarlo.',
    'ERROR_PRODUCT_DELETE' => 'No hemos podido eliminar el producto, por favor vuelve a intentarlo',
    'BAG_ERROR_EXIST' => 'Ya existe este producto en tu bolsa',
    'ERROR_DATE_EXIST' => 'Debes ingresar una fecha correcta',
    'ERROR_ACCEPT_TERMS' => 'Debes aceptar los terminos para continuar',
    'ERROR_MAIL_USED' => 'El correo ingresado se encuentra asociado a otra cuenta. Intenta con un correo diferente',
    'ERROR_UPDATE_DATA' => 'Ha ocurrido un error. Por favor intentao nuevamente.',
    'ERROR_UPDATE_PSW' => 'Ha ocurrido un error al actualizar tu clave. Por favor intentalo Nuevamente',
    'ERROR_VALIDATE_PSW' => 'La clave es incorrecta',
    'BAD_FORMAT_ZIP_CODE' => 'Debes ingresar un Código Zip válido',
    'BAD_FORMAT_PHONE' => 'Debes ingresar un teléfono válido',

  ];

  $convert = json_encode($errors);    
  $error  = (object)json_decode($convert); 

  if ( isset($_GET['mail']) ){
    $mailS = $_GET['mail'];
  }else{
    $mailS = '';
  }

  $successMsn = [
    'success_signup_title' => 'Te has registrado exitosamente',
    'success_signup_p1' => 'Hemos enviado un correo a '.$mailS.', con el fin de validar tu cuenta y de esta manera ponernos en contacto contigo facilmente en caso que se requiera en tus compras. No olvides revisar tu bandeja de spam.',
    'success_signup_p2' => 'Si no has recibido el correo por favor ponte en <a href="'.URL_BASE.$lang.'/pages/contact/">contacto</a> con nosotros.',
    'activate_title' => 'Activación de Cuenta',
    'btn_contact_us' => 'Si tienes problemas con tu cuenta por favor <a href="'.URL_BASE.$lang.'/pages/contact/">contáctanos</a>. Te ayudaremos a resolverlo.',
    'success_validate_account' => 'Tu cuenta ha sido activada ya puedes iniciar sesión.',
      'success_contact' => 'Hemos recibido tu mensaje, nos pondremos en contacto contigo lo antes posible',
    'success_form_forgotpassword' => 'Hemos enviado un mensaje con indicaciones a '.$mailS.' para restablecer tu cuenta',
    'success_restore_password' => 'Has actualizado correctamente tu cuenta. Ahora puedes ingresar a tu cuenta con tu nueva clave.',
    'success_newsletter_unsubscribe' => 'Hemos cancelado la subscribción a tu newsletter. No recibiras mas correos informativos.',
    'success_product_add' => 'Producto agregado a tu cesta',
    'success_product_delete' => 'Producto eliminado de tu cesta',
    'success_info_updated' => 'Datos actualizados con exito',
    'success_psw_update' => 'Clave actualizada con éxito',
    'success_address_added' => 'Has agregado una nueva dirección',
    'success_continue_basket' => 'INICIAR SESION Y <br> CONTINUAR CON MI PAGO',
  ];

  $convert = json_encode($successMsn);    
  $success = (object)json_decode($convert); 

