<?php
$scripts = array('account.js');
$stylesheets = array('account.css');

include 'view/include/header.php';
?>
<form action="/login" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<table>
<tr><td>Email: </td><td><input type="text" name="username" value="<?=$username ?>" /></td></tr>
<tr><td>Password: </td><td><input type="password" name="password" value="<?=$password ?>" /></td></tr>
<tr><td></td><td><input type="submit" value="Sign In" /></td></tr>
</table>
</form>
<?php 
include 'view/include/footer.php'
?>