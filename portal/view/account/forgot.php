<?php
$scripts = array('account.js');
$stylesheets = array('account.css');

include 'view/include/header.php';
?>
<script type="text/javascript">var RecaptchaOptions = { theme : 'white' };</script>
<div id="login" class="sector">
<div id="sign_title"><label>Forget Password</label></div>
<form action="/forget" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<label class="field_label">Email:</label>
<div class="field_div"><input class="text_field round4" type="text" name="email" value="<?=(isset($email) ? $email : '') ?>" /></div>
<?php global $recaptcha_public_key;
if (!empty($recaptcha_public_key)) {
	echo recaptcha_get_html($recaptcha_public_key, 'Invalid ReCAPTCHA', true);
}
?>
<?php if(!empty($error)) { ?>
<div id="error" class="round4"><?=$error ?></div>
<?php } ?>
<div class="top20px">
<input class="button round4" type="submit" value="Send" />
<label id="or">or</label><a href="/register">Sign up for Confone</a><br>
</div>
<div class="top20px">
Have an account? <a href="/login">Sign in now!</a>
</div>
</form>
</div>
<?php 
include 'view/include/footer.php'
?>