<?php
$scripts = array('account.js');
$stylesheets = array('account.css');

include 'view/include/header.php';
?>
<div id="login" class="sector">
<div id="sign_title"><label>Reset Password</label></div>
<form action="/reset-password" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<input type="hidden" name="sid" value="<?=$uid ?>" />
<input type="hidden" name="token" value="<?=$token ?>"/>
<label class="field_label">New Password:</label>
<div class="field_div"><input class="text_field round4" type="password" name="password" /></div>
<label class="field_label">Confirm Password:</label>
<div class="field_div"><input class="text_field round4" type="password" name="cpassword" /></div>
<?php if(!empty($error)) { ?>
<div id="error" class="round4"><?=$error ?></div>
<?php } ?>
<div class="top30px">
<input class="button round4" type="submit" value="Send" />
</div>
</form>
</div>
<?php 
include 'view/include/footer.php'
?>