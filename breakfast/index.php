<?php     
    if (!defined('URL_BASE')) { require '../config/config.php'; }    
    /*CLASSES REGISTER*/
    spl_autoload_register( function ($nombre_clase) {
        include DIRECTORIO_ROOT.'class/class.'.$nombre_clase.".php";
    });
    /*CLASSES REGISTER*/

    /*VALIDATE ISSET _get*/
    if (!isset($_GET['breakfast']) ) {
       header('Location: '.URL_BASE.$lang.'/#menu-list');
    }else{
        $nameProduct = CRUD::all('productos','nombre_producto_'.$lang,'serie = ?',['s',$_GET['breakfast']]);

        if (count($nameProduct) < 1) {
            header('Location: '.URL_BASE.$lang.'/#menu-list');
            exit();
        }        
        $nameP = stripslashes($nameProduct[0]['nombre_producto_'.$lang]);
    }
    /*#VALIDATE ISSET _get*/

    /*SET LANGUAJE*/
    if (!isset($web)) { $web = false; }    
    if (!$web){
       $lang = substr( $_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2 );
       header('Location: '.URL_BASE.$lang.'/breakfast/'.$_GET['breakfast'].'/');
    }
    /*#SET LANGUAJE*/

    /*HEADER*/
    $titlePage = ucwords(strtolower($nameP));
    include DIRECTORIO_ROOT.'inc/header.php';
    /*#HEADER*/

    /*VALIDATE ISSET PRODUCT*/
    $where = 'productos.serie = ?  AND productos_publicados.estado_publicado = ? AND productos.tm_delete IS NULL';
    $params = ['ss',$_GET['breakfast'],'SI'];
    $join = [
        ['INNER','productos_publicados','productos_publicados.serie = productos.serie']
    ];
    if ( CRUD::numRows('productos','*',$where,$params,$join ) === 0 ) {
        echo "<script type='text/javascript'>";
        echo "window.location.assign('".URL_BASE.$lang.'/#menu-list'."');";
        echo "</script>";
    }
    /*#VALIDATE ISSET PRODUCT*/

    /*LOAD PRODUCT INFO*/
    $categoria = 'categoria_'.$lang;
    $description = 'descripcion_'.$lang;
    $p = Products::find($_GET['breakfast']);
    $p_imgs = Products::imgProducts($_GET['breakfast']);
    $items = Products::itemsProducts( $p->id_producto , $lang );
    $where = 'productos_publicados.estado_publicado = ? AND productos.id_producto <> ?';
    $params = ['si','SI',$p->id_producto];
    $rows = '*, productos.id_producto';
    $others =  Products::cargarProductos($rows,$where,$params,'RAND()',6);// Related products
    /*#LOAD PRODUCT INFO*/

?>
<div class="container-fluid" style="background-color: #fcfcf4;">
        <div class="container">
            <div class="row">
                <ul class="breadcrumb">
                    <li><a href="<?php echo URL_BASE.$lang; ?>">Home</a>
                    <li><a href="<?php echo URL_BASE.$lang.'/#menu-list'; ?>">Breakfast</a>
                    </li>
                    <li><?php echo $titlePage; ?></li>
                </ul>
            </div>
            <div class="row" style="box-shadow: 0px 0px 4px #dccbcb; margin-bottom: 30px; padding: 40px 20px; background-color: white;">                    
                <div class="col-md-12">
                    <div class="box">
                        <div class="row">
                            <h4 class="text-center logo-name text-capitalized hidden-lg hidden-md">
                                <?php $nombre_idioma = 'nombre_producto_'.$lang; ?>
                                <?php echo ucwords(strtolower(stripslashes($p->$nombre_idioma))); ?>
                            </h4>
                        </div>  
                        <div class="row image-product">
                            <div class="col-md-5 col-sm-offset-1" >
                                <img id="zoom_05" src="<?php echo URL_PAGE.'/img_productos/'.$p->serie.'/small/'.$p->ruta_img_sm; ?>" data-zoom-image="<?php echo URL_PAGE.'/img_productos/'.$p->serie.'/large/'.$p->ruta_img_lg; ?>"/>

                                <div id="gallery_01"> 

                                    <?php foreach ($p_imgs as $img): ?>
                                        <a style="margin-top: 20px;" data-image="<?php echo URL_PAGE.'/img_productos/'.$p->serie.'/small/'.$img->ruta_img_sm; ?>" data-zoom-image="<?php echo URL_PAGE.'/img_productos/'.$p->serie.'/large/'.$img->ruta_img_lg; ?>">
                                            <img id="zoom_05" class="img-responsive" src="<?php echo URL_PAGE.'/img_productos/'.$p->serie.'/thumbnail/'.$img->ruta_img_tn; ?>" />
                                        </a>
                                    <?php endforeach ?>
                                    
                                </div>

                            </div>
                            <div class="col-md-5 container-info-product">
                                <h4 style="margin-bottom: 4px;" class="text-left logo-name text-capitalized hidden-sm hidden-xs">
                                    <?php echo ucwords(strtolower(stripslashes($p->$nombre_idioma))); ?>
                                </h4>

                                <small>
                                	<?php echo ucfirst(mb_strtolower($p->$categoria, 'UTF-8')); ?>
                                </small>
                                <div class="row">
                                    <form class="formAddCart" action="<?php echo URL_BASE.'bd/checkout/bag/agregar.php' ?>" method="post" role="form">
                                        <input type="hidden" name="empt_val">
                                        <input type="hidden" name="id_producto" value="<?php echo $p->id_producto; ?>">
                                        <br>
                                        <span style="position: relative; left: 14px; color: #4DB4A5;">
                                            <b><?php echo $productSec->content; ?></b>
                                        </span><br>
                                        <span style="position: relative; left: 14px;">
                                            <?php $listItems = ''; ?>
                                            <?php foreach ($items as $item): ?>
                                                <?php $listItems .= ucfirst(strtolower($item['item_'.$lang])).', '
                                                ?>
                                            <?php endforeach ?>
                                            <?php echo substr($listItems, 0, -2).'.'; ?>
                                        </span>
                                        <br>
                                        <br>

                                        <?php 
                                            $disp = $p->cantidad_entrada - $p->cantidad_salida;
                                            $max = 10;
                                            if ($disp < 10) {
                                                $max = $disp;
                                            }
                                        ?>

                                        <div class="form-group col-md-3">
                                            <label class="pull-left text-capitalized" style="color: black;"><?php echo ucfirst($productSec->quantity); ?></label>
                                            <input type="number" class="form-control" value="1" min="1" max="<?php echo $max; ?>" name="cantidad_bolsa"><br>
                                        </div>
                                        <br>
                                        <div class="col-md-12 pull-left">
                                            <button type="submit" name="" class="btn btn-mifu-modal btn-lg"><i class="fa fa-shopping-basket" aria-hidden="true"> <?php echo $productSec->addCart; ?> </i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div style="margin-top: 50px;">
                            <h5 class="text-center logo-name" style="font-size: 2em;">
                                <?php echo $productSec->other_products; ?>
                            </h5><br>                            
                        </div>
                        <div class="row">
                            <?php $counter = 0; ?>
                            <?php foreach ($others as $other): ?> 
                                <?php if ($counter === 0): ?>   
                                    <?php $class = 'col-md-offset-1'; ?>                                  
                                <?php elseif($counter === 5): ?>                               
                                    <?php $class = 'hidden-lg hidden-md'; ?>   
                                <?php else: ?>                                                           
                                    <?php $class = ''; ?>   
                                <?php endif ?>
                                    <div class="col-xs-6 col-md-2 <?php echo $class; ?>">
                                        <a href="<?php echo URL_BASE.$lang.'/breakfast/'.$other['serie'].'/'; ?>" class="thumbnail" title="<?php echo $other['nombre_producto_'.$lang]; ?>">
                                            <img src="<?php echo URL_BASE; ?>img_productos/<?php echo $other['serie']; ?>/thumbnail/<?php echo $other['ruta_img_tn']; ?>" >
                                        </a>
                                    </div>
                                <?php $counter++; ?>
                            <?php endforeach ?>
                        </div>

                    </div>
                </div><!-- /.col-md-9 -->
            </div><!-- row -->
        </div><!-- /.container -->
    </div><!-- /#container-fluid -->


<?php include DIRECTORIO_ROOT.'inc/footer.php'; ?>

<script type="text/javascript">
    // $("#zoom_05").elevateZoom({
    //   zoomType   : "inner",
    //   cursor: "crosshair"
    // });

    if (window.innerWidth > 1000) {
        $("#zoom_05").elevateZoom({
            responsive: true,    
            gallery:'gallery_01', 
            zoomType   : "inner",
            cursor: 'crosshair', 
            loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
        }); 
         //pass the images to Fancybox
        $("#zoom_05").bind("click", function(e) {  
          var ez =   $('#zoom_05').data('elevateZoom'); 
            $.fancybox(ez.getGsalleryList());
          return false;
        });

        $('#myTabs a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        })
    }else{
        $("#zoom_05").elevateZoom({
            responsive: false,    
            gallery:'gallery_01', 
            zoomType   : false,
            cursor: false, 
        }); 
    }

   
    
</script>