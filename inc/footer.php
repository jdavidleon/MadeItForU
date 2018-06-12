<!-- footer -->
    <footer class="footer text-center">
        <div class="footer-top">
            <div class="row">
                <div class="col-md-offset-3 col-md-6 text-center">
                    <div class="widget text-center">
                        <img class="animated flipInX" width="180px" src="<?php echo URL_BASE.'img/logo/logo-white-sm.png' ?>">

						<div class="col-xs-12">
						<br>
							<div class="col-lg-8 col-lg-offset-2 cont-princ-news">
                                <div id="circularG">
                                    <div id="circularG_1" class="circularG"></div>
                                    <div id="circularG_2" class="circularG"></div>
                                    <div id="circularG_3" class="circularG"></div>
                                    <div id="circularG_4" class="circularG"></div>
                                    <div id="circularG_5" class="circularG"></div>
                                    <div id="circularG_6" class="circularG"></div>
                                    <div id="circularG_7" class="circularG"></div>
                                    <div id="circularG_8" class="circularG"></div>
                                </div>
								<form action="<?php echo URL_BASE.'bd/newsletter/register.php' ?>" method="POST" id="formNews"> 
    								<div class="input-group container-news" style="">
                                        <input type="hidden" name="empt_val">
								        <input type="email" required class="input-type text-lowercase" placeholder="Email..." name="correo_news">	
								        <button type="submit" class="btn btn-news" value="Subscribe"><span class="">Subscribe</span>
								        </button>
								    </div><!-- /input-group -->
	                            </form>
	                            </div>
							</form>  
							</div>            
						<br>    
						<br>    
                        <br>    
						<br>    
						</div>     
                        <div class="social-list">
                            <a href="https://www.facebook.com/madeitforu.usa"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="https://www.instagram.com/madeitforu.usa/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </div>
                        <p class="copyright clear-float">
                            © <?php echo date('Y'); ?> Made It For U.
                            <div class="credits">                                
                                
                                <small style="color: white;" class="text-uppercase">
                                    <a href="<?php echo URL_BASE.$lang.'/bussiness/terms' ?>">
                                        Términos y condiciones
                                    </a>
                                    |
                                    <a href="<?php echo URL_BASE.$lang.'/bussiness/terms/#cookies' ?>">Política de Cookies</a>
                                </small><br>
                                Designed by <a href="https://juandleon.com/">juandleon.com</a>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- / footer -->
<!-- / footer -->
    <script src="<?php echo URL_BASE; ?>js/jquery.min.js"></script>
    <script src="<?php echo URL_BASE; ?>js/jquery.easing.min.js"></script>
    <script src="<?php echo URL_BASE; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo URL_BASE; ?>js/jquery.mixitup.min.js"></script>
    <script src="<?php echo URL_BASE; ?>js/jquery.waypoints.min.js"></script>
    <script src="<?php echo URL_BASE; ?>js/owl.carousel.min.js"></script>
    <script src="<?php echo URL_BASE; ?>js/jquery.elevateZoom-3.0.8.min.js"></script>

    <!-- custom -->
    <!-- <script async defer src="<?php echo URL_BASE; ?>js/custom-min.js"></script>
    <script async defer src="<?php echo URL_BASE; ?>js/functions-min.js"></script>
    <script async defer src="<?php echo URL_BASE; ?>js/ajax-min.js"></script> -->
    <script async defer src="<?php echo URL_BASE; ?>js/custom.js"></script>
    <script async defer src="<?php echo URL_BASE; ?>js/functions.js"></script>
    <script async defer src="<?php echo URL_BASE; ?>js/ajax.js"></script>
    <!-- custom -->

    <?php 

        if (isset($_SESSION['id_usuario'])) {
            $where = 'id_usuario = ? AND lang <> ?';
            $params = ['is',$_SESSION['id_usuario'],$lang];
            CRUD::delete('usuarios_lang',$where,$params);
            $set = [
                'id_usuario' => $_SESSION['id_usuario'], 
                'lang' => $lang
            ];
            $unique = [
                'conditional' => 'id_usuario = ? AND lang = ?',
                'params' => $params
            ];
            CRUD::insert('usuarios_lang',$set,$unique);
        }
    ?>

    <?php 
        if (isset($_GET['admin_credentials']) AND $_GET['admin_credentials'] == 'false'): 
    ?>
        <script type='text/javascript'>     
            setTimeout(function () {
                showAlert('wrong','ACCESO DENEGADO <br> Necesitas permisos de administrador');
            }, 2500);            
        </script>
    <?php endif ?>

    <?php if (isset($_GET['bd'])): ?>
        <script type="text/javascript">
            showAlert(<?php echo '"'.$_GET['bd'].'"'; ?>,<?php echo '"'.$_GET['msn'].'"'; ?>);
        </script>
    <?php endif ?>
    <script type="text/javascript">
        function defaultDir() { 
            $('#icon_select_dorder_1').removeClass('hide');
            $('#icon_not_select_dorder_1').addClass('hide');
            $("#dorder_1").css('border-color','#4DB4A5');
            $("#dorder_1").css('color','#4DB4A5');
        }
        defaultDir();
    </script>
</body>
</html>