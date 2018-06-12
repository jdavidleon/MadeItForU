<?php 	
    if (!defined('URL_BASE')) {  require '../../config/config.php'; }
    if (!isset($web)) { $web = false; }
    if ($web!=true) {
	    $idioma = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
		if($idioma=="es") { 
	        header('Location: '.URL_BASE.'es/checkout_address.php'); 
	    } else {   
	        header( 'Location: '.URL_BASE.'en/checkout_address.php' );
	    }
	}
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: '.URL_BASE.$lang);
    }

    switch ($_GET['page']) {
    	case 'customer-account':
    		$pageRequire = 'customer-account.php';
    		$titlePage = $menuUser[0]->btn;
    		break;
        
        case 'customer-address':
            $pageRequire = 'customer-address.php';
            $titlePage = $menuUser[3]->btn;
            break;
        
        case 'customer-orders':
            $pageRequire = 'customer-orders.php';
            $titlePage = $menuUser[1]->btn;
            break;

    	default:    		
    		$pageRequire = 'customer-account.php';
    		$titlePage = 'Customer Account';
    		break;
    }
   

	require DIRECTORIO_ROOT.'inc/header.php'; 
	
	$user = new User($_SESSION['id_usuario']);
    $informacion = $user->infoPersonal();
    $estados = CRUD::all('estados');
?>

<div class="container-fluid container-account">
	<div class="container">
        <div class="row">
            <ol class="breadcrumb">
              <li><a href="<?php echo URL_BASE.$lang; ?>" style="color: #4DB4A5;">
                <?php echo $titleIndex ?>
              </a></li>
              <li><a href="<?php echo URL_BASE.$lang.'/user/customer-account/'; ?>" style="color: #4DB4A5;"><?php echo $titleUsers; ?></a></li>
              <li class="active"><?php echo $titlePage; ?></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md-3 hidden-xs" id="userMenuDescktop">
			    <div>                
			        <h3 class="text-center logo-name"><?php echo $secUser->account; ?></h3>
			        <hr>
			        <ul>
			        <?php foreach ($menuUser as $btn): ?>  
			            <li>   
			                <a href="<?php echo $btn->url; ?>">                      
			                    <i class="fa <?php echo $btn->icon; ?>" aria-hidden="true">    
			                        <span><?php echo $btn->btn; ?></span>
			                    </i>                
			                </a>
			            </li>
			        <?php endforeach ?>
			        </ul>
			    </div>
			</div>
            
            <?php require DIRECTORIO_ROOT.'inc/user/'.$pageRequire; ?>

        </div>
    </div>
</div>		




<?php require DIRECTORIO_ROOT.'inc/footer.php'; ?>
