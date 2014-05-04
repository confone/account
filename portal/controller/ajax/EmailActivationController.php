<?php
class EmailActivationController extends ViewController {

	protected function control() {
		global $_ASESSION;

		if ($_ASESSION->exist(ASession::$ACTIVATION)) {
			$userId = $_ASESSION->get(ASession::$ACTIVATION);
			$user = new User($userId);

			$activationToken = $user->generateAccountActivationToken();
			EmailUtil::sendActivationEmail($user->getEmail(), $user->getName(), $user->getId(), $activationToken);

			$this->response(array('status'=>'success'));
		} else {
			$this->response(array('status'=>'failed'), '400 Bad Request');
		}
	}

	protected function checkLogin() {
		return false;
	}
}
?>