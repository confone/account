<?php
class LogoutController extends ViewController {

	protected function control() {
		global $_ASESSION;

		$_ASESSION->destroy();

		if (isset($_COOKIE[ASession::$COOKIE_TOKEN])) {
			$cookieToken = $_COOKIE[ASession::$COOKIE_TOKEN];
			LookupRememberUserDao::removeToken($cookieToken);

			setcookie(ASession::$SESSION_KEY, $this->sessionId, time()-3600, '/', 'confone.com', false, true);
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
