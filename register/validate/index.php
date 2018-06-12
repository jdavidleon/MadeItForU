<?php  
    if (!defined('URL_BASE')) {  require '../../config/config.php'; }

    require DIRECTORIO_ROOT.'config/lang.php';
    $titlePage = $titleCheckout;
    $specialPage = true;
    require DIRECTORIO_ROOT.'inc/header.php';
?>
        <div class="container-fluid" style="background-color: #fcfcf4;">
            <div class="container">
                <div class="row">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>New Acount</li>
                    </ul>
                </div>
                <div class="row" style="box-shadow: 0px 0px 4px #dccbcb; margin-bottom: 30px; padding: 40px 20px; background-color: white;">                    
                    <div class="col-md-12">
                        <div class="row" id="error-page">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="box">

                                    <h3 class="text-center logo-name" style="margin-top: 40px; font-size: 35px;">Creación de Cuenta</h3>
                                    <h4 class="text-muted text-center"><?php echo $_GET['msn']; ?></h4>

                                    <h4 class="text-center"></h4>

                                    <p class="buttons text-center" style="margin: 35px 0;">
                                        <a href="#" data-toggle="modal" data-target="#login-modal" class="btn btn-mifu-reverse" style="border-radius: 0;"><i class="fa fa-home"></i> Ir al home</a>
                                    </p>
                                    <p class="text-center">
                                        Si tienes problemas con tu cuenta por favor <a href="<?php echo URL_BASE.$lang.'/contact/' ?>">contáctanos</a>. Te ayudaremos a resolverlo.
                                    </p>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div><!-- /.col-md-9 -->
                </div><!-- row -->
            </div><!-- /.container -->
        </div><!-- /#content -->
<?php require DIRECTORIO_ROOT.'inc/footer.php'; ?>
