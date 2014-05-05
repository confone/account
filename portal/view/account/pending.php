<?php
$scripts = array('account.js');
$stylesheets = array('account.css');

include 'view/include/header.php';
?>
<div id="email-message">
<div id="sign_title"><label><?=$display['title'] ?></label></div>
<div>
<div class='size09'><?=$display['send_to'] ?> <label style="font-size:.8em;color:blue"><?=$user->getEmail() ?></label><?=$display['click_link'] ?></div>
<br>
<div class='size09'><?=$display['not_receive'] ?> <a href="javascript:sendActivationEmail()"><?=$display['send_again'] ?></a></div>
</div>
</div>
<?php 
include 'view/include/footer.php'
?>