<?php
class ForgetEmailController extends ViewController {

	protected function control() {
		global $_ASESSION;

		if ($_ASESSION->exist(ASession::$RESETPASSWD)) {
			$userId = $_ASESSION->get(ASession::$RESETPASSWD);
			$user = new User($userId);

			$this->render( array(
				'title' => 'Email Sent | Confone',
				'view' => 'account/email-sent.php',
				'user' => $user
			));
		} else {
			$this->redirect('/forget');
		}
	}

	protected function checkLogin() {
		return false;
	}
}
?>