<?php
class ExternalHeaderController extends ViewController {

	protected function control() {
		global $_ASESSION, $base_host;

		header('Content-Type: application/javascript');
		header('Cache-Control: no-cache');

$in = <<<LOGGED_IN
<div id=\"prof-head\"><a href=\"javascript:showHideProfile()\"><img src=\"http://local.account.confone.com/rest/display/profile/bamOTj8WF0_3\" /><label>Peng Shen &#9662;</label></a></div><div id=\"profile-hide\"><div id=\"arrow-up\"></div><div class=\"round4\" id=\"links\"><a class=\"round4top\" href=\"$base_host/profile\">Account Settings</a><a class=\"round4bottom\" href=\"$base_host/logout\">Sign Out</a></div></div>
LOGGED_IN;

$out = <<<LOGGED_OUT
<div style=\"width:200px;\"><button onclick=\"window.location.href='http://local.account.confone.com/register'\" class=\"round4 register\">Sign Up</button><button onclick=\"window.location.href='http://local.account.confone.com/login'\" class=\"round4 login\">Login</button></div>
LOGGED_OUT;

		$content = ($_ASESSION->exist(ASession::$AUTHINDEX)) ? $in : $out;

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