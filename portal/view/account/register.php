<?php
$scripts = array('account.js');
$stylesheets = array('account.css');

include 'view/include/header.php';
?>
<?php if (!empty($error)) { ?>
<div><?=$error ?></div>
<?php } ?>
<form action="/register" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<table>
<tr><td>Email: </td><td><input type="text" name="email" value="" /></td></tr>
<tr><td>Name: </td><td><input type="text" name="username" value="" /></td></tr>
<tr><td>Password: </td><td><input type="password" name="password" value="" /></td></tr>
<tr><td>Confirm Password: </td><td><input type="password" name="cpassword" value="" /></td></tr>
</table>
<?php
global $recaptcha_public_key;
echo recaptcha_get_html($recaptcha_public_key, 'Invalid ReCAPTCHA', true);
?>
<input type="submit" value="Register" />
</form>
<?php 
include 'view/include/footer.php'
?>