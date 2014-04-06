<?php
class LogoutController extends ViewController {

	protected function control() {
		global $_ASESSION;

		$_ASESSION->destroy();

		$redirect_uri = param('redirect_uri');
		$this->redirect(empty($redirect_uri) ? '/login' : $redirect_uri);
	}

	protected function checkLogin() {
		return false;
	}
}
?>
