<?php     
    if (!defined('URL_BASE')) { require '../config/config.php'; }

    if (!isset($web)) { $web = false; }
    
    if (!$web){
       $idioma = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
       header('Location: '.URL_BASE.$idioma.'/pages');
    }

    switch ($_GET['page']) {
        case 'basket':
            $pageRequire = 'basket.php';
            $titlePage = $titleBasket;
            $pagePay = 'start';
            break;
        
        case 'address':
            $pageRequire = 'address.php';
            $titlePage = $titleBasketAddress;
            $pagePay = 'address';
            break;

        default:
            header('Location: '.URL_BASE.'/page_not_found');
    }

    if (!isset($_SESSION['id_usuario'])) {
        $letLogIn = ['address']; 
        if (in_array($_GET['page'], $letLogIn)) {
            header('Location: '.URL_BASE.$lang);
        }
    }

    include DIRECTORIO_ROOT.'inc/header.php';


    if (isset($_SESSION['id_usuario']) AND $_GET['page'] === 'basket') {
        $token = Secure::montar_clave_verificacion(Secure::generarCodigo(98));
        $token2 = Secure::montar_clave_verificacion(Secure::generarCodigo(78));
        $urlContinuar = URL_BASE.$lang.'/checkout/address/'.$token.'/'.$token2.'/'.$countCart.'/';
        $modal = '';
    }else{
        $urlContinuar = '';
        $modal = 'data-toggle="modal" data-target="'.$logMenu[0]['modal'].'"';
    }
?>


<div class="container-fluid" id="checkOutPage"> 
    <div class="container"> 
        <div class="row">
            <ol class="breadcrumb">
              <li><a href="<?php echo URL_BASE.$lang; ?>"><?php echo $titleIndex ?></a></li>
              <li><a href="<?php echo URL_BASE.$lang.'/checkout/basket/'; ?>"><?php echo $titleCheckout; ?></a></li>
              <li class="active"><?php echo $titlePage; ?></li>
            </ol>           
        </div>

        <div class="row">

            <!-- PRODUCTS CHECKOUT -->
                <div class="col-md-8 table-checkout">
                    
                    <?php require DIRECTORIO_ROOT.'inc/checkout/'.$pageRequire; ?>
                
                </div>
            <!-- END PRODUCTS CHECKOUT -->

            <?php require DIRECTORIO_ROOT.'inc/elements/resume-cart.php'; ?>
            
        </div>
    </div>
</div>

    

<?php include DIRECTORIO_ROOT.'inc/footer.php'; ?>
