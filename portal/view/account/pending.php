<?php
$scripts = array('account.js');
$stylesheets = array('account.css');

include 'view/include/header.php';
?>
<div id="login" class="sector">
<div id="sign_title"><label>Account Activation Pending</label></div>
<div>
An email with the activation link has send to <?=$user->getEmail() ?>, please login in your email and click on the link to activate your account.
Have not received the activation email? <a href="javascript:sendActivationEmail()">Send again</a>.
</div>
</div>
<?php 
include 'view/include/footer.php'
?>