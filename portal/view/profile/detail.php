<?php
$scripts = array('profile.js');
$stylesheets = array('profile.css');

include 'view/include/header.php';

echo $_SERVER['SERVER_ADDR'];
?>
<img src="<?=$user->getProfilePic() ?>" />
<?php 
include 'view/include/footer.php'
?>