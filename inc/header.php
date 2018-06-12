<?php 
	/*CLASSES REGISTER*/
	spl_autoload_register( function ($nombre_clase) {
		include DIRECTORIO_ROOT.'class/class.'.$nombre_clase.".php";
	});
	/*CLASSES REGISTER*/

	/*MAINTENANCE INSTANCE*/
	// Secure::maintenance();
	$linkEs = str_replace('/en/','/es/',$_SERVER["REQUEST_URI"]);
	$linkEn = str_replace('/es/','/en/',$_SERVER["REQUEST_URI"]);
	/*MAINTENANCE INSTANCE*/

	/*BASKET*/
	$carrito = new Checkout;
	$bolsa = $carrito->productosBolsa;
	$countCart = count($bolsa);
	$bolsa  = Secure::decodeArray($bolsa);
	$bolsaAgotados = Secure::decodeArray($carrito->productosBolsaAgotados);
	/*#BASKET*/

	/*URL*/
	$urlOrigen = $_SERVER['REQUEST_URI'];/*url actual*/
	if (isset($specialPage)) { $urlOrigen = URL_PAGE.'/'.$lang; }
	if (isset($_GET['process']) AND $_GET['process'] == 'basket-checkout') { $urlOrigen = URL_PAGE.'/'.$lang.'/checkout/'; }
	if (isset($_GET['page']) AND $_GET['page'] === 'address') {
		$urlOrigen = 'http://www.madeitforu.com/'.$lang.'/checkout/address/'.$_GET['token'].'/'.$_GET['spyty'].'/'.$_GET['ctptpay'].'/';
	}
	/*URL*/

	if (!isset($margin_bottom)) {
		$margin_bottom = '3px';
	}

	$keywords_es = 'Regala desayunos de amor, desayunos sorpresa, desayunos de aniversario, dia del padre, dia de la madre, desayunos, regalos de cumpleaños, desayunos en Wellington';
	$keywords_en = 'Give breakfasts of love, surprise breakfasts, anniversary breakfasts, Father\'s Day, Mother\'s Day, breakfasts, birthday gifts, breakfasts in Wellington';
	$keywords = 'keywords_'.$lang;
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gte IE 9]>         <html class="no-js gte-ie9"> <![endif]-->
<!--[if gt IE 99]><!-->
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="author" content="JDWebDesign | jdwebdesign.com">
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="512394397398-cfqq61pcabo84rkarnd91rksh2hft9fi.apps.googleusercontent.com">
    <link rel="icon" type="image/png" href="<?php echo URL_BASE; ?>img/logo/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo $titlePage; ?> | MADEITFORU</title>

    
    <meta name="description" content="<?php echo $contentDescription; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
	    
    <link href="https://fonts.googleapis.com/css?family=Belgrano|Coming+Soon|Open+Sans:400,600|PT+Sans|Raleway:500|Satisfy|Unkempt|Bowlby+One" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE; ?>css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE; ?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE; ?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE; ?>css/animate.css">
    <!-- OwlCarrousel -->
    <link rel="stylesheet" href="<?php echo URL_BASE; ?>css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo URL_BASE; ?>css/owl.theme.default.min.css">
    <!--/ OwlCarrousel -->

    <link type="text/css" href="<?php echo URL_BASE; ?>css/custom.css"  rel="stylesheet">

    <!-- =======================================================
        Theme Name: MADEITFORU
        Author: jwebdev.com
        Author URL: https://jdevweb.com
    ======================================================= -->



   		<!-- Facebook Pixel Code -->
		<script>
		  !function(f,b,e,v,n,t,s)
		  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		  n.queue=[];t=b.createElement(e);t.async=!0;
		  t.src=v;s=b.getElementsByTagName(e)[0];
		  s.parentNode.insertBefore(t,s)}(window, document,'script',
		  'https://connect.facebook.net/en_US/fbevents.js');
		  fbq('init', '131895280742563');
		  fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none"
		  src="https://www.facebook.com/tr?id=131895280742563&ev=PageView&noscript=1"
		/></noscript>
		<!-- End Facebook Pixel Code -->

    	<!-- Global site tag (gtag.js) - Google Analytics -->
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108104933-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-108104933-1');
		</script>


</head>




	<div class="close-popover hide"></div>
	<input type="hidden" name="lang" value="<?php echo $lang; ?>">
	<input type="hidden" id="urlBase" value="<?php echo URL_BASE; ?>">
	<input type="hidden" id="success_product_add" value="<?php echo $success->success_product_add; ?>">
	<input type="hidden" id="success_product_delete" value="<?php echo $success->success_product_delete; ?>">
	<input type="hidden" id="BAG_ERROR_EXIST" value="<?php echo $error->BAG_ERROR_EXIST; ?>">
	<input type="hidden" id="ERROR_PRODUCT_DELETE" value="<?php echo $error->ERROR_PRODUCT_DELETE; ?>">
	<input type="hidden" id="ERROR_PRODUCT_ADD" value="<?php echo $error->ERROR_PRODUCT_ADD; ?>">
		<body>

		<!-- PRELOADER -->
		<!-- <div id="loading">
			<div id="loading-center">
				<h4 class="logo-name logo-footer animated zoomIn text-center" style="position: relative; top: 120px; ">MadeItForYou</h4>
				<div id="loading-center-absolute">
					<div class="object" id="object_one"></div>
					<div class="object" id="object_two" style="left:20px;"></div>
					<div class="object" id="object_three" style="left:40px;"></div>
					<div class="object" id="object_four" style="left:60px;"></div>
					<div class="object" id="object_five" style="left:80px;"></div>
				</div>
			</div>		 
		</div> -->
		<!-- END PRELOADER -->


		<!-- PRINCIPAL NAV DESKTOP -->
		<div class="container-fluid container-nav hidden-xs fixedNavbar" style="box-shadow: 0px 3px 8px 0px #c5b8b8; margin-bottom: <?php echo $margin_bottom; ?>;">
			<div class="container">
				<div>                            
                    <ul class="nav nav-principal nav-justified">
                    	<?php foreach ($principalNav as $btn): ?>
                    		<li style="height: 40px;" class="sidenav-custom nav-menu-principal">
	                            <a class="animated rubberBand btn-nav"  href="<?php echo $btn->$out; ?>"> 
	                               <?php echo strtoupper($btn->btn); ?>
	                            </a>
	                        </li>
                    	<?php endforeach ?>
                        <li class="cart-buttom"> 
                            <div class="text-right">
								<div class="btn-group">
								  	<a href="" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  		<i style="" class="fa fa-user" aria-hidden="true">
								    	<?php if (isset($_SESSION['id_usuario'])): ?>
		                            		<?php $name = explode(' ', $_SESSION['user']); ?>
		                            	 	<?php echo ucwords(strtolower($name[0])); ?> 
		                            	<?php else: ?>	
		                            	 	<?php echo $btnUser; ?> 
		                            	<?php endif ?>	
								    	<span class="caret"></span>
								    	</i> 
								  	</a>
								  	<ul class="dropdown-menu text-center dropdown-user-menu">
									  	<?php if (isset($_SESSION['id_usuario'])): ?>
									  		<?php 
									  		$where = 'id_usuario = ?';
									  		$params =  ['i',$_SESSION['id_usuario']];
									  		$rol = CRUD::all('usuarios','id_rol',$where,$params); ?>
									  		<?php if ($rol[0]['id_rol'] === 1): ?>
									  			<li style="padding: 10px 0; cursor: pointer;">
									  				<a class="btnNav" href="<?php echo URL_BASE.'admin/'; ?>">
									  					<i class="fa fa-bar-chart" aria-hidden="true" style="color: #4DB4A5;">
										    				<span style="margin-left: 6px; font-size: 18px; color: black;">
										    				Administrador
										    				</span>
										    			</i>
										    		</a>
									  			</li>	
									  		<?php endif ?>	  		
										    <?php foreach ($menuUser as $btn): ?>
										    	<li style="padding: 10px 0; cursor: pointer;">
										    		<a href="<?php echo $btn->url; ?>">
										    			<i class="fa <?php echo $btn->icon; ?>" aria-hidden="true" style="color: #4DB4A5;">
										    				<span style="margin-left: 6px; font-size: 18px; color: black;">		<?php echo $btn->btn; ?>
										    				</span>
										    			</i>							    	
										    		</a>
										    	</li>
										    <?php endforeach ?>
									  	<?php else: ?>
										    <?php foreach ($menuLog as $btn): ?>
					      						<li style="padding: 10px 0; cursor: pointer;">
									            	<a href="" data-toggle="modal" data-target="<?php echo $btn->modal; ?>">
									              		<i style="color: #4DB4A5;" class="fa <?php echo $btn->icon; ?>" aria-hidden="true">
									              			<span style="margin-left: 6px; font-size: 18px; color: black;">		
									              			<?php echo $btn->btn; ?>
										    				</span>
									              		</i>               		
									            	</a>
									          	</li>      				
						      				<?php endforeach ?>	
									  	<?php endif ?>
								  	</ul>  	
                            		<span style="margin-left: 5px;">
                            			|
							  				<a style="position: relative; top: 2px;" href="" class="dropdown-toggle" type="button" id="dorpdown_lang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							  					<?php if ($lang === 'en'): ?>			  				
							  						<img src="<?php echo URL_BASE; ?>img/icons/United-States-Flag-icon.png" width="19px">
							  					<?php endif ?>
							  					<?php if ($lang === 'es'): ?>
							  						<img src="<?php echo URL_BASE; ?>img/icons/spain-flag-icon.png" width="19px">
							  					<?php endif ?>
									    		<span class="caret"></span>
							  				</a>
							  				<ul style="min-width: 100px;" class="dropdown-menu" aria-labelledby="dorpdown_lang">
							  					<li style="padding-bottom: 0;">
							  						<a class="dropdown-item text-center" href="<?php echo $linkEn; ?>">
							  							<img src="<?php echo URL_BASE; ?>img/icons/United-States-Flag-icon.png" width="19px">
							  							English
							  						</a></li>
							  					<li style="padding-top: 0;"><a class="dropdown-item text-center" href="<?php echo $linkEs; ?>">
							  					<img src="<?php echo URL_BASE; ?>img/icons/spain-flag-icon.png" width="19px">
							  						Español</a></li>
							  				</ul>
                            		</span>
									|
                            		<i href="#" class="fa fa-shopping-basket cart-desk" aria-hidden="true" data-toggle="popoverCart" data-popover-content="#previewCart" data-placement="bottom" data-trigger="click"><span class="badge badge-cart"> <?php echo $countCart; ?> </span></i> 
								</div> 
                            </div>                            
                        </li>
                    </ul>   
                </div>
			</div>
		</div>
		<!-- END PRINCIPAL NAV DESKTOP -->

		<!--  SIDENAV MOBILE -->
		<div id="sideNavMb" class="sidenav" style="padding-top: 0;">		
			<p style="position: absolute; top: 10px; left: 10px; z-index: 3000;" class="text-left">
				<a style="text-decoration: none; padding-right: 0; padding-left: 5px;" href="<?php echo $linkEn; ?>">
					<img src="<?php echo URL_BASE; ?>img/icons/United-States-Flag-icon.png" width="19px">
					<small class="text-success">En</small>
				</a>
				<a style="text-decoration: none; padding-left: 4px;" href="<?php echo $linkEs; ?>">
					<img src="<?php echo URL_BASE; ?>img/icons/spain-flag-icon.png" width="19px">
					<small class="text-success">Es</small>
				</a>
			</p>	
		  	<a href="javascript:void(0)" class="closebtn" style="color: #4DB4A5; z-index: 999999999;" onclick="closeNav()">&times;</a>
		  	<h1 class="logo-name" style="margin-bottom: 0px;">
		  		<a href="<?php echo URL_BASE; ?>" style="padding: 0;">
		  			<img class="animated flipInX" width="190px" src="<?php echo URL_BASE.'img/logo/logo-green.png' ?>">
		  		</a>
		  	</h1>
		  	<?php foreach ($principalNav as $btn): ?>
		  		<li class="sidenav-custom" style="list-style: none; font-size: 15px;">
	                <a class="btn-mobile-menu" style="font-family: 'Unkempt', cursive; color: black;" href="<?php echo $btn->$out; ?>"> 
	                    <?php echo strtoupper($btn->btn); ?>
	                </a>		  			
		  		</li>
    		<?php endforeach ?>	
    		<br>	  	    
            <div class="col-xs-6" style="padding-right: 0;">
                <a href="https://www.facebook.com/madeitforu.usa" class="pull-right"><i class="fa fa-hamenu fa-facebook-official fa-face-nav fa-2x" aria-hidden="true"></i></a>
            </div>  	    
            <div class="col-xs-6" style="padding-left: 0;">
                <a href="https://www.instagram.com/madeitforu.usa/" class="pull-left"><i class="fa fa-hamenu fa-instagram fa-2x" aria-hidden="true"></i></a>
            </div>
            
		</div>
		<!-- END SIDENAV MOBILE -->

		<!-- USER MENU MOBILE -->
		<nav class="navbar navbar-default container-nav-mobile hidden-lg hidden-md hidden-sm fixedNavbar" style="box-shadow: 0px 3px 8px 0px #c5b8b8;">
			<div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">			    	
			      	<button type="button" class="navbar-toggle collapsed" onclick="openNav()">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
			      	</button>

					<div href="#" class="navbar-brand pull-right" data-toggle="popoverCart" data-popover-content="#previewCart" data-placement="bottom" data-trigger="click">
						<i class="fa fa-shopping-basket" aria-hidden="true"><span class="badge badge-cart"><?php echo $countCart; ?></span></i> 
					</div>
					<div>
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#userMenu" aria-expanded="false">
					        <i class="fa fa-user" aria-hidden="true"><small><i class="fa fa-caret-down caret-user" aria-hidden="true"></i></small></i>

					     </button>
					</div>
			    </div>
			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="userMenu" style="box-shadow: 3px 0px 1px grey;">
			      	<ul class="nav navbar-nav">
			      		<?php if (isset($_SESSION['user'])): ?>
			      			<?php 
						  		$where = 'id_usuario = ?';
						  		$params =  ['i',$_SESSION['id_usuario']];
						  		$rol = CRUD::all('usuarios','id_rol',$where,$params); ?>
						  		<?php if ($rol[0]['id_rol'] === 1): ?>
						  			<a href="<?php echo URL_BASE.'admin/'; ?>">
						  				<li style="margin-left: 30px; margin-top: 12px;">
						              		<i style="color: #4DB4A5; font-size: 20px;" class="fa fa-bar-chart" aria-hidden="true"></i> 
						              		<span style="margin-left: 10px; color: black; font-size: 18px;">Administrador</span>
						  				</li>	
						            </a>
						  		<?php endif ?>	
					        <?php foreach ($menuUser as $btn): ?>
					            <a href="<?php echo $btn->url; ?>" style="padding: 20px;">
					          		<li style="margin-left: 30px;">
					              		<i style="color: #4DB4A5; font-size: 20px;" class="fa <?php echo $btn->icon; ?>" aria-hidden="true"></i> 
					              		<span style="margin-left: 10px; color: black; font-size: 18px;"><?php echo $btn->btn; ?></span>
					          		</li>
					            </a>
				        	<?php endforeach ?> 			      			
			      		<?php else: ?>	
			      			<?php foreach ($menuLog as $btn): ?>
			      				<li style="margin-left: 0px;">
					            	<a href="" data-toggle="modal" data-target="<?php echo $btn->modal; ?>">
					              		<i style="color: #4DB4A5; font-size: 20px;" class="fa <?php echo $btn->icon; ?>" aria-hidden="true"></i> 					              		 
					              		<span style="margin-left: 10px; color: black; font-size: 18px;">
					              			<?php echo $btn->btn; ?>          			
					              		</span>					              		
					            	</a>
					          	</li>      				
			      			<?php endforeach ?>		
			      		<?php endif ?>
			      	</ul>
			    </div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		<!-- END USER MENU MOBILE -->


<?php include DIRECTORIO_ROOT.'inc/elements/floating-elements.php'; ?>
<?php include DIRECTORIO_ROOT.'inc/elements/modals.php'; ?>

<a href="#" id="js_up" class="boton-subir">  
  <i class="fa fa-arrow-up fa-6x" aria-hidden="true"></i>
</a>  