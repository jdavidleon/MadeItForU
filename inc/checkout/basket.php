<h4 class="text-center logo-name text-capitalized" style="font-size: 2.1em"><b><?php echo $cartPopover->header; ?></b></h4>


<?php if ($countCart < 1): ?>
    
    <li class="media">
        <div class="media-body text-center text-uppercase">
        <br><br>
            <i class="fa fa-5x fa-shopping-basket" aria-hidden="true" style="color: #d5dadc;"></i>
            <br>
            <br>
            <?php echo $cartPopover->empty; ?>
            <br>
            <br>
            <br>
            <br>
            <a class="btn btn-mifu-modal" style="border-radius: 0;" href="<?php echo URL_BASE.$lang.'/#menu-list'; ?>">
            <?php echo $cartPopover->btnEmpty; ?>
            </a>
        </div>
    </li>

<?php else: ?>

    <!-- TABLE PRODUCTS CHECKOUT DESCKTOP -->
    <table class="table table-hover hidden-xs">
        <tr>                        
            <th colspan="2" class="text-center text-capitalized">
                <?php echo ucfirst($tableCheck->product); ?>
            </th> 
            <th class="text-center text-capitalized">
                <?php echo ucfirst($tableCheck->price); ?>
            </th>
            <th class="text-center text-capitalized">
                <?php echo ucfirst($tableCheck->quantity); ?>
            </th>
            <th class="text-center text-capitalized" >
                <?php echo ucfirst($tableCheck->total); ?>
            </th>
            <th class="text-center text-capitalized">
                <?php echo ucfirst($tableCheck->delete); ?>
            </th>
        </tr>

        <?php $notReady = 0; ?>
        <?php $generalValidateMsnAll = true; ?>
        <?php foreach ($bolsa as $prd): ?>
        <tr>    
            <td>
                <img class="img-thumbnail" height="90px"  width="90px" src="<?php echo URL_PAGE.'/img_productos/'.$prd->serie.'/thumbnail/'.$prd->ruta_img_tn; ?>"  alt="...">
            </td>
            <td class="text-center">
                <h5 class="media-heading text-uppercase" style="margin-bottom: 0;">
                    <?php $nombre_idioma = 'nombre_producto_'.$lang; ?>
                    <b><?php echo $prd->$nombre_idioma; ?></b>                             
                </h5>
            </td>   
            <td class="text-center">
                <small>
                    <b><span>
                        <?php echo $prd->precio; ?>
                    </span> USD</b>
                </small>
            </td>
            <td class="input-quantity">
                <div class="input-group text-center">
                    <i class="fa fa-minus-circle " aria-hidden="true" onclick="restCart(<?php echo $prd->id_bolsa_compras; ?>,<?php echo $prd->id_producto; ?>)"></i>
                    <input style="background-color: white;" type="text" disabled class="cantidadBolsa<?php echo $prd->id_producto; ?>" value="<?php echo $prd->cantidad_bolsa; ?>" min="1" name="">
                    <i class="fa fa-plus-circle" aria-hidden="true" onclick="sumCart(<?php echo $prd->id_bolsa_compras; ?>,<?php echo $prd->id_producto; ?>)"></i>
                </div>
            </td>
            <td class="text-center">
                <small>
                    <b><span class="total-producto<?php echo $prd->id_producto; ?>">    <?php echo $prd->precio_total; ?>
                    </span> USD</b>
                </small>
            </td>
            <td class="text-center">
                <form method="post" action="<?php echo URL_BASE.'bd/checkout/bag/eliminar.php'; ?>" id="deleteForm<?php echo $prd->id_bolsa_compras; ?>">
                    <input type="hidden" name="empt_val">
                    <input type="hidden" name="id_bolsa_compras" value="<?php echo $prd->id_bolsa_compras; ?>">
                    <input type="hidden" name="id_producto" value="<?php echo $prd->id_producto; ?>">
                    <input type="hidden" name="lang" value="<?php echo $lang; ?>">
                    <i onclick="deleteCartItem(<?php echo $prd->id_bolsa_compras; ?>)" class="btn fa fa-trash" aria-hidden="true" title="Quitar"></i>
                </form>                                 
            </td>
        </tr>

        <?php 
            $dataFormMessage = Secure::decodeArray([
                'destinatario' => '',
                'motivo' => '',
                'frase_personalizada' => '',
                'mensaje_tarjeta' => '',
            ]);  

            if (isset($_SESSION['id_usuario'])) {
                $rows = 'destinatario, motivo, frase_personalizada, mensaje_tarjeta';
                $where = 'id_bolsa_compras = ? AND tm_delete IS NULL';
                $params = ['i',$prd->id_bolsa_compras];
                $formMessage =  CRUD::all('venta_personalizar',$rows,$where,$params);
                if (count($formMessage) === 1) {
                    $dataFormMessage = Secure::decodeArray($formMessage[0]);
                }
            }elseif (isset($_COOKIE['bolsa'])) {
                $findCookie = Cookie::find('bolsa',['id_producto' => $prd->id_producto]);
                $dataFormMessage = Secure::decodeArray($findCookie);
                unset($dataFormMessage->id_producto);
                unset($dataFormMessage->cantidad_bolsa);
            }

            $messageCount = 0;
            foreach ($dataFormMessage as $value) {
                if ($value !== '') {
                    $messageCount++;
                }
            }
            $messageCount > 0 ? $messagePresent = true : $messagePresent = false ;

            $generalValidateMsn = true;
            if (!$messagePresent) {
                $generalValidateMsn = false;
                $generalValidateMsnAll = false;
            }
        ?>

        <tr class="btn-form-pers" btn-form="<?php echo 'pers-'.$prd->id_producto; ?>">
            <td colspan="6" class="text-center">
                <?php if (!$messagePresent): ?>
                    <a class="text-warning">
                        <?php echo $tableCheck->alert_msn_empty; ?>
                    </a>. 
                    <a class="btn btn-warning btn-xs"><?php echo $tableCheck->btn_alert_empty; ?></a>
                <?php else: ?>
                    <a class="text-info"><?php echo $tableCheck->alert_msn_ok; ?></a>. 
                    <a class="btn btn-info btn-xs"> <?php echo $tableCheck->btn_alert_ok; ?> </a>
                <?php endif ?>               
            </td>
        </tr>

        <tr class="area-personalizar <?php echo 'pers-'.$prd->id_producto; ?>">
            <td colspan="6">
                <div class="row">
                    <div class="col-sm-12 text-center"><br>
                        <!-- Ingresa La información para personalizar tu pedido -->
                    </div>
                </div>
            
                <div class="row">
                    <form method="post" action="<?php echo URL_BASE.'bd/checkout/bag/frase_personalizada.php'; ?>">                        
                        <input type="hidden" name="empt_val">
                        <input type="hidden" name="lang" value="<?php echo $lang; ?>">
                        <input type="hidden" name="id_bolsa_compras" value="<?php echo $prd->id_bolsa_compras; ?>">
                        <input type="hidden" name="id_producto" value="<?php echo $prd->id_producto; ?>">
                        
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label class="text-center"><?php echo $tableCheck->form_who; ?></label>
                            <input type="text" class="form-control" name="destinatario" required value="<?php echo $dataFormMessage->destinatario; ?>">
                            <span class="hide required text-danger">
                                <i class="fa fa-times-circle" aria-hidden="true">
                                <?php echo $formTXT->required; ?></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label><?php echo $tableCheck->form_why; ?></label>
                            <input type="text" class="form-control" name="motivo" required value="<?php echo $dataFormMessage->motivo; ?>">
                            <span class="hide required text-danger">
                                <i class="fa fa-times-circle" aria-hidden="true">
                                <?php echo $formTXT->required; ?></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="form-group">
                            <label><?php echo $tableCheck->form_basket; ?></label>
                            <input type="text" class="form-control val_lentgh_txt" name="frase_personalizada" maxlength="35" required value="<?php echo $dataFormMessage->frase_personalizada; ?>">
                            <small class="text-success pull-right msn-lenght">
                                 <span>35</span> <?php echo $tableCheck->form_basket_lenght; ?>
                            </small>
                            <span class="hide msn-lenght-rev text-danger">
                                <i class="fa fa-times-circle" aria-hidden="true">
                                    <?php echo $tableCheck->form_basket_lenght_error; ?>
                                </i>
                            </span>
                            <span class="hide required text-danger">
                                <i class="fa fa-times-circle" aria-hidden="true">
                                <?php echo $formTXT->required; ?></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="form-group">
                            <label><?php echo $tableCheck->form_target; ?></label>
                            <textarea class="form-control val_lentgh_txt" rows="5" name="mensaje_tarjeta" required maxlength="250"><?php echo $dataFormMessage->mensaje_tarjeta; ?></textarea>
                            <small class="text-success pull-right msn-lenght">
                                 <span>250</span> <?php echo $tableCheck->form_basket_lenght; ?>
                            </small>
                            <span class="hide required text-danger">
                                <i class="fa fa-times-circle" aria-hidden="true">
                                <?php echo $formTXT->required; ?></i>
                            </span>
                            <span class="hide msn-lenght-rev text-danger">
                                <i class="fa fa-times-circle" aria-hidden="true">
                                    <?php echo $tableCheck->form_basket_lenght_error; ?>
                                </i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <input style="margin-bottom: 35px;" href="" type="submit" class="btn btn-mifu"  value="<?php echo $tableCheck->form_btn_save; ?>">
                </div>
            </form> 
            </td>
        </tr>                         
        <?php endforeach ?> 


        <?php foreach ($bolsaAgotados as $prd): ?>
            <tr>    
                <td>
                    <img class="img-thumbnail" height="90px"  width="90px" src="<?php echo URL_BASE.'img_productos/'.strtoupper($prd->serie).'/'.$prd->ruta_img_frontal; ?>"  alt="...">
                </td>
                <td class="text-center">
                    <h5 class="media-heading text-uppercase">
                        <b><?php echo $prd->nombre_producto; ?></b>                             
                    </h5>
                </td> 
                <td class="text-center">
                    <small><span><?php echo $prd->precio; ?></span> USD</small>
                </td>
                <td class="input-quantity">
                    <span><b class="text-danger">AGOTADO</b></span>
                </td>
                <td class="text-center">
                    <small><span id="total-producto<?php echo $prd->id_producto; ?>"><?php echo $prd->precio_total; ?></span> USD</small>
                </td>
                <td class="text-center">
                    <form action="<?php echo URL_BASE.'bd/checkout/bag/eliminar.php'; ?>" id="deleteForm<?php echo $prd->id_bolsa_compras; ?>">
                        <input type="hidden" name="empt_val">
                        <input type="hidden" name="id_bolsa_compras" value="<?php echo $prd->id_bolsa_compras; ?>">
                        <input type="hidden" name="lang" value="<?php echo $lang; ?>">
                        <i onclick="deleteCartItem(<?php echo $prd->id_bolsa_compras; ?>)" class="btn fa fa-trash" aria-hidden="true" title="Quitar"></i>
                    </form>                                 
                </td>
            </tr>               
        <?php endforeach ?>                     
        <tr>
            <td colspan="6" class="text-center text-uppercase">
                <h4><br>
                    <b>
                        <?php echo ucfirst(strtolower($tableCheck->subtotal)); ?> 
                        <span class="totalPagar"><?php echo $precio_total ?></span> USD
                    </b>
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="text-uppercase text-center">
                <?php if ($generalValidateMsnAll): ?>
                    <br>
                    <a style="font-weight: 900; font-size: 1.25em;" href="<?php echo $urlContinuar; ?>" <?php echo $modal; ?> class="btn btn-lg btn-mifu-modal"><?php echo $resumeCheck->btn; ?></a>
                <?php else: ?>
                    <br>
                    <p class="text-center text-danger">
                        <b><?php echo $resumeCheck->alert_personal_order; ?></b>
                    </p>
                <?php endif ?>            
            </td>
        </tr>
    </table> 
    <!-- END TABLE PRODUCTS CHECKOUT DESKTOP -->


    <!-- TABLE PRODUCTS CHECKOUT MOBILE -->       
    <ul class="media-list visible-xs">
        <?php foreach ($bolsa as $prd): ?>
        <?php 
            $dataFormMessage = Secure::decodeArray([
                'destinatario' => '',
                'motivo' => '',
                'frase_personalizada' => '',
                'mensaje_tarjeta' => '',
            ]);  

            
            if (isset($_SESSION['id_usuario'])) {
                $rows = 'destinatario, motivo, frase_personalizada, mensaje_tarjeta';
                $where = 'id_bolsa_compras = ? AND tm_delete IS NULL';
                $params = ['i',$prd->id_bolsa_compras];
                $formMessage =  CRUD::all('venta_personalizar',$rows,$where,$params);
                if (count($formMessage) === 1) {
                    $dataFormMessage = Secure::decodeArray($formMessage[0]);
                }
            }elseif (isset($_COOKIE['bolsa'])) {
                $findCookie = Cookie::find('bolsa',['id_producto' => $prd->id_producto]);
                $dataFormMessage = Secure::decodeArray($findCookie);
                unset($dataFormMessage->id_producto);
                unset($dataFormMessage->cantidad_bolsa);
            }
            

            $messageCount = 0;
            foreach ($dataFormMessage as $value) {
                if ($value !== '') {
                    $messageCount++;
                }
            }
            $messageCount > 0 ? $messagePresent = true : $messagePresent = false ;

            $generalValidateMsn = true;
            if (!$messagePresent) {
                $generalValidateMsn = false;
                $generalValidateMsnAll = false;
            }
        ?>
        <li class="media">
            <div class="media-left">
                <a href="#">
                    <img  style="margin-right: 10px;" class="media-object" width="90px" height="90px" src="<?php echo URL_PAGE.'/img_productos/'.$prd->serie.'/thumbnail/'.$prd->ruta_img_tn; ?>"  alt="...">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading ">
                    <small class="text-uppercase">
                        <?php $nombre_idioma = 'nombre_producto_'.$lang; ?>
                        <b><?php echo $prd->$nombre_idioma; ?></b>
                    </small>
                    <br>
                    <span class="pull-right" onclick="deleteCartItem(<?php echo $prd->id_bolsa_compras; ?>)"><i class="fa fa-trash" aria-hidden="true" title="Quitar"></i></span>
                </h4>
                <div class="input-group pull-left">
                    <i class="fa fa-minus-circle " aria-hidden="true" onclick="restCart(<?php echo $prd->id_bolsa_compras; ?>,<?php echo $prd->id_producto; ?>)"></i>
                        <input  style="background-color: white;" type="text" disabled class="cantidadBolsa<?php echo $prd->id_producto; ?>" value="<?php echo $prd->cantidad_bolsa; ?>" min="1" name="">
                        <i class="fa fa-plus-circle" aria-hidden="true" onclick="sumCart(<?php echo $prd->id_bolsa_compras; ?>,<?php echo $prd->id_producto; ?>)"></i>
                </div>              
                <b>
                    <span class="pull-right">
                        <span class="total-producto<?php echo $prd->id_producto; ?>"><?php echo $prd->precio_total; ?></span> USD
                    </span>
                </b>
            </div>
            <div class="media-footer text-center" style="padding: 10px 0">
                <small class="btn-form-pers" btn-form="<?php echo 'pers-'.$prd->id_producto; ?>">
                    <?php if (!$messagePresent): ?>
                        <a class="text-warning">
                            <?php echo $tableCheck->alert_msn_empty; ?>
                        </a>. 
                        <a class="btn btn-warning btn-xs"><?php echo $tableCheck->btn_alert_empty; ?></a>
                    <?php else: ?>
                         <a class="text-info"><?php echo $tableCheck->alert_msn_ok; ?></a>. 
                        <a class="btn btn-info btn-xs"> <?php echo $tableCheck->btn_alert_ok; ?> </a>
                    <?php endif ?>     
                </small>
                <br>
                <br>
                <small style="width: 100%" class="area-personalizar <?php echo 'pers-'.$prd->id_producto; ?>">
                    <div class="row">
                        <form method="post" action="<?php echo URL_BASE.'bd/checkout/bag/frase_personalizada.php'; ?>">                        
                            <input type="hidden" name="empt_val">
                            <input type="hidden" name="lang" value="<?php echo $lang; ?>">
                            <input type="hidden" name="id_bolsa_compras" value="<?php echo $prd->id_bolsa_compras; ?>">
                            <input type="hidden" name="id_producto" value="<?php echo $prd->id_producto; ?>">
                                
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="text-center"><?php echo $tableCheck->form_who; ?></label>
                                    <input type="text" class="form-control" name="destinatario" required value="<?php echo $dataFormMessage->destinatario; ?>">
                                    <span class="hide required text-danger">
                                        <i class="fa fa-times-circle" aria-hidden="true">
                                        <?php echo $formTXT->required; ?></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label><?php echo $tableCheck->form_why; ?></label>
                                    <input type="text" class="form-control" name="motivo" required value="<?php echo $dataFormMessage->motivo; ?>">
                                    <span class="hide required text-danger">
                                        <i class="fa fa-times-circle" aria-hidden="true">
                                        <?php echo $formTXT->required; ?></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label><?php echo $tableCheck->form_basket; ?></label>
                                    <input type="text" class="form-control val_lentgh_txt" name="frase_personalizada" maxlength="35" required value="<?php echo $dataFormMessage->frase_personalizada; ?>">
                                    <small class="text-success pull-right msn-lenght">
                                         <span>35</span> <?php echo $tableCheck->form_basket_lenght; ?>
                                    </small>
                                    <span class="hide msn-lenght-rev text-danger">
                                        <i class="fa fa-times-circle" aria-hidden="true">
                                            <?php echo $tableCheck->form_basket_lenght_error; ?>
                                        </i>
                                    </span>
                                    <span class="hide required text-danger">
                                        <i class="fa fa-times-circle" aria-hidden="true">
                                        <?php echo $formTXT->required; ?></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label><?php echo $tableCheck->form_target; ?></label>
                                    <textarea class="form-control val_lentgh_txt" rows="5" name="mensaje_tarjeta" required maxlength="250"><?php echo $dataFormMessage->mensaje_tarjeta; ?></textarea>
                                    <small class="text-success pull-right msn-lenght">
                                         <span>250</span> <?php echo $tableCheck->form_basket_lenght; ?>

                                    </small>
                                    <span class="hide required text-danger">
                                        <i class="fa fa-times-circle" aria-hidden="true">
                                        <?php echo $formTXT->required; ?></i>
                                    </span>
                                    <span class="hide msn-lenght-rev text-danger">
                                        <i class="fa fa-times-circle" aria-hidden="true">
                                            <?php echo $tableCheck->form_basket_lenght_error; ?>
                                        </i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row text-center">
                            <input style="margin-bottom: 35px;" href="" type="submit" class="btn btn-mifu btn-sm"  value="<?php echo $tableCheck->form_btn_save; ?>">
                        </div>
                    </form> 
                </small>
           </div>
        </li>
        <?php endforeach ?>                 

        <li class="text-center">
            <?php if (!$generalValidateMsnAll): ?>
                <br/>
            <?php endif ?>            
            <span class="text-uppercase"><b>
                <?php echo $tableCheck->subtotal; ?>
                <span class="totalPagar"><?php echo $precio_total ?></span>  USD
            </b></span>
        </li>
        <?php if (!$generalValidateMsnAll): ?>
        <li>
            <p class="text-center text-danger">
                <b><?php echo $resumeCheck->alert_personal_order; ?></b>
            </p>            
        </li>
        <?php endif ?> 
    </ul> 
    <!-- END TABLE PRODUCTS CHECKOUT MOBILE -->
<?php endif ?>