<?php
$scripts = array('account.js');
$stylesheets = array('account.css');

include 'view/include/header.php';
?>
<script type="text/javascript">var RecaptchaOptions = { theme : 'clean' };</script>
<div id="login">
<form action="/login" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<label class="field_label">Email:</label>
<div class="field_div"><input class="text_field round4" type="text" name="username" value="" /></div>
<label class="field_label">Password:</label>
<div class="field_div"><input class="text_field round4" type="password" name="password" value="" /></div>
<?php if ($recaptcha) {
    global $recaptcha_public_key;
    echo recaptcha_get_html($recaptcha_public_key, 'Invalid ReCAPTCHA', true);
} ?>
<input type="hidden" name="redirect_uri" value="<?=$redirect_uri ?>" />
<div id="rem_sub">
<input type="checkbox" name="keep_login" id="keep_login" /><label for="keep_login" class="keep_login">Keep me logged in</label>
<input class="button round4 right" type="submit" value="Sign In" />
</div>
</form>
</div>
<?php 
include 'view/include/footer.php'
?>