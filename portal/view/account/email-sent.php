<?php
$scripts = array('account.js');
$stylesheets = array('account.css');

include 'view/include/header.php';
?>
<div id="login" class="sector">
<div id="sign_title"><label>Reset Password Email</label></div>
<div>
An email with the reset password link has send to <?=$user->getEmail() ?>, please login in your email and click on the link to reset your password.
Have not received the reset password email? <a href="javascript:sendResetPasswordEmail();">Send again</a>.
</div>
</div>
<?php 
include 'view/include/footer.php'
?>