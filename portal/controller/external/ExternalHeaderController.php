<?php
class ExternalHeaderController extends ViewController {

	protected function control() {
		global $_ASESSION, $base_host;

		if ($_ASESSION->exist(ASession::$AUTHINDEX)) {
			$userId = $_ASESSION->getUserId();
	
			if (!$userId) {
				$this->redirect('/login');
			}
	
			$user = new User($userId);
			$src = $user->getProfilePic();
			$name = $user->getName();
	
			header('Content-Type: application/javascript');
			header('Cache-Control: no-cache');
	
			$content = "
<div id=\"prof-head\">
<a href=\"javascript:showHideProfile()\">
<img src=\"$src\" />
<label>$name &#9662;</label>
</a>
</div>
<div id=\"profile-hide\">
<div id=\"arrow-up\"></div>
<div class=\"round4\" id=\"links\">
<a class=\"round4top\" href=\"$base_host/profile\">Account Settings</a>
<a class=\"round4bottom\" href=\"$base_host/logout\">Sign Out</a>
</div>
</div>
			";
		} else {
			$content = "
<div style=\"width:200px;\">
<button onclick=\"window.location.href='$base_host/register'\" class=\"round4 register\">Sign Up</button>
<button onclick=\"window.location.href='$base_host/login'\" class=\"round4 login\">Login</button>
</div>
			";
		}

		$content = str_replace(PHP_EOL, '', $content);
		$content = str_replace('"', '\"', $content);

$script = <<<SCRIPT
function showHideProfile() {
	var div = document.getElementById('profile-hide');
	if (div.style.display==='block') {
		div.style.display = 'none';
	} else {
		div.style.display = 'block';
	}
}
document.getElementById('profile').innerHTML = "$content";
SCRIPT;

		echo $script;
	}

	protected function checkLogin() {
		return false;
	}
}
?>