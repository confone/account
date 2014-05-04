<?php
class EmailResetPasswordController extends ViewController {

	protected function control() {
		global $_ASESSION;

		if ($_ASESSION->exist(ASession::$RESETPASSWD)) {
			$userId = $_ASESSION->get(ASession::$RESETPASSWD);
			$user = new User($userId);

			$token = $user->generateResetPasswordToken();
			EmailUtil::sendForgetPasswordEmail($user->getEmail(), $user->getName(), $user->getId(), $token);

			$this->response(array('status'=>'success'));
		} else {
			$this->response(array('status'=>'failed'), '400 Bad Request' );
		}
	}

	protected function checkLogin() {
		return false;
	}
}
?>