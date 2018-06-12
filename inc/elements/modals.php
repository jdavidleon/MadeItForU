
<!-- LogIn Modal -->
<div class="modal fade" id="logInModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h3 class="text-uppercase"><?php echo $loginM->title; ?></h3>
          <hr style="border-color: #4DB2A4;">
      </div>          
      <form class="form-modals" action="<?php echo URL_BASE.'bd/users/login.php'; ?>" method="post" role="form">
        <div class="modal-body">
            <?php include DIRECTORIO_ROOT.'inc/form/login.php'; ?>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-mifu-modal btn-block" style="">
            <?php echo $loginM->btn; ?>
          </button>
          <p class="text-center">
            <a href="<?php echo URL_BASE.$lang.'/pages/forgotpassword/'; ?>">Forgot password</a> ?
            <a style="" href="" data-toggle="modal" data-target="#signUpModal"><br> 
              <?php echo $loginM->btnSignUp; ?></a>
          </p>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- SignUp Modal -->
<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

          <h3 class="text-uppercase"><?php echo $signUpM->title; ?> </h3>
          <hr style="border-color: #4DB2A4;">
      </div>
        
          
      <form class="form-modals form" action="<?php echo URL_BASE.'bd/users/nuevo.php' ?>" method="POST" role="form">
        <div class="modal-body" style="">
            
          <?php include DIRECTORIO_ROOT.'inc/form/signup.php'; ?>

        </div>
        <div class="modal-footer" style="padding-top: 0;">
          <button type="submit" class="btn btn-mifu-modal btn-block"><?php echo $loginM->btnSignUp; ?></button>
          <p class="text-center" style="margin-top: 20px;">
            <?php echo $signUpM->already; ?> <br>
            <a style="color: black; text-decoration: underline;" href="" onclick="closeSignUpModal();" data-toggle="modal" data-target="#logInModal"><?php echo $signUpM->btnLogIn; ?> </a>
          </p>
        </div>
      </form>
    </div>
  </div>
</div>




<!-- Add Address Modal -->
<?php if (isset($_SESSION['id_usuario'])): ?>
<?php 
  $userInfo = CRUD::all('usuarios','*','id_usuario = ?',['i',$_SESSION['id_usuario']]);
  unset($userInfo[0]['clave']);
  $user = Secure::decodeArray($userInfo[0]);
?>

<div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

          <h3 class="text-uppercase"><?php echo 'Dirección'; ?></h3>
          <hr style="border-color: #4DB2A4;">
      </div>        
          
      <div id="content_address_form">
        <form class="form-modals" action="<?php echo URL_BASE.'bd/users/address/new.php' ?>" method="POST" role="form">
            <div class="modal-body">

                <input type="hidden" name="id_usuario" value="<?php echo $user->id_usuario; ?>">
                <input type="hidden" name="url" value="<?php echo $urlOrigen; ?>">

                <?php include DIRECTORIO_ROOT."inc/form/addressForm.php"; ?>

            </div>
          <div class="modal-footer text-center">
            <button type="submit" class="btn btn-mifu-modal btn-block"><?php echo $addressCheck->form_submit; ?></button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<?php endif ?>

<!-- #Add Address Modal -->
