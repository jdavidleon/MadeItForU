<?php     
    if (!defined('URL_BASE')) { require '../config/config.php'; }
    
    if (!isset($web)) { $web = false; }
    
    if (!$web){
       $idioma = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
       header('Location: '.URL_BASE.$idioma.'/pages');
    }

    switch ($_GET['page']) {
    	case 'about_us':
    		$pageRequire = 'about_us.php';
    		$titlePage = $titleAboutUs;
    		break;
        
        case 'terms':
            $pageRequire = 'terms.php';
            $titlePage = $titleTerms;
            break;

        case 'payment':
            $pageRequire = 'payment.php';
            $titlePage = $titlePayment;
            break;

    	default:
    		header('Location: '.URL_BASE.'/page_not_found');
    }
   
    include DIRECTORIO_ROOT.'inc/header.php';

?>
    <div class="container-fluid" style="background-color: #fcfcf4;">
        <div class="container">
            <div class="row">
                <ul class="breadcrumb">
                    <li><a href="<?php echo URL_BASE.$lang; ?>"><?php echo $titleIndex ?></a>
                    </li>
                    <li><?php echo ucwords(strtolower($titlePage)); ?></li>
                </ul>
            </div>
            <div class="row" style="box-shadow: 0px 0px 4px #dccbcb; margin-bottom: 30px; padding: 40px 20px; background-color: white;">                    
                <div class="col-md-12">
                    <div class="box">

                    <?php require DIRECTORIO_ROOT.'inc/bussiness/'.$pageRequire; ?>

                    </div>
                </div><!-- /.col-md-9 -->
            </div><!-- row -->
        </div><!-- /.container -->
    </div><!-- /#container-fluid -->

<?php include DIRECTORIO_ROOT.'inc/footer.php'; ?>