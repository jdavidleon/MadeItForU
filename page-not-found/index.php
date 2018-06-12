<?php  
    if (!defined('URL_BASE')) {  require '../config/config.php'; }
    require DIRECTORIO_ROOT.'config/lang.php';
    $titlePage = ucwords($title404);
    require DIRECTORIO_ROOT.'inc/header.php';
 ?>
        <div class="container-fluid" style="background-color: #fcfcf4;">
            <div class="container">
                <div class="row">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URL_BASE.$lang; ?>">Home</a>
                        </li>
                        <li class="text-capitalized">404 - <?php echo $title404; ?></li>
                    </ul>
                </div>
                <div class="row" style="box-shadow: 0px 0px 4px #dccbcb; margin-bottom: 30px; padding: 40px 20px; background-color: white;">                    
                    <div class="col-md-12">
                        <div class="row" id="error-page">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="box">

                                    <h3 class="text-center logo-name text-capitalized" style="margin-top: 40px; font-size: 35px;"><?php echo $title404; ?></h3>
                                   
                                    <h4 class="text-center">
                                        <?php echo $error->PAGE_NOT_FOUND; ?>
                                    </h4>

                                    <p class="buttons text-center" style="margin: 35px 0;">
                                        <a href="<?php echo URL_PAGE; ?>" class="btn btn-mifu-reverse" style="border-radius: 0;"><i class="fa fa-home"></i> home</a>
                                    </p>
                                    <p class="text-center">
                                        <?php echo $success->btn_contact_us; ?>
                                    </p>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div><!-- /.col-md-9 -->
                </div><!-- row -->
            </div><!-- /.container -->
        </div><!-- /#content -->
<?php require DIRECTORIO_ROOT.'inc/footer.php'; ?>
