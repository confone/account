<?php
$scripts = array('account.js');
$stylesheets = array('account.css');

include 'view/include/header.php';
?>
<script type="text/javascript">var RecaptchaOptions = { theme : 'clean' };</script>
<form action="/login" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<table>
<tr><td>Email: </td><td><input class="text_field round4" type="text" name="username" value="" /></td></tr>
<tr><td>Password: </td><td><input class="text_field round4" type="password" name="password" value="" /></td></tr>
</table>
<?php if ($recaptcha) {
    global $recaptcha_public_key;
    echo recaptcha_get_html($recaptcha_public_key, 'Invalid ReCAPTCHA', true);
} ?>
<input type="hidden" name="redirect_uri" value="<?=$redirect_uri ?>" />
<input type="submit" value="Sign In" />
</form>
<?php 
include 'view/include/footer.php'
?>