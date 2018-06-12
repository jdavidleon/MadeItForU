<?php     
    if (!defined('URL_BASE')) { require '../config/config.php'; }
    
    if (!isset($web)) { $web = false; }
    
    if (!$web){
       $idioma = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
       header('Location: '.URL_BASE.$idioma.'/pages');
    }

    switch ($_GET['page']) {
        case 'activate':
            $pageRequire = 'activate.php';
            $titlePage = 'ACTIVATE ACOUNT';
            break;
        
        case 'contact':
            $pageRequire = 'contact.php';
            $titlePage = 'CONTACT US';
            break;

        case 'login':
            $pageRequire = 'login.php';
            $titlePage = 'Log In';
            break;
        
        case 'signup':
            $pageRequire = 'signup.php';
            $titlePage = 'SIGN UP';
            break;
                
        case 'forgotpassword':
            $pageRequire = 'forgotpassword.php';
            $titlePage = 'Forgot Password';
            break;
                
        case 'restore':
            $pageRequire = 'restorepassword.php';
            $titlePage = 'Restore Password';
            break;
                
        case 'restore_account':
            $pageRequire = 'restore_account.php';
            $titlePage = 'Restore Password';
            break;

        case 'newsletter_unsubscribe':
            $pageRequire = 'newsletter_unsubscribe.php';
            $titlePage = 'Unsubscribe Newsletter';
            break;
        
        default:
            header('Location: '.URL_BASE.'/page_not_found');
    }

    if (isset($_SESSION['id_usuario'])) {
        $letLogIn = ['contact','newsletter_unsubscribe']; 
        if (!in_array($_GET['page'], $letLogIn)) {
            header('Location: '.URL_BASE.$lang);
        }
    }

    
    include DIRECTORIO_ROOT.'inc/header.php';

?>
    <div class="container-fluid" style="background-color: #fcfcf4;">
        <div class="container">
            <div class="row">
                <ul class="breadcrumb">
                    <li><a href="<?php echo URL_BASE.$lang; ?>">Home</a>
                    </li>
                    <li><?php echo ucwords(strtolower($titlePage)); ?></li>
                </ul>
            </div>
            <div class="row" style="box-shadow: 0px 0px 4px #dccbcb; margin-bottom: 30px; padding: 40px 20px; background-color: white;">                    
                <div class="col-md-12">
                    <div class="row" id="error-page">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="box">

                            <?php require DIRECTORIO_ROOT.'inc/pages/'.$pageRequire; ?>

                            </div>
                        </div>
                    </div><!-- row -->
                </div><!-- /.col-md-9 -->
            </div><!-- row -->
        </div><!-- /.container -->
    </div><!-- /#container-fluid -->

<?php include DIRECTORIO_ROOT.'inc/footer.php'; ?>