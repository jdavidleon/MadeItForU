<?php     
    if (!defined('URL_BASE')) { require 'config/config.php'; }
    
    if (!isset($web)) { $web = false; }
    
    if ($web!=true){
       $idioma = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
       header('Location: '.URL_BASE.$idioma.'/');
    }
    
    /* $out = 'url'; */
    $titlePage = $titleIndex;
    $margin_bottom = 0;
    include DIRECTORIO_ROOT.'inc/header.php';
    // include DIRECTORIO_ROOT.'inc/carousel.php';
?>  
    
    
    <!-- principal -->
    <section id="principal_img">
        <div class="section-padding bg-color" style="background-image: url(../img/principal-min.jpg);">
            <div class="back-opacity"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="jumbotron">
                            <img src="../img/logo/logo-blanco-300.png">
                            <h1 class="title-principal">
                                <?php echo $principalIndex->pharse; ?>
                            </h1>
                            <p class="txt-principal-small text-uppercase" style="font-weight: 200; font-size: 20px;">
                                <?php echo $principalIndex->sentence; ?>
                            </p>
                            <p>
                                <a class="btn btn-mifu-reverse btn-lg text-uppercase" style="border-radius: 0; border: 2px solid white;" href="#menu-list" role="button">
                                    <?php echo $principalIndex->btn_principal; ?>
                                </a>
                            </p>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </section>
    <!-- #principal -->

    <!-- banners -->
    <section id="banners">
        <div class="section-padding">
            <div class="container">
                <div class="row text-center">
                    <div class="col-sm-4 banner">
                        <div class="col-sm-10 col-sm-offset-1">                          
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <i class="fa fa-2x fa-bus" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="media-body text-left">
                                    <h5 class="media-heading text-left">
                                        <b><?php echo $bannerSec->shipping; ?></b>
                                    </h5>
                                    <small>
                                        <?php echo $bannerSec->shipping_content; ?>
                                    </small>
                                </div>
                             </div>
                        </div>
                    </div>
                    <div class="col-sm-4 banner">
                        <div class="col-sm-10 col-sm-offset-1">                                
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <i class="fa fa-2x fa-paypal" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="media-body text-left">
                                    <h5 class="media-heading text-left">
                                        <b><?php echo $bannerSec->payment; ?></b>
                                    </h5>
                                    <small>
                                        <?php echo $bannerSec->payment_content; ?>
                                    </small>
                                </div>
                             </div>
                        </div>
                    </div>
                    <div class="col-sm-4 banner">
                        <div class="col-sm-10 col-sm-offset-1">                              
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                    <i class="fa fa-2x fa-money" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="media-body text-left">
                                    <h5 class="media-heading text-left">
                                        <b><?php echo $bannerSec->guaranty; ?></b>
                                    </h5>
                                    <small>
                                        <?php echo $bannerSec->guaranty_content; ?>
                                    </small>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- #banners -->

    <!-- <img src="../img/map.PNG" width="100%" height="480"></img> -->

    <!-- How to buy it -->
    <section id="easy_buy">
        <div class="bg-color" style="background-color: #4DB4A5;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center" style="color: white;">
                        <div class="jumbotron" style="background-color: transparent;">
                            <h1 style="font-family: 'Satisfy', sans-serif; font-size: 2.8em;">
                                <?php echo $principalIndex->how_shop; ?>
                                <br>
                            </h1>
                            <br>
                            <?php if ($lang === 'es'): ?>
                                <iframe class="video-hb" src="https://www.youtube.com/embed/rK6tx8z8xu4" frameborder="0" allowfullscreen></iframe>
                            <?php else: ?>
                                <iframe class="video-hb" src="https://www.youtube.com/embed/x1WrJSxSHHg" frameborder="0" allowfullscreen></iframe>
                            <?php endif ?>
                            <br>
                            <p><br>
                                <a class="btn btn-lg" style="border: 2px solid white; border-radius: 0; color: white;" href="#menu-list" role="button">
                                    <?php echo $principalIndex->btn_how_to; ?>
                                </a>
                            </p>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </section>
    <!-- #How to buy it -->

    <!-- event -->
    <section id="event" class="hide">
        <div class="bg-color" class="section-padding" style="min-height: 0;">
            <div class="container">
                <div class="row" id="offert" style="opacity: 0;">
                    <div class="col-xs-12 text-center" style="padding:60px;">
                        <h1 class="header-h" style="color: white !important;"><?php echo $special->title; ?></h1>
                        <p class="header-p" style="color: white;"><?php echo $special->footTitle; ?></p>
                    </div>
                    <div class="col-md-12 hide" style="padding-bottom:60px;">
                        <div class="item active left">                            
                            <div class="col-md-6 col-sm-6 details-text" style="padding-top: 30px; padding-bottom: 40px;">
                                <div class="content-holder">
                                    <h2><?php echo $special->subTitle; ?></h2>
                                    <p><?php echo $special->extract; ?></p>
                                    <!-- <address>
                                        <strong>Place: </strong>
                                            1612 Collins Str, Victoria 8007
                                            <br>
                                        <strong>Time: </strong>
                                            07:30pm
                                    </address> -->
                                    <a class="btn btn-imfo btn-read-more btn-mifu" href="events-details.html">
                                        <?php echo $special->btn; ?>
                                    </a>
                                </div>
                            </div>                            
                            <div class="col-md-6 col-sm-6 left-images">
                                <img src="<?php echo URL_BASE; ?>img/res02.jpg" class="img-responsive">
                            </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ event -->


    <!-- products -->
    <section id="menu-list" class="section-padding" style="background-color: #F7F6F4; ">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center marb-35">
                    <h1 class="header-h"> 
                        <?php echo $productSec->title; ?> 
                    </h1>
                    <p class="header-p" style="color: black;">
                        <?php echo $productSec->footTitle; ?> 
                    </p>
                </div>
                <div class="col-md-12  text-center gallery-trigger">
                    <ul style="padding: 0;">
                        <li>
                            <a class="filter btn btn-mifu" data-filter="all">
                                <?php echo $productSec->btnAll; ?>  
                            </a>
                        </li>
                        <?php $categorias = CRUD::all('categorias'); ?>
                        <?php foreach ($categorias as $cat): ?>
                        <?php 
                            $join = [
                                ['INNER','productos_cantidad','productos_cantidad.id_producto = productos.id_producto'],
                                ['INNER','productos_publicados','productos_publicados.serie = productos.serie']
                            ];
                            $where = 'productos.id_categoria = ? AND (productos_cantidad.cantidad_entrada - productos_cantidad.cantidad_salida) > ? AND productos.tm_delete IS NULL AND productos_publicados.estado_publicado = ?';
                            $params = ['iis',$cat['id_categoria'],0,'SI'];
                            $prod = CRUD::numRows('productos','*',$where,$params,$join);
                         ?> 
                        <?php if ($prod > 0): ?>
                            <li>
                                <a class="filter btn btn-mifu text-capitalize" data-filter="<?php echo '.'.$cat['identificador']; ?>">
                                    <?php echo mb_strtolower($cat['categoria_'.$lang],'UTF-8'); ?>
                                </a>
                            </li>
                        <?php endif ?>
                            
                        <?php endforeach ?>
                    </ul>
                </div><!-- col-md-12 -->                
            </div><!-- row -->
        </div><!-- container -->
        <div id="containerProducts" class="container">
            <?php foreach ($categorias as $cat): ?>
            <?php $product = Products::consultaPorCategorias($cat['id_categoria']); ?>
            
            <?php foreach ($product as $prd): 
                $product_name = ucfirst(strtolower(stripslashes($prd['nombre_producto_'.$lang])));
            ?>

            <div class="mix <?php echo $cat['identificador']; ?> menu-restaurant media" data-myorder="2">
                <!-- Desktop products -->
                <div class="hidden-xs hidden-sm">
                    <div class="media-left media-middle">
                        <a href="#" class="">
                          <img src="<?php echo URL_PAGE.'/img_productos/'.$prd['serie'].'/small/'.$prd['ruta_img_sm']; ?>" alt="<?php echo $product_name; ?>">
                        </a>
                    </div><!-- media-left -->
                    <div class="media-body" id="mediaBodyProduct">
                        <h4 class="media-heading text-capitalize">
                                <?php echo $product_name; ?>
                            <br>
                        </h4>
                        <h5 style="color: #4DB4A5; margin-top: 20px;">
                        <?php echo $productSec->include; ?>
                        </h5>
                        <p style="font-size: 13px; height: 75px; max-height: 70px; line-height: 1.3;">
                            <?php 
                                $items = Products::itemsProducts( $prd['id_producto'] , $lang ); 
                            ?>
                            <?php $listItems = ''; ?>
                            <?php $contar = 0; ?>
                            <?php foreach ($items as $item): ?>
                                <?php if (strlen($listItems) < 90): ?>
                                <?php $listItems .= ucfirst(strtolower($item['item_'.$lang])).', '
                                ?>
                                <?php else: ?>
                                    <?php $contar++; ?>
                                <?php endif ?>                                
                            <?php endforeach ?>
                            <?php echo substr($listItems, 0, -2); ?>
                            <?php if ($contar > 0) { echo '...'; } ?>
                        </p>
                        
                        <form class="formAddCart" action="<?php echo URL_BASE.'bd/checkout/bag/agregar.php' ?>" method="post" role="form">
                            <input type="hidden" name="empt_val">
                            <input type="hidden" name="id_producto" value="<?php echo $prd['id_producto']; ?>">
                            <select name="cantidad_bolsa">
                                <option value="1">1</option>
                            </select>

                            <div class="text-center">
                                <p class="text-center">
                                    <?php echo number_format($prd['precio'],0,'.',','); ?> USD
                                </p>
                                <a href="breakfast/<?php echo $prd['serie'].'/'; ?>" class="btn btn-default btn-md btn-details">
                                    <i class="fa fa-eye" aria-hidden="true"> 
                                        <?php echo $productSec->details; ?>
                                    </i>
                                </a>
                                <button class="btn btn-mifu btn-md" type="submit">
                                    <i class="fa fa-shopping-basket" aria-hidden="true"> 
                                        <?php echo ucfirst($productSec->addCart); ?>
                                    </i>
                                </button>
                            </div>
                        </form>
                    </div><!-- media-body -->
                </div><!--  -->            
                <!--/ Desktop products -->

                <!-- Mobile products -->
                <div class="hidden-md hidden-lg" id="mobileContProd">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="<?php echo URL_PAGE.'/img_productos/'.$prd['serie'].'/small/'.$prd['ruta_img_sm']; ?>" alt="<?php echo $product_name; ?>" alt="<?php echo $product_name; ?>">
                            <div class="caption">
                                <h3 class="text-center">
                                    <?php echo number_format($prd['precio'],0,'.',','); ?> USD
                                </h3>
                                <form class="formAddCart" action="<?php echo URL_BASE.'bd/checkout/bag/agregar.php' ?>" method="post" role="form">
                                    <input type="hidden" name="empt_val">
                                    <input type="hidden" name="id_producto" value="<?php echo $prd['id_producto']; ?>">
                                    <select name="cantidad_bolsa">
                                        <option value="1">1</option>
                                    </select>
                                
                                    <p class="text-center">
                                        <a href="breakfast/<?php echo $prd['serie'].'/'; ?>" class="btn btn-default" role="button" style="background-color: transparent; border-radius: 0; color: #4DB4A5;">
                                            <i class="fa fa-eye" aria-hidden="true" style="font-size: 16px;"> 
                                            </i>
                                        </a> 
                                        <button class="btn btn-mifu" type="submit">
                                            <i class="fa fa-shopping-basket" aria-hidden="true"> 
                                               ADD
                                            </i>
                                        </button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Mobile products -->
            </div><!--  mix -->
            <?php endforeach ?>
            <?php endforeach ?>
        </div>
    </section>
    <!--/ products -->

    <!-- Set up your HTML -->
    
    <!-- map -->
        <section id="map">
            <div class="bg-color section-padding">
                <div class="back-map"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="jumbotron">
                                <h1 class="text-capitalize title-map">
                                   <?php echo $textMap->title; ?>
                                </h1>                                
                                <p class="first-p-map">
                                    <?php echo $textMap->subTitle; ?>
                                </p>

                                <p style="margin-top: 60px;">
                                    <small class="sm-second-p">
                                        <?php echo $textMap->delivery; ?>
                                    </small>
                                </p>
                                <p>
                                    <a class="btn btn-mifu-reverse btn-lg text-uppercase" style="border-radius: 0;" href="#menu-list" role="button">
                                        <?php echo $textMap->btn; ?>
                                    </a>
                                </p>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </section>
        <!-- #map -->

    <!-- Testimonials -->
    <section id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center marb-35" style="margin-top: 50px; margin-bottom: 0px;">
                    <h1 class="header-h"> 
                        <?php echo $productSec->testimonials; ?> 
                    </h1>
                </div>
            </div>
        </div>

       
        
        <div class="container container-msn-clients">
            <div class="owl-carousel carousel-text owl-theme">
                <div class="item">
                    <div class="col-sm-12 text-center" style="padding-top: 40px;">
                        <img src="../img_client/madre.png" alt="..." class="img-circle img-responsive img-testimonial">
                        <br>
                        <blockquote  class="blockquote-reverse text-center">
                            <p class="text-center">
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                    <?php if ($lang  === 'es'): ?>
                                        Quiero agradecer a Made it for U, porque hizo feliz a mamita adorable, de verdad es recomendable, Made it for U, estuvo espectacular
                                        <?php $form = 'de'; ?>
                                    <?php else: ?>
                                         I want to thanks to MADE IT FOR U, because it made happy my adorable mom, I really recomend it, MADE IT FOR U was amazing.
                                        <?php $form = 'from'; ?>
                                    <?php endif ?>
                                <i class="fa fa-quote-right" aria-hidden="true"></i>
                            </p>
                          <footer style="margin-top: 0px;" class="text-center">Lein Galvez <?php echo $form; ?> <cite title="Source Title">Wellington, Florida </cite></footer>
                        </blockquote>
                    </div>
                </div>
                <div class="item">
                    <div class="col-sm-12 text-center" style="padding-top: 40px;">
                        <img src="../img_client/nino.png" alt="..." class="img-circle img-testimonial">
                        <br>
                        <blockquote  class="blockquote-reverse text-center">
                            <p class="text-center">
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                    <?php if ($lang  === 'es'): ?>
                                        Agradezco a Made it for U, por ese delicioso desayuno que mi hijo recibió el día de su Primera Comunión. Todo muy bonito.
                                    <?php else: ?>
                                       Thanks to made it for u for the delicious breakfast that my son got on his first Communion. <br> Everything was so cute.
                                    <?php endif ?>
                                <i class="fa fa-quote-right" aria-hidden="true"></i>
                            </p>
                          <footer style="margin-top: 25px;" class="text-center">Carlos Castro <?php echo $form; ?> <cite title="Source Title">West Palm Beach, Florida </cite></footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Carousel-msn-clients -->





    <!-- contact -->
    <section id="contact" class="section-padding" style="position: relative; background: url(<?php echo URL_BASE; ?>img/contact1.jpg) no-repeat; background-size: cover; ">
        <div style="position: absolute; top: 0; bottom: 0; right: 0; left: 0; background-color: rgba(0, 0, 0, 0.26);"></div>
        <div class="container" >
            <div class="col-md-6 col-md-offset-6" style="background-color: rgba(0, 0, 0, 0.6); padding-bottom: 40px; padding-top: 40px;">                
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="header-h" style="color: white !important;"><?php echo $textContact->title; ?></h1>
                        <p class="header-p"><?php echo $textContact->subTitle; ?> </p>
                    </div>
                </div>
                <div class="row msg-row">
                    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                    <form action="<?php echo URL_BASE.'bd/users/contact.php' ?>" method="post" role="form" class="contactForm">
                        <input type="hidden" name="empt_val">
                        <input type="hidden" name="lang" value="<?php echo $lang; ?>">
                        <div id="sendmessage"><?php echo $textContact->confirm; ?></div>
                        <div id="errormessage"></div>

                        <input type="hidden" name="empt_val">

                        <div class="col-sm-12 contact-form pad-form">
                            <div class="form-group label-floating is-empty">
                                <input type="text" name="nombre_contacto" class="form-control form-contact" id="name" placeholder="<?php echo $textContact->name; ?>" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validation">text</div>
                            </div>                        
                        </div>
                        <div class="col-sm-12 contact-form pad-form">
                            <div class="form-group">
                                <input type="email" class="form-control form-contact label-floating is-empty" name="correo_contacto" id="email" placeholder="<?php echo $textContact->email; ?>" data-rule="email" data-msg="Please enter a valid email" />
                                <div class="validation"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 contact-form">
                            <div class="form-group">
                                <input type="text" class="form-control form-contact label-floating is-empty" name="telefono_contacto" id="phone" placeholder="<?php echo $textContact->phone; ?>" data-rule="required" data-msg="This field is required" />
                                <div class="validation"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 contact-form">
                            <div class="form-group">
                                <input type="text" class="form-control form-contact label-floating is-empty" name="asunto_contacto" id="people" placeholder="<?php echo $textContact->subject; ?>" data-rule="required" data-msg="This field is required" />
                                <div class="validation"></div>
                            </div>
                        </div>
                        <div class="col-md-12 contact-form">
                            <div class="form-group label-floating is-empty">
                                <textarea class="form-control form-contact" name="mensaje_contacto" rows="5" rows="3" data-rule="required" data-msg="Please write something for us" placeholder="<?php echo $textContact->message; ?>"></textarea>
                                <div class="validation"></div>
                            </div>
                            
                        </div>
                        <div class="col-md-12 btnpad">
                            <div class="contacts-btn-pad">
                                <button class="btn btn-lg btn-block btn-mifu text-uppercase" style="border: 2px solid white; color: white;"><?php echo $textContact->btn; ?></button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / contact -->

    
    <!--about-->
    <section id="about" class="section-padding">
        <div class="container" style="padding-top: 20px;">
            <div class="row ref-about-info"></div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="col-md-6 col-sm-6">
                        <div class="about-info text-center">
                            <h1 class="header-h logo-name text-center marb-35 animated bounceInLeft" ><?php echo $aboutUs->title; ?></h1>                  
                            <p class="text-center animated bounceInLeft">
                                <?php echo $aboutUs->extract; ?>
                            </p>
                            <br>
                            <a href="<?php echo URL_BASE.$lang.'/bussiness/about_us/' ?>" class="btn btn-lg btn-mifu">
                                <?php echo $aboutUs->btn; ?>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 about-img text-center">
                        <img id="img-aboutus" style="" src="<?php echo URL_BASE ?>img/about-us.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>
    <!--/about-->


<?php include 'inc/footer.php'; ?>
