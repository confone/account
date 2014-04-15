<?php
$scripts = array('account.js');
$stylesheets = array('account.css');

include 'view/include/header.php';
?>
<script type="text/javascript">var RecaptchaOptions = { theme : 'white' };</script>
<div id="register" class="sector">
<div id="sign_title"><label>Sign up for Confone</label></div>
<form action="/register" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<label class="field_label">Email:</label>
<div class="field_div"><input class="text_field round4" type="text" name="email" value="<?=(isset($email) ? $email : '') ?>" /></div>
<label class="field_label">Name:</label>
<div class="field_div"><input class="text_field round4" type="text" name="username" value="<?=(isset($name) ? $name : '') ?>" /></div>
<label class="field_label">Password:</label>
<div class="field_div"><input class="text_field round4" type="password" name="password" value="" /></div>
<label class="field_label">Confirm Password:</label>
<div class="field_div"><input class="text_field round4" type="password" name="cpassword" value="" /></div>
<?php
global $recaptcha_public_key;
echo recaptcha_get_html($recaptcha_public_key, 'Invalid ReCAPTCHA', true);
?>
<?php if(!empty($error)) { ?>
<div id="error" class="round4"><?=$error ?></div>
<?php } ?>
<input type="checkbox" name="keep_login" id="keep_login" checked /><label for="keep_login" class="keep_login">Keep me logged in</label>
<div class="top20px">
<input class="button round4" type="submit" value="Sign up" />
<label id="or">or</label><a href="/login">Sign in to Confone</a><br>
</div>
</form>
</div>
<?php 
include 'view/include/footer.php'
?>