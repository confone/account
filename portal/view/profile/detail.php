<?php
$scripts = array('profile.js');
$stylesheets = array('profile.css');

include 'view/include/header.php';
?>
<div id="frame">
<div id="profile_img" class="round10">
<img id="profile" src="<?=$user->getProfilePic() ?>" />
</div>
<div id="detail">
<form action="/profile/update" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<label class="field_label">Name:</label>
<div class="field_div"><input class="text_field round4" name="name" value="<?=$user->getName() ?>" /></div>
<label class="field_label">Description:</label>
<div class="field_div"><textarea id="description" class="text_field round4" name="description"><?=$user->getDescription() ?></textarea></div>
<div class="space"></div>
<input class="button round4" type="submit" value="Update" />
</form>
</div>
</div>
<?php 
include 'view/include/footer.php'
?>