<?php
class PendingController extends ViewController {

	protected function control() {
		global $_ASESSION;

		if ($_ASESSION->exist(ASession::$ACTIVATION)) {
			$userId = $_ASESSION->get(ASession::$ACTIVATION);
			$user = new User($userId);

			$activationToken = $user->generateAccountActivationToken();
			EmailUtil::sendActivationEmail($username, $user->getName(), $user->getId(), $activationToken);
		} else {
			$this->redirect('/login');
		}

		$this->render( array(
			'view' => 'account/pending.php',
			'user' => $user
		));
	}

	protected function checkLogin() {
		return false;
	}
}
?>