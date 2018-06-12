<?php 
  $user = '';
  $psw = '';
  $rmb = '';

  if (isset($_COOKIE['log_in'])) {
    $verDatos = Cookie::readCookie('log_in');
    $user = $verDatos[0]['user'];
    $psw = $verDatos[0]['clv'];
    $rmb = 'checked';
  }
?>

<input type="hidden" name="empt_val">
<input type="hidden" name="url" value="<?php echo $urlOrigen; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">

<?php if (isset($_GET['process']) AND Cookie::readCookie('bolsa')): ?>
    <input type="hidden" name="payment_continue" value="true">
<?php endif ?>

<div class="form-group">
  <label for="correo"><?php echo $loginM->user; ?></label>
  <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $user; ?>" required>
</div>

<div class="form-group">
  <label for="clave"><?php echo $loginM->psw; ?></label>
  <input type="password" class="form-control" name="clave" value="<?php echo $psw; ?>" required>
</div>

<label class="anim">
    <input type="checkbox" class="checkbox" name="recordar" value="true" <?php echo $rmb; ?>>
    <span><?php echo $loginM->save; ?></span>
</label>
