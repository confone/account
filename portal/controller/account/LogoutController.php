<?php
class LogoutController extends ViewController {

	protected function control() {
		global $_ASESSION;

		$_ASESSION->destroy();

		if (isset($_COOKIE[ASession::$COOKIE_TOKEN])) {
			$cookieToken = $_COOKIE[ASession::$COOKIE_TOKEN];
			User::removeRememberMeToken($cookieToken);

			setcookie(ASession::$COOKIE_TOKEN, $cookieToken, time()-3600 , '/', 'account.confone.com', false, true);
		}

		$redirect_uri = param('redirect_uri');

		$this->redirect(empty($redirect_uri) ? '/login' : $redirect_uri);
	}

	protected function checkLogin() {
		return false;
	}
}
?>
